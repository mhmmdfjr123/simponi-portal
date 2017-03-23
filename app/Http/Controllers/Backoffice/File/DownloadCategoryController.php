<?php namespace App\Http\Controllers\Backoffice\File;

use App\Http\Controllers\Controller;
use App\Models\DownloadCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers\Backoffice\File
 * @author efriandika
 */
class DownloadCategoryController extends Controller {

	// ID of row in $protectedID array cannot be deleted
	private $protectedID = [
		1 // Reserved by Fun Fact Sheet Category
	];

    public function __construct(){

    }

    public function index(){
        $data = [
            'pageTitle' => 'Kategori Download'
        ];

        return view('backoffice.file.downloadCategory.index', $data);
    }

    public function listData(){
        $data = [
            'listData' => DownloadCategory::orderBy('name')->get(),
	        'protectedID' => $this->protectedID
        ];

        return view('backoffice.file.downloadCategory.listData', $data);
    }

    public function add(Request $request){
        if(!$request->ajax())
            return redirect('backoffice/file/download/category');

        return view('backoffice.file.downloadCategory.add');
    }

    public function edit(Request $request, $id){
        if(!$request->ajax())
            return redirect('backoffice/file/download/category');

        try {
            $obj = DownloadCategory::findOrFail($id);

            if(count($obj) > 0){
                $data = [
                    'pageTitle'  => 'Ubah Kategori Download',
                    'obj'        => $obj
                ];

                return view('backoffice.file.downloadCategory.edit', $data);
            }else{
                return response('Not Found.', 404);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return response('Something wrong.', 500);
        }
    }

    public function delete($id){
        try {
            $obj = DownloadCategory::find($id);

            if(count($obj) > 0 && !in_array($obj->id, $this->protectedID)){
                $obj->delete();

                return redirect('backoffice/file/download/category')->with('success', 'Data berhasil dihapus.');
            }else{
                return redirect('backoffice/file/download/category')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/file/download/category')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function submit(Request $request){
        try {
            $id = $request->input('id');

            if($id != ""){
                $downloadCategory = DownloadCategory::find($id);

                if(count($downloadCategory) == 0){
                    return response()->json([
                        'status' => 'error',
                        'message'=> 'Data tidak ditemukan.'
                    ]);
                }
            }else{
                $downloadCategory = new DownloadCategory();
            }

            $downloadCategory->name = $request->input('name');
            $downloadCategory->desc = $request->input('desc');
            $downloadCategory->status = ($request->input('status') == 'Y') ? 'Y':'N';

            // Set alias
            $aliasQuery = DownloadCategory::where('alias', $request->input('alias'));
            if($request->input('alias_old') != ''){
                $aliasQuery->where('alias', '<>',$request->input('alias_old') );
            }

            $alias = $request->input('alias');

            if($aliasQuery->count() > 0){
                $alias = $alias.'-'.time();
            }
            $downloadCategory->alias = $alias;

            $downloadCategory->save();

            return response()->json([
                'status' => 'ok',
                'message'=> 'Data berhasil disimpan.'
            ]);

        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return response()->json([
                'status' => 'error',
                'message'=> 'Data gagal disimpan. Ulangi beberapa saat lagi'
            ]);
        }
    }
}