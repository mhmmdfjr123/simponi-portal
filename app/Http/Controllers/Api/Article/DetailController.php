<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class DetailController extends Controller {

	public function detail($postId) {
        $post = Post::with('categories')
            ->where('id', $postId)
            ->where('status', 'P')
            ->where('publish_date_start', '<', Carbon::now())
            ->first();

        if (!is_null($post)) {
            return response()->json($post);
        } else {
            return response()->json([
                'message' => 'Article (ID='.$postId.') not found',
                'errors' => []
            ]);
        }
    }
}
