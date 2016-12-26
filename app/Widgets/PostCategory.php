<?php namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\PostCategory as Category;

class PostCategory extends AbstractWidget
{
    protected $config = [
        'activeId' => ''
    ];


    public function run(Category $postCategoryModel)
	{
        return view('widgets.postCategory', [
            'categories' => $postCategoryModel->listHierarchy(),
            'activeId'   => $this->config['activeId']
        ]);
	}
}