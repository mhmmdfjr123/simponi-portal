<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostCategory
 * @package App\Models
 * @author efriandika
 */
class PostCategory extends Model {
    protected $table = "post_category";
    protected $primaryKey = 'id';

    public function parent(){
        return $this->belongsTo(PostCategory::class, 'parent');
    }

    public function child(){
        return $this->hasMany(PostCategory::class, 'parent');
    }

    public function posts(){
        return $this->belongsToMany(Post::class, 'post_category_rel', 'post_category_id', 'post_id');
    }

    public function listParent($itsId = '', $activeOnly = true){
        return $this->_getParent(null, $itsId, 1, $activeOnly);
    }

    private function _getParent($parentId, $itsId, $level, $activeOnly){
        $returnData = array();

        $query = $this->where('parent', $parentId);

        if($itsId != '')
            $query->where('id', '<>', $itsId);

        if($activeOnly)
            $query->where('status', 'Y');

        foreach($query->orderBy('order', 'asc')->get() as $row){
            $returnData[] = [
                'level' => $level,
                'data'  => $row
            ];

            $temp = $this->_getParent($row->id, $itsId, $level+1, $activeOnly);

            if(count($temp) > 0)
                $returnData = array_merge($returnData, $temp);
        }

        return $returnData;
    }

    public function listHierarchy($activeOnly = true){
        return $this->_getParent(null, '', 1, $activeOnly);
    }
}