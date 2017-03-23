<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Page Model
 *
 * @package App\Models
 * @author efriandika
 */
class Page extends Model {
    use SoftDeletes;

    protected $table = "page";
    protected $primaryKey = 'id';

    public function parent(){
        return $this->belongsTo(Page::class, 'parent');
    }

    public function child(){
        return $this->hasMany(Page::class, 'parent');
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
}