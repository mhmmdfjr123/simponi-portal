<?php

namespace App\Http\Controllers;
use App\Models\Download;
use App\Models\DownloadCategory;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers
 * @author efriandika
 */
class DownloadController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function index(Download $downloadModel, $categoryAlias = '', Request $Request, $keyword = '', $page = 1)
    {
        $sorting = $Request->input('urutkan');
        $keyword = $Request->input('keyword');
        $page = $Request->query('page');
        $query = $Request->all();
        // dd($page);
        if($keyword == '' && $page == ''){
            $searchParams = '';
        } elseif($keyword == '') {
            $searchParams = 'page=' . $page;
        } elseif($page == '') {
            $searchParams = 'keyword=' . $keyword;
        } else {
            $searchParams = 'keyword=' . $keyword . '&' . 'page=' . $page;
        }

        // dd($searchParams);
		$catId = '';
        $ffsCat = DownloadCategory::find(1);
        $search = ucwords($Request->input('keyword'));

	    if($categoryAlias != ''){
		    $cat = DownloadCategory::where('alias', $categoryAlias)->first();

		    if(count($cat) == 0)
		    	abort(404);

		    $catId = $cat->id;
	    }

        $category = DownloadCategory::where('status', 'Y')->orderBy('name')->get();
        $countData = count($category);

        // $getDatas = DB::table('download')->where('name', 'like', '%' . $search . '%')->paginate(5);
        // dd($getDatas);
        if($sorting == 'atoz'){
            $files = $downloadModel->getAscNameFilesWithPagination(5, $catId, $search);
        } elseif($sorting == 'ztoa') {
            $files = $downloadModel->getDescNameFilesWithPagination(5, $catId, $search);
        } else {
            $files = $downloadModel->getFilesWithPagination(5, $catId, $search);
        }
        // dd($files);
    	$data = [
    		'categoryAlias'     => $categoryAlias,
		    'categories'        => $category,
            'ffsCat'     => $ffsCat,
		    'files'             => $files,
            'countFiles' => DB::table('download')->where('name', 'like', '%' . $search . '%')->count(),
            'countData'=> $countData,
            'searchParams' => $searchParams
	    ];


        return view('download.index', $data);
    }

    public function getFile($filename) {
		$file = Download::where('file_name', $filename)
			->where('download.status', 'P')
			->where('download.publish_date_start', '<=', Carbon::now())
			->first();

		if(!is_null($file) && File::exists(public_path('file/storage/'.$file->file_name))) {
            $file->total_download = $file->total_download + 1;
            $file->save();

            return response()->download(public_path('file/storage/'.$file->file_name), $file->name.'.'.$file->file_ext);
        } else {
            abort(404, 'File Not Found');
        }
    }
}
