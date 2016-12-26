<?php namespace App\Widgets;

use App\Models\Menu;
use App\Models\MenuCategory;
use Arrilot\Widgets\AbstractWidget;

class FooterMenu extends AbstractWidget
{
    protected $config = [
        'id' => ''
    ];


    public function run(Menu $menuModel)
	{
        $menuCategory = MenuCategory::find($this->config['id']);

        if(count($menuCategory) > 0){
            return view('widgets.footerMenu', [
                'menuCategory' => $menuCategory,
                'menus'        => $menuModel->listHierarchy($menuCategory->id)
            ]);
        }else{
            return "There is no menu with catId = ".$this->config['id'];
        }
	}
}