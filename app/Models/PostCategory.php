<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model {
    protected $table = "post_category";
    protected $primaryKey = 'id';

    public function parent(){
        return $this->belongsTo('App\Models\PostCategory', 'parent');
    }

    public function child(){
        return $this->hasMany('App\Models\PostCategory', 'id');
    }

    public function posts(){
        return $this->belongsToMany('App\Models\Post', 'post_category_rel', 'post_category_id', 'post_id');
    }

    public function listParent($itsId = ''){
        return $this->_getParent(null, $itsId, 1);
    }

    private function _getParent($parentId, $itsId, $level){
        $returnData = array();

        if($itsId != '')
            $query = $this->where('parent', $parentId)->where('status', 'Y')->where('id', '<>', $itsId);
        else
            $query = $this->where('parent', $parentId)->where('status', 'Y');

        foreach($query->orderBy('order', 'asc')->get() as $row){
            $returnData[] = [
                'level' => $level,
                'data'  => $row
            ];

            $temp = $this->_getParent($row->id, $itsId, $level+1);

            if(count($temp) > 0)
                $returnData = array_merge($returnData, $temp);
        }

        return $returnData;
    }

    public function listHierarchy(){
        return $this->_getParent(null, '', 1);
    }
}