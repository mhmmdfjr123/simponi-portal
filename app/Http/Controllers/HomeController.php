<?php

namespace App\Http\Controllers;
use App\Models\Banner;
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
     * @param Banner $bannerModel
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(Post $postModel, Download $downloadModel, Banner $bannerModel)
    {
    	$data = [
    	    'banners'    => $bannerModel->getBanners(),
    		'latestNews' => $postModel->listAllPost(4, 0, 1),
		    'promotions' => $postModel->listAllPost(4, 0, 2),
		    'fundFactSheet' => $downloadModel->getFiles(4, 0, 1),
		    'ffs'        => DownloadCategory::findOrFail(1),
		    'featuredBoxStrLimit'   => 37
	    ];

        return view('home.index', $data);
    }
}
