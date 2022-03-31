<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    protected $perPageDefault = 8;
    protected $postModel;

    /**
     * CategoryController constructor.
     * @param $postModel
     */
    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }


    public function news(Request $request){
        $perPage = $request->get('per_page') != '' ? $request->get('per_page') : $this->perPageDefault;
        return $this->getArticleByCategory(1, $perPage);
	}

    public function promotion(Request $request) {
        $perPage = $request->get('per_page') != '' ? $request->get('per_page') : $this->perPageDefault;
        return $this->getArticleByCategory(2, $perPage);
    }

    public function getArticleByCategory($categoryId, $perPage) {
        $category = PostCategory::find($categoryId);

        if (is_null($category)) {
            return response()->json([
                'message' => 'News category has not been setup.',
                'errors' => []
            ]);
        }

        $articles = $this->postModel->listAllPostWithPagination($perPage, $category->id);

        $data = [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->desc,
            'articles' => $articles
        ];

        return response()->json($data);
    }
}
