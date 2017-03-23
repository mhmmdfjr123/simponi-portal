<?php namespace App\Http\Controllers\Backoffice\Post;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Backoffice\Post
 * @author efriandika
 */
class CategoryController extends Controller {

	// ID of row in $protectedID array cannot be deleted
	private $protectedID = [
		1, 2 // Reserved by Fun Fact Sheet Category
	];

    public function index(){
        $data = [
            'pageTitle' => 'Kategori'
        ];

        return view('backoffice.post.category.index', $data);
    }

    public function listData(PostCategory $postCategoryModel){
        $data = [
            'listData' => $postCategoryModel->listHierarchy(false)
        ];

        return view('backoffice.post.category.listData', $data);
    }

    public function add(Request $request, PostCategory $postCategoryModel){
        if(!$request->ajax())
            return redirect('backoffice/post/category');

        $data = [
            'listParent' => $postCategoryModel->listParent(),
            'nextSequenceOrder' => $postCategoryModel->max('order') + 1
        ];

        return view('backoffice.post.category.add', $data);
    }

    public function edit(Request $request, PostCategory $postCategoryModel, $id){
        if(!$request->ajax())
            return redirect('backoffice/post/category');

        try {
            $obj = PostCategory::find($id);

            if(count($obj) > 0){
                $data = [
                    'pageTitle'  => 'Ubah Kategori',
                    'listParent' => $postCategoryModel->listParent($id),
                    'obj'        => $obj
                ];

                return view('backoffice.post.category.edit', $data);
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
            $obj = PostCategory::find($id);

	        if(in_array($obj->id, $this->protectedID))
		        return redirect('backoffice/post/category')->with('warning', 'Kategori ini tidak dapat dihapus.');

            if(count($obj) > 0){
                $obj->delete();

                return redirect('backoffice/post/category')->with('success', 'Data berhasil dihapus.');
            }else{
                return redirect('backoffice/post/category')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/post/category')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function submit(PostCategory $postCategoryModel, Request $request){
        try {
            $id = $request->input('id');

            if($id != ""){
                $postCategory = PostCategory::find($id);

                if(count($postCategory) == 0){
                    return response()->json([
                        'status' => 'error',
                        'message'=> 'Data tidak ditemukan.'
                    ]);
                }
            }else{
                $postCategory = new PostCategory();
            }

            $postCategory->name = $request->input('name');
            $postCategory->desc = $request->input('desc');
            $postCategory->order = $request->input('order');
            $postCategory->status = ($request->input('status') == 'Y') ? 'Y':'N';
            $postCategory->parent = ($request->input('parent') == '') ? null : $request->input('parent');

            // Set alias
            $aliasQuery = $postCategoryModel->where('alias', $request->input('alias'));
            if($request->input('alias_old') != ''){
                $aliasQuery->where('alias', '<>',$request->input('alias_old') );
            }

            $alias = $request->input('alias');

            if($aliasQuery->count() > 0){
                $alias = $alias.'-'.time();
            }
            $postCategory->alias = $alias;

            $postCategory->save();

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