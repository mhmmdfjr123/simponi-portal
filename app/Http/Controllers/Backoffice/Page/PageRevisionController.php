<?php namespace App\Http\Controllers\Backoffice\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageRevision;
use App\Models\PageRevisionReason;
use App\Models\User;
use App\Notifications\PageRevisionApproved;
use App\Notifications\PageRevisionRejected;
use App\Notifications\PageRevisionSubmitted;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Kodeine\Acl\Models\Eloquent\Role;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class PageController
 * @package App\Http\Controllers\Backoffice\Page
 * @author efriandika
 */
class PageRevisionController extends Controller {

    public function __construct(){

    }

    public function index(PageRevision $pageModel){
        $data = [
            'pageTitle' => 'Revisi Halaman',
            'countListAllPage' => $pageModel::count(),
            'countListTrashPage' => $pageModel::onlyTrashed()->count(),
            'listStatus' => $pageModel->getListStatus()
        ];

        return view('backoffice.page.revision.index', $data);
    }

    public function listData(Request $request, PageRevision $page) {
        $status = $request->get('pageStatus');

        $data = $page->select(['id', 'title', 'status', 'created_at', 'deleted_at', 'publish_date_start', 'publish_date_end']);

        $data->orderBy('created_at', 'desc');

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
            ->editColumn('title', function ($model) {
                $title = $model->title;

                if($model->deleted_at != '')
                    $title .= '<div style="font-size: 10px">Dihapus pada: '.date('d-m-Y H:i:s', strtotime($model->deleted_at)).'</div>';

                if($model->status == config('enums.page_revision.status.rejected') && !is_null($model->updated_by))
                    $title .= '<div style="font-size: 10px">Ditolak oleh: '.$model->updatedBy->name.'</div>';
                if($model->status == config('enums.page_revision.status.approved') && !is_null($model->updated_by))
                    $title .= '<div style="font-size: 10px">Disetujui oleh: '.$model->updatedBy->name.'</div>';

                return $title;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('d-m-Y H:i:s');
            })
            ->editColumn('status', function ($model) {
                if($model->deleted_at == '')
                    return pageStatusTextWithStyle($model->status, $model->publish_date_start, $model->publish_date_end);
                else
                    return '-';
            })
            ->addColumn('action', function ($model) {
                if($model->deleted_at == ''){
                    $button = '<div class="btn-group">';

                    if($model->status != config('enums.page_revision.status.approved'))
                        $button .= '<a href="'.route('backoffice.page.revision.edit', [$model->id]).'" title="Ubah" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>';

                    $button .= '<a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.route('backoffice.page.revision.delete', [$model->id]).'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus?\', \'Ya, Hapus Data\', \'Tidak\');" title="Hapus" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>';
                    $button .= '</div>';
                }else{
                    $button = '-';
                }

                return $button;
            })
	        ->rawColumns(['rownum', 'status', 'title', 'action'])
            ->make(true);
    }

    public function showNewForm(PageRevision $pageRevisionModel, Page $pageModel, $pageId = ''){
        if($pageId === '') {
            // Create new one
            $data = [
                'pageTitle'     => 'Tambah Halaman',
                'listParent'    => $pageModel->listParent(),
                'nextSequenceOrder' => $pageRevisionModel->max('order') + 1
            ];

            return view('backoffice.page.revision.add', $data);
        } else {
            $page = $pageModel->findOrFail($pageId);

            // Created Page revision based on page model
            $data = [
                'pageTitle'  => 'Revisi Halaman',
                'listParent' => $pageModel->listParent(),
                'obj'        => $page,
                'originalPageId' => $page->id
            ];

            return view('backoffice.page.revision.edit', $data);
        }
    }

    public function showEditForm(Page $pageModel, PageRevision $pageRevisionModel, $id){
        $page = $pageRevisionModel->find($id);

        if(count($page) == 0)
            return redirect()->route('backoffice.page.revision.index')->withErrors(['notFound', 'Data tidak ditemukan']);

        $data = [
            'pageTitle'  => 'Revisi Halaman',
            'listParent' => $pageModel->listParent(),
            'obj'        => $page
        ];

        return view('backoffice.page.revision.edit', $data);
    }

    public function submit(PageRevision $pageRevisionModel, Request $request, Guard $auth){
        try{
            if($request->input('id') != ''){
                $page = $pageRevisionModel->findOrFail($request->input('id'));

                // Set Author
                $page->updated_by = $auth->user()->id;
            }else{
                $page = new PageRevision();

                // Set Author
                $page->created_by = $auth->user()->id;
            }

            // Set alias
            $aliasQuery = $pageRevisionModel->where('alias', $request->input('alias'));
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

            // Set status
            // Validate Status. Only Super Administrator can make status = A (Approved)
            if($request->input('status') == config('enums.page_revision.status.approved') && !$auth->user()->can('approve.page'))
                $status = 'PEN';
            else
                $status = $request->input('status') ;

            // Set Original Page
            if($request->input('page_id') != '')
                $page->page_id = $request->input('page_id');

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

            // Store Reason
            $reason = new PageRevisionReason();
            $reason->page_revision_id = $page->id;
            $reason->created_by = $auth->user()->id;
            $reason->reason = $request->input('reason');
            $reason->status = $status;
            $reason->save();

            // Is revision verified?
            if($auth->user()->can('approve.page')) {
                $createdBy = User::find($page->created_by);

                if($request->input('status') == config('enums.page_revision.status.approved')) {
                    // If status is approved
                    $this->makeRevisionPageLive($page);

                    // Send Notofication
                    $createdBy->notify(new PageRevisionApproved($auth->user(), $page));

                    return redirect()->route('backoffice.page.index')
                        ->with('success', 'Data revisi halaman disetujui dan live.');
                } else {
                    // If status = rejected

                    // Send Notofication
                    $createdBy->notify(new PageRevisionRejected($auth->user(), $page, $request->input('reason')));

                    return redirect()->route('backoffice.page.revision.approval')
                        ->with('success', 'Data revisi halaman telah ditolak.');
                }
            } else {
                // Send Notification to Super Admin
                if ($status == config('enums.page_revision.status.pending')) {
                    $this->sendNotificationToSuperAdministrator($page, $request->input('reason'));
                }

                return redirect()->route('backoffice.page.revision.index')
                    ->with('success', 'Data berhasil disimpan dan menunggu untuk diverifikasi oleh super administrator');
            }
        }catch (QueryException $e){
            \Log::error($e->getMessage());

            return redirect()->route('backoffice.page.index')->withErrors([
                'Gagal menyimpan data. Ulangi beberapa saat lagi.'
            ]);
        }
    }

    public function delete(PageRevision $pageRevision) {
        try {
            $pageRevision->delete();

            return redirect()->route('backoffice.page.revision.index')->with('success', 'Data berhasil dihapus.');
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/pages')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function approval() {
        $data = [
            'pageTitle' => 'Persetujuan Revisi Halaman',
        ];

        return view('backoffice.page.revision.approval', $data);
    }

    public function approvalList(Request $request, PageRevision $page) {
        $data = $page->select(['id', 'title', 'created_at', 'created_by']);
        $data->where('status', config('enums.page_revision.status.pending'));
        $data->orderBy('updated_at');

        $rowNum = 1;
        $startPage = $request->get('start');

        return Datatables::of($data)
            ->addColumn('rownum', function () use (&$rowNum, $startPage) {
                return $startPage + ($rowNum++);
            })
            ->editColumn('title', function ($model) {
                $title = $model->title;

                if($model->deleted_at != '')
                    $title .= '<div style="font-size: 10px">Dihapus pada: '.date('d-m-Y H:i:s', strtotime($model->deleted_at)).'</div>';

                return $title;
            })
            ->editColumn('created_by', function ($model) {
                return (!is_null($model->created_by) ? $model->createdBy->name : '-');
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($model) {
                $button = '
                        <div class="btn-group">
                            <a href="'.route('backoffice.page.revision.edit', [$model->id]).'" title="Verifikasi Revisi Halaman" class="btn btn-xs btn-primary">Verifikasi</a>
                        </div>
                    ';

                return $button;
            })
            ->rawColumns(['rownum', 'created_by', 'title', 'action'])
            ->make(true);
    }

    /**
     * Copy table from page revision into page.
     *
     * @param $revisionPage
     */
    private function makeRevisionPageLive($revisionPage) {
        if(is_null($revisionPage->page_id))
            $page = new Page();
        else
            $page = Page::findOrFail($revisionPage->page_id);

        $page->alias = $revisionPage->alias;
        $page->title = $revisionPage->title;
        $page->content = $revisionPage->content;
        $page->meta_key = $revisionPage->meta_key;
        $page->meta_desc = $revisionPage->meta_desc;
        $page->order = $revisionPage->order;
        $page->parent = $revisionPage->parent;
        $page->status = config('enums.page.status.publish');
        $page->publish_date_start = $revisionPage->publish_date_start;
        $page->publish_date_end = $revisionPage->publish_date_end;

        $page->save();
    }

    private function sendNotificationToSuperAdministrator($pageRevision, $reason) {
        $superAdminRole = Role::where('slug', 'super-administrator')->first();
        Notification::send($superAdminRole->users, new PageRevisionSubmitted(Auth::user(), $pageRevision, $reason));
    }
}