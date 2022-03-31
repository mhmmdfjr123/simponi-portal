<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;

/**
 * Handle FAQ content for API
 * @package App\Http\Controllers
 * @author efriandika
 */
class FaqController extends Controller
{

	/**
	 * Show the faq index.
	 *
	 * @param FaqCategory $faqCategoryModel
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(FaqCategory $faqCategoryModel)
    {
        $data = $faqCategoryModel->with(['faqs' => function ($query) {
            $query->where('status', 'Y');
            $query->orderBy('order');
        }])->where('status', 'Y')->orderBy('order')->get();

        return response()->json($data);
    }
}
