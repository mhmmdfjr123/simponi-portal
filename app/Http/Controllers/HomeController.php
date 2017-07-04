<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Download;
use App\Models\DownloadCategory;
use App\Models\Post;
use App\Models\PostCategory;

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
        $newsCat = PostCategory::find(1);
        $promotionCat = PostCategory::find(2);

        if(count($newsCat) == 0) {
            echo 'Default article category has not been setup. (Cat ID = 1 :=> berita)';
            exit;
        } else if(count($promotionCat) == 0) {
            echo 'Default article category has not been setup. (Cat ID = 2 :=> promotion)';
            exit;
        }

        $data = [
    	    'banners'    => $bannerModel->getBanners(),
    		'latestNews' => $postModel->listAllPost(4, 0, $newsCat->id),
		    'promotions' => $postModel->listAllPost(4, 0, $promotionCat->id),
		    'fundFactSheet' => $downloadModel->getFiles(4, 0, 1),
		    'ffs'        => DownloadCategory::findOrFail(1),
            'newsAlias' => $newsCat->alias,
            'promotionAlias' => $promotionCat->alias
	    ];

        return view('home.index', $data);
    }
}
