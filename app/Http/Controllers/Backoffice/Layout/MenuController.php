<?php namespace App\Http\Controllers\Backoffice\Layout;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Page;
use App\Models\PostCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * Class MenuController
 * @package App\Http\Controllers\Backoffice\Layout
 * @author efriandika
 */
class MenuController extends Controller {

    public function __construct(){

    }

    public function index(){
        $data = [
            'pageTitle' => 'Manajemen Menu',
            'listMenuCategory' => MenuCategory::orderBy('created_at', 'asc')->get()
        ];

        return view('backoffice.layout.menu.index', $data);
    }

    public function listMenu(Menu $menu, Request $request){
        if(!$request->ajax())
            return redirect('backoffice/layout/menu');

        $data = [
            'listMenu'  => $menu->listHierarchy($request->get('menu_category_id')),
            'catId'     => $request->get('menu_category_id')
        ];

        return view('backoffice.layout.menu.listMenu', $data);
    }

    public function add(Request $request, PostCategory $postCategory){
        if(!$request->ajax() || $request->get('menu_type') === null)
            return redirect('backoffice/layout/menu');

        $type = strtoupper($request->get('menu_type'));

        $data = [
            'pageTitle'  => 'Tambah Menu',
            'catId'      => $request->get('menu_category_id'),
            'menuType'   => $type
        ];

        if($type == 'PA'){
            $data['listPage'] = Page::orderBy('title')->get();
        }else if($type == 'PO'){
            $data['listCategory'] = $postCategory->listHierarchy();
        }else if($type == 'S'){
            $data['listData'] = Config::get('content.page.special');
        }

        return view('backoffice.layout.menu.add', $data);
    }

    public function edit(Request $request, PostCategory $postCategory, $id){
        if(!$request->ajax())
            return redirect('backoffice/layout/menu');

        $menu = Menu::find($id);

        if(count($menu) == 0)
            return response('Data not found.', 404);

        $type = $menu->menu_type;

        $data = [
            'pageTitle'  => 'Ubah Menu',
            'obj'        => $menu,
            'menuType'   => $type
        ];

        if($type == 'PA'){
            $data['listPage'] = Page::all();
        }else if($type == 'PO'){
            $data['listCategory'] = $postCategory->listHierarchy();
        }else if($type == 'S'){
            $data['listData'] = Config::get('content.page.special');
        }

        return view('backoffice.layout.menu.edit', $data);
    }

    public function menuIndex(Request $request, Menu $menuModel){
        try {
            DB::beginTransaction();

            $index = 0;
            $children = json_decode($request->input('children'));

            $parent = ($request->input('parentId') == '') ? null : $request->input('parentId');

            foreach($children as $child){
                $menu = $menuModel->find($child);

                if($child == $request->input('itemId'))
                    $menu->menu_parent = $parent;

                $menu->order = $index++;
                $menu->save();
            }

            DB::commit();

            return response()->json([
                'status' => 'ok',
                'message'=> 'Data berhasil disimpan.'
            ]);
        } catch (QueryException $e) {
            DB::rollBack();

            \Log::error($e->getMessage());

            return response()->json([
                'status' => 'error',
                'message'=> 'Data gagal disimpan. Ulangi beberapa saat lagi'
            ]);
        }
    }

    public function submit(Request $request){
        try {
            $id = $request->input('id');

            if($id != ""){
                $menu = Menu::find($id);

                if(count($menu) == 0){
                    return response()->json([
                        'status' => 'error',
                        'message'=> 'Data tidak ditemukan.'
                    ]);
                }
            }else{
                $menu = new Menu();
            }

            $menu->menu_name = $request->input('menu_name');
            $menu->menu_category_id = $request->input('menu_category_id');
            $menu->menu_type = $request->input('menu_type');
            $menu->menu_type_param = $request->input('menu_type_param');

            $menu->save();

            return response()->json([
                'status' => 'ok',
                'message'=> 'Data berhasil disimpan.',
                'data'   => $menu
            ]);

        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return response()->json([
                'status' => 'error',
                'message'=> 'Data gagal disimpan. Ulangi beberapa saat lagi'
            ]);
        }
    }

    public function delete(Request $request){
        try {
            $obj = Menu::find($request->get('id'));

            if(count($obj) > 0){
                $obj->delete();

                return response()->json([
                    'status' => 'ok',
                    'message'=> 'Data berhasil dihapus.'
                ]);
            }else{
                return redirect('backoffice/layout/menu')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return response()->json([
                'status' => 'error',
                'message'=> 'Data gagal dihapus. Ulangi beberapa saat lagi'
            ]);
        }
    }

    public function addCategory(Request $request){
        if(!$request->ajax())
            return redirect('backoffice/layout/menu');

        $data = [
            'pageTitle'  => 'Tambah Kategori Menu',
        ];

        return view('backoffice.layout.menu.addCategory', $data);
    }

    public function editCategory(Request $request, $id){
        if(!$request->ajax())
            return redirect('backoffice/layout/menu');

        try {
            $obj = MenuCategory::find($id);

            if(count($obj) > 0){
                $data = [
                    'pageTitle'  => 'Ubah Kategori Menu',
                    'obj'        => $obj
                ];

                return view('backoffice.layout.menu.editCategory', $data);
            }else{
                return response('Not Found.', 404);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return response('Something wrong.', 500);
        }
    }

    public function deleteCategory($id){
        try {
            $obj = MenuCategory::find($id);

            /*
             * Cannot delete menu category with id < 0
             */
            if(count($obj) > 0 && $obj->id > 0){
                $obj->delete();

                return redirect('backoffice/layout/menu')->with('success', 'Kategori menu berhasil dihapus.');
            }else{
                return redirect('backoffice/layout/menu')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/layout/menu')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function submitCategory(Request $request){
        try {
            $id = $request->input('id');

            if($id != ""){
                $menuCategory = MenuCategory::find($id);

                if(count($menuCategory) == 0){
                    return response()->json([
                        'status' => 'error',
                        'message'=> 'Data tidak ditemukan.'
                    ]);
                }
            }else{
                $menuCategory = new MenuCategory();
            }

            $menuCategory->name = $request->input('name');
            $menuCategory->desc = $request->input('desc');

            $menuCategory->save();

            $responseData = $menuCategory;
            $responseData['url_edit'] = url('backoffice/layout/menu/edit-cat/'.$menuCategory->id);
            $responseData['url_delete'] = url('backoffice/layout/menu/delete-cat/'.$menuCategory->id);

            return response()->json([
                'status' => 'ok',
                'message'=> 'Data berhasil disimpan.',
                'data'   => $responseData
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