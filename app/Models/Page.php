<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Page extends Model {
    use SoftDeletes;

    protected $table = "page";
    protected $primaryKey = 'id';

    public function parent(){
        return $this->belongsTo('App\Models\Page', 'parent');
    }

    public function child(){
        return $this->hasMany('App\Models\Page', 'id');
    }

    public function listParent($itsId = ''){
        $query = $this->orderBy('title');
        $query->where('status', 'P');
        if($itsId != ''){
            $query->where('id', '<>', $itsId);
        }

        return $query->get();
    }

    public function getListStatus(){
        $query = $this->select(DB::raw('status, COUNT(*) as status_count'));
        return $query->groupBy('status')->get();
    }

    public function listData($offset, $limit, $search, $sortCol, $sortDir, $status = ""){
        if($sortCol != "")
            $query = Page::orderBy($sortCol, $sortDir);
        else
            $query = Page::orderBy("order", "asc")->orderBy('title', 'asc');

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
}