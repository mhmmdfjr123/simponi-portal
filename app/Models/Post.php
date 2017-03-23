<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Post
 * @package App\Models
 * @author efriandika
 */
class Post extends Model {
    use SoftDeletes;

    protected $table = "post";
    protected $primaryKey = 'id';

    public function categories(){
        return $this->belongsToMany(PostCategory::class, 'post_category_rel', 'post_id', 'post_category_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getListStatus(){
        $query = $this->select(DB::raw('status, COUNT(*) as status_count'));
        return $query->groupBy('status')->get();
    }

    public function listAllPost($limit, $offset, $catId = ''){
        $query = $this->select(['users.name', 'post.*'])->orderBy('post.created_at', 'DESC');

        $query->join('users', 'users.id', '=', 'post.created_by');

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
        $query = $this->select('users.name as author', 'post.*')->orderBy('created_at', 'DESC');

        $query->join('users', 'users.id', '=', 'post.created_by');

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