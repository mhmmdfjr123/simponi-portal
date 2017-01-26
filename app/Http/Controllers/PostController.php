<?php namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller {

	public function __construct()
	{

	}

	public function index(Post $postModel, $alias = '')
	{
        if($alias == '')abort('404');

        $post = $postModel->where('alias', $alias)->first();

        if(count($post) == 0)abort('404');

        $categories = array();
        foreach($post->categories as $cat){
            $categories[] = '<a href="'.url('category/'.$cat->alias).'" class="category-link">'.$cat->name.'</a>';
        }

        $data = [
            'post'      => $post,
            'pageTitle' => $post->title,
            'categories'=> $categories,
            'metaKey'   => $post->meta_key,
            'metaDesc'  => $post->meta_desc
        ];

		return view('post.index', $data);
	}

}
