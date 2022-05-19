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

    public function index(Download $downloadModel, $categoryAlias = '', Request $Request)
    {
		$catId = '';

        $search = $Request->input('keyword');

	    if($categoryAlias != ''){
		    $cat = DownloadCategory::where('alias', $categoryAlias)->first();

		    if(count($cat) == 0)
		    	abort(404);

		    $catId = $cat->id;
	    }

        $category = DownloadCategory::where('status', 'Y')->orderBy('name')->get();
        $countData = count($category);
        
    	// $files = $downloadModel->getFilesWithPagination(5, $catId);

    	$data = [
    		'categoryAlias'     => $categoryAlias,
		    'categories'        => $category,
		    // 'files'             => $files,
            'files' => DB::table('download')->where('name', 'like', '%' . $search . '%')->paginate(5),
            'countFiles' => DB::table('download')->where('name', 'like', '%' . $search . '%')->count(),
            'countData'=> $countData
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
