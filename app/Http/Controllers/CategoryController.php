<?php namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;

class CategoryController extends Controller {
    var $perPage = 8;

	public function __construct() {

	}

	public function index(PostCategory $postCategoryModel, Post $postModel, $alias = ''){
        $data = array();

		if($alias != ''){
            $category = $postCategoryModel->where('alias', $alias)->first();

            if(count($category) > 0){
                $data['pageTitle']  = $category->name;
                $data['metaDesc']   = $category->desc;
                $data['catId']      = $category->id;
            }else{
                abort('404');
            }
        }else{
            $data['pageTitle']  = 'Semua Kategori';
            $data['metaDesc']   = 'Menampilkan postingan dari semua kategori';
            $data['catId']      = '';
        }

        $data['posts']   = $postModel->listAllPostWithPagination($this->perPage, $data['catId']);

        return view('category.index', $data);
	}
}
