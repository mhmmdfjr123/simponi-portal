<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 * @package App\Models
 * @author efriandika
 */
class Menu extends Model {
    protected $table = "menu";
    protected $primaryKey = 'id';

    public function categories(){
        return $this->belongsTo(MenuCategory::class, 'menu_category_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(Menu::class, 'menu_parent', 'id');
    }

    public function child(){
        return $this->hasMany(Menu::class, 'menu_parent', 'id');
    }

    private function _getParent($parentId, $catId, $level){
        $returnData = array();

        foreach($this->where('menu_parent', $parentId)->where('menu_category_id', $catId)->orderBy('order', 'asc')->get() as $row){
            $p = '';

            if($row->menu_type == 'PO')
                $p = PostCategory::find($row->menu_type_param);
            else if($row->menu_type == 'PA')
                $p = Page::find($row->menu_type_param);

            $returnData[] = [
                'level' => $level,
                'data'  => $row,
                'related'   => $p,
                'children'  => $this->_getParent($row->id, $catId, $level+1)
            ];
        }

        return $returnData;
    }

    /**
     * Get hierarcy of menu with level
     *
     * @param $catId
     * @return array
     */
    public function listHierarchy($catId){
        return $this->_getParent(null, $catId, 1);
    }
}