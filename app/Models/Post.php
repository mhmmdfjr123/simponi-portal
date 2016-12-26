<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Post extends Model {
    use SoftDeletes;

    protected $table = "post";
    protected $primaryKey = 'id';

    public function categories(){
        return $this->belongsToMany('App\Models\PostCategory', 'post_category_rel', 'post_id', 'post_category_id');
    }

    public function account(){
        return $this->belongsTo('App\Models\Account', 'created_by', 'id');
    }

    public function getListStatus(){
        $query = $this->select(DB::raw('status, COUNT(*) as status_count'));
        return $query->groupBy('status')->get();
    }

    public function listData($offset, $limit, $search, $sortCol, $sortDir, $status = ""){
        if($sortCol != "")
            $query = Post::orderBy($sortCol, $sortDir)->orderBy("created_at", "desc");
        else
            $query = Post::orderBy("created_at", "desc")->orderBy('title', 'asc');

        if(strtolower($status) == "deleted"){
            $query->onlyTrashed();
        }else if($status != ""){
            $query->where("status", $status);
        }

        if($search != ""){
            $query->where("title", "ILIKE", "%".$search."%");
        }

        if($limit == -1)return $query;
        else return $query->take($limit)->skip($offset);
    }

    public function countListData($search = "", $status = ""){
        $query = $this;

        if(strtolower($status) == "deleted"){
            $query->onlyTrashed();
        }else if($status != ""){
            $query->where("status", $status);
        }

        if($search != ""){
            return $query->where("title", "ILIKE", "%".$search."%")->count();
        }else{
            return $query->count();
        }
    }

    public function listAllPost($limit, $offset, $catId = ''){
        $query = $this->select('account.organization as author', 'post.*')->orderBy('created_at', 'DESC');

        $query->join('account', 'account.id', '=', 'post.created_by');

        if($catId != ''){
            $query->join('post_category_rel', function($join) use ($catId){
                $join->on('post_category_rel.post_id', '=', 'post.id')
                    ->where('post_category_rel.post_category_id', '=', $catId);
            });
        }

        $query->where('post.status', 'P');
        $query->where('post.publish_date_start', '<=', Carbon::now());

        return $query->take($limit)->skip($offset)->get();
    }

    public function listAllPostWithPagination($perPage, $catId = ''){
        $query = $this->select('account.organization as author', 'post.*')->orderBy('created_at', 'DESC');

        $query->join('account', 'account.id', '=', 'post.created_by');

        if($catId != ''){
            $query->join('post_category_rel', function($join) use ($catId){
                $join->on('post_category_rel.post_id', '=', 'post.id')
                    ->where('post_category_rel.post_category_id', '=', $catId);
            });
        }

        $query->where('post.status', 'P');
        $query->where('post.publish_date_start', '<=', Carbon::now());

        return $query->simplePaginate($perPage);
    }
}