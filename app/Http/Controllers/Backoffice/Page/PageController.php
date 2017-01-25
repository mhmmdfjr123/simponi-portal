<?php namespace App\Http\Controllers\Backoffice\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class PageController extends Controller {

    public function __construct(){

    }

    public function index(Page $pageModel){
        $data = [
            'pageTitle' => 'Halaman',
            'countListAllPage' => $pageModel::count(),
            'countListTrashPage' => $pageModel::onlyTrashed()->count(),
            'listStatus' => $pageModel->getListStatus()
        ];

        return view('backoffice.page.page.index', $data);
    }

    public function listData(Request $request, Page $page) {
        $status = $request->get('pageStatus');

        $data = $page->select(['id', 'title', 'status', 'created_at', 'deleted_at', 'publish_date_start', 'publish_date_end']);

        $data->orderBy('order');

        if($status != '' && strtolower($status) == "deleted"){
            $data->onlyTrashed();
        }else if($status != '')
            $data->where("status", $status);

        $rowNum = 1;
        $startPage = $request->get('start');

        return Datatables::of($data)
            ->addColumn('rownum', function () use (&$rowNum, $startPage) {
                return $startPage + ($rowNum++);
            })
            ->editColumn('status', function ($model) {
                if($model->deleted_at == '')
                    return pageStatusTextWithStyle($model->status, $model->publish_date_start, $model->publish_date_end);
                else
                    return '-';
            })
            ->addColumn('publish_date', function ($model) {
                if($model->status == 'P' && $model->deleted_at == '')
                    return date('d-m-Y H:i:s', strtotime($model->created_at));
                else
                    return '-';
            })
            ->addColumn('action', function ($model) {
                if($model->deleted_at == ''){
                    $button = '
                        <div class="btn-group">
                            <a href="'.url('backoffice/pages/'.$model->id.'/edit').'" title="Ubah" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/pages/'.$model->id.'/delete').'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus?\', \'Ya, Hapus Data\', \'Tidak\');" title="Hapus" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>
                        </div>
                    ';
                }else{
                    $button = '
                        <div class="btn-group btn-group-xs">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/pages/'.$model->id.'/delete/restore').'\', \'Konfirmasi\', \'Apakah anda yakin ingin membatalkan penghapusan data ini?\', \'Ya, restore data\', \'Tidak\');" ><i class="fa fa-rotate-left"></i> Restore Data</a></li>
                                <li><a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/pages/'.$model->id.'/delete/force').'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus data ini secara permanen?<br />Info: Data yang sudah dihapus permanan <strong>tidak dapat dipulihkan</strong> kembali\', \'Ya, Hapus Permanen\', \'Tidak\');" ><i class="fa fa-times"></i> Hapus Permanen</a></li>
                            </ul>
                        </div>
                    ';
                }

                return $button;
            })
            ->make(true);
    }

    public function showNewForm(Page $pageModel){
        $data = [
            'pageTitle'     => 'Tambah Halaman',
            'listParent'    => $pageModel->listParent(),
            'nextSequenceOrder' => $pageModel->max('order') + 1
        ];

        return view('backoffice.page.page.add', $data);
    }

    public function showEditForm(Page $pageModel, $id){
        $page = $pageModel->find($id);

        if(count($page) == 0)
            return redirect('backoffice/pages')->withErrors(['notFound', 'Data tidak ditemukan']);

        $data = [
            'pageTitle'  => 'Ubah Halaman',
            'listParent' => $page->listParent(),
            'obj'        => $page
        ];

        return view('backoffice.page.page.edit', $data);
    }

    public function submit(Page $pageModel, Request $request){
        try{
            if($request->input('id') != ''){
                $page = $pageModel->find($request->input('id'));
            }else{
                $page = new Page();
            }

            // Set alias
            $aliasQuery = $pageModel->where('alias', $request->input('alias'));
            if($request->input('alias_old') != ''){
                $aliasQuery->where('alias', '<>', $request->input('alias_old'));
            }

            $alias = $request->input('alias');

            $specialPage = array();
            foreach (config('content.page.special') as $s){
                $specialPage[] = $s['action'];
            }

            if($aliasQuery->count() > 0 || in_array($alias, $specialPage)){
                $alias = $alias.'-'.time();
            }

            //Set status
            if($request->input('status') == 'P')
                $status = 'P';
            else
                $status = 'D';

            $page->title = $request->input('title');
            $page->alias = $alias;
            $page->content = $request->input('content');
            $page->meta_key = $request->input('meta_key');
            $page->meta_desc = $request->input('meta_desc');
            $page->status = $status;

            if($request->input('parent') == '')
                $page->parent = null;
            else
                $page->parent = $request->input('parent');

            $page->order = $request->input('order');
            $page->publish_date_start = date('Y-m-d H:i:s', strtotime($request->input('publish_date_start').' '.$request->input('publish_time_start')));
            $page->save();

            return redirect('backoffice/pages')->with('success', 'Data berhasil disimpan.');
        }catch (QueryException $e){
            \Log::error($e->getMessage());

            return redirect('backoffice/pages')->withErrors([
                'Gagal menyimpan data. Ulangi beberapa saat lagi.'
            ]);
        }
    }

    public function delete($id){
        try {
            $obj = Page::find($id);

            if(count($obj) > 0){
                $obj->delete();

                // set parent of child to null
                Page::where('parent', $obj->id)->update(['parent' => null]);

                return redirect('backoffice/pages')->with('success', 'Data berhasil dihapus.');
            }else{
                return redirect('backoffice/pages')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/pages')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function restoreDeletedData(Page $pageModel, $id){
        try {
            $obj = $pageModel::onlyTrashed()->find($id);

            if(count($obj) > 0){
                $obj->restore();

                return redirect('backoffice/pages')->with('warning', 'Data telah dipulihkan dari daftar hapus (trash).');
            }else{
                return redirect('backoffice/pages')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/pages')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function forceDelete(Page $pageModel, $id){
        try {
            $obj = $pageModel::onlyTrashed()->find($id);

            if(count($obj) > 0){
                $obj->forceDelete();

                return redirect('backoffice/pages')->with('success', 'Data #'.$obj->id.' telah dihapus secara permanen.');
            }else{
                return redirect('backoffice/pages')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/pages')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }
}