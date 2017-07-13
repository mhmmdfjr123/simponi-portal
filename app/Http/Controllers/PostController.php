<?php namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;

class PostController extends Controller {

	public function index(Post $postModel, PostCategory $postCategoryModel, $alias = '')
	{
	    $catId = '';
	    $catName = 'Semua Kategori';
        $catDesc = 'Semua Kategori';

        if($alias != ''){
            $cat = PostCategory::where('alias', $alias)->first();

            if(count($cat) == 0)
                abort(404);

            $catId = $cat->id;
            $catName = $cat->name;
            $catDesc = $cat->desc;
        }

        $posts = $postModel->listAllPostWithPagination(10, $catId);

        $data = [
            'pageTitle' => $catName,
            'metaKey'   => $catName.', kategori, simponi',
            'metaDesc'  => $catDesc,
            'categories'=> $postCategoryModel->listHierarchy(),
            'postAlias' => $alias,
            'posts'     => $posts
        ];

		return view('post.index', $data);
	}

    public function detail(Post $postModel, $alias)
    {
        if($alias == '')abort('404');

        $post = $postModel->where('alias', $alias)->first();

        if(count($post) == 0)abort('404');

        $categories = array();
        foreach($post->categories as $cat){
            $categories[] = '<a href="'.route('post-category', $cat->alias).'" class="category-link">'.$cat->name.'</a>';
        }

        $data = [
            'post'      => $post,
            'pageTitle' => $post->title,
            'categories'=> $categories,
            'metaKey'   => $post->meta_key,
            'metaDesc'  => $post->meta_desc
        ];

        return view('post.detail', $data);
    }

}
