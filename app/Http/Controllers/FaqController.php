<?php

namespace App\Http\Controllers;
use App\Models\FaqCategory;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @author efriandika
 */
class FaqController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

	/**
	 * Show the faq index.
	 *
	 * @param FaqCategory $faqCategoryModel
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(FaqCategory $faqCategoryModel)
    {
        return view('faq.index', [
        	'faqCategories' => $faqCategoryModel->with(['faqs' => function ($query) {
		        $query->where('status', 'Y');
		        $query->orderBy('order');
	        }])->where('status', 'Y')->orderBy('order')->get()
        ]);
    }
}
