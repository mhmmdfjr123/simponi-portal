<?php

namespace App\Http\Controllers;
use App\Models\Download;
use App\Models\DownloadCategory;
use App\Models\Post;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @author efriandika
 */
class HomeController extends Controller
{

	/**
	 * Show the application dashboard.
	 *
	 * @param Post $postModel
	 * @param Download $downloadModel
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(Post $postModel, Download $downloadModel)
    {
    	$data = [
    		'latestNews' => $postModel->listAllPost(4, 0, 1),
		    'promotions' => $postModel->listAllPost(4, 0, 2),
		    'fundFactSheet' => $downloadModel->getFiles(4, 0, 1),
		    'ffs'        => DownloadCategory::findOrFail(1),
		    'featuredBoxStrLimit'   => 37
	    ];

        return view('home.index', $data);
    }
}
