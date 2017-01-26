<?php namespace App\Http\Controllers;

use App\Models\Page;
use Carbon\Carbon;

/**
 * Class PageController
 * @package App\Http\Controllers
 * @author efriandika
 */
class PageController extends Controller {

	public function __construct()
	{

	}

    public function index(Page $pageModel, $alias = '')
    {
        if($alias == '')abort('404');

        $page = $pageModel->where('alias', $alias)->first();

        if(count($page) == 0)abort('404');
        else if($page->status != 'P' || Carbon::now() < $page->publish_date_start)abort('403', 'Forbidden');

        $data = [
            'page'      => $page,
            'pageTitle' => $page->title,
            'metaKey'   => $page->meta_key,
            'metaDesc'  => $page->meta_desc
        ];

        return view('page.index', $data);
    }
}
