<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Event extends Model {
    use SoftDeletes;

    protected $table = "event";
    protected $primaryKey = 'id';

    public function account(){
        return $this->belongsTo('App\Models\Account', 'created_by', 'id');
    }

    public function getListStatus(){
        $query = $this->select(DB::raw('status, COUNT(*) as status_count'));
        return $query->groupBy('status')->get();
    }

    public function listData($offset, $limit, $search, $sortCol, $sortDir, $status = ""){
        $query = $this->select('account.organization as author', 'event.*');

        if($sortCol != "")
            $query->orderBy($sortCol, $sortDir)->orderBy("event_start", "desc")->orderBy('event_end', 'desc');
        else
            $query->orderBy("event_start", "desc")->orderBy('event_end', 'desc');

        if(strtolower($status) == "deleted"){
            $query->onlyTrashed();
        }else if($status != ""){
            $query->where("event.status", $status);
        }

        if($search != ""){
            $query->where("name", "ILIKE", "%".$search."%");
        }

        $query->join('account', 'account.id', '=', 'event.created_by');

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
            return $query->where("name", "ILIKE", "%".$search."%")->count();
        }else{
            return $query->count();
        }
    }
}