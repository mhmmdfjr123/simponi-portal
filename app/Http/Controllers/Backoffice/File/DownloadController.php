<?php namespace App\Http\Controllers\Backoffice\File;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\DownloadCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

/**
 * @package App\Http\Controllers\Backoffice\File
 * @author efriandika
 */
class DownloadController extends Controller {

    protected $uploadPath = 'file/storage';

    public function index() {
    	$data = [
            'pageTitle'     => 'Daftar File Download',
		    'categories'    => DownloadCategory::orderBy('name')->get()
        ];

        return view('backoffice.file.download.index', $data);
    }

    public function listData(Request $request){
        $categoryId = $request->get('categoryId');

        $data = Download::with('category')->select('*');

        if($categoryId != '')
            $data->where("download_category_id", $categoryId);

        $rowNum = 1;
        $startPage = $request->get('start');

        return Datatables::of($data)
            ->addColumn('rownum', function () use (&$rowNum, $startPage) {
                return $startPage + ($rowNum++);
            })
	        ->editColumn('name', function ($model) {
		        $name = $model->name;

		        if($model->created_at != $model->updated_at)
		        	$name .= '<div style="font-size: 10px; font-style: italic">Diperbarui: '.$model->updated_at->format('d-m-Y H:i:s').'</div>';

		        return $name;
	        })
            ->editColumn('status', function ($model) {
                if($model->deleted_at == '')
                    return pageStatusTextWithStyle($model->status, $model->publish_date_start, $model->publish_date_end);
                else
                    return '-';
            })
            ->addColumn('created_date', function ($model) {
	            return date('d-m-Y H:i:s', strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
	            $button = '
                        <div class="btn-group">
                            <a href="'.url('backoffice/file/download/'.$model->id.'/edit').'" title="Ubah" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/file/download/'.$model->id.'/delete').'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus?\', \'Ya, Hapus Data\', \'Tidak\');" title="Hapus" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>
                        </div>
                    ';

                return $button;
            })
	        ->rawColumns(['name', 'status', 'action'])
            ->make(true);
    }

    public function add(){
        $data = [
            'pageTitle' => 'Tambah File Baru',
            'categories' => DownloadCategory::orderBy('name')->get()
        ];

        return view('backoffice.file.download.add', $data);
    }

    public function edit($id){
        $data = [
            'pageTitle'  => 'Ubah Artikel',
            'categories' => DownloadCategory::orderBy('name')->get(),
            'obj'        => Download::findOrFail($id)
        ];

        return view('backoffice.file.download.edit', $data);
    }

    public function submit(Request $request) {
        $this->validate($request, [
            'file' => 'max:51200|mimes:zip,rar,doc,docx,xls,xlsx,ppt,pptx,pdf'
        ]);

        try{
            if($request->input('id') != ''){
                $download = Download::findOrFail($request->input('id'));
            }else{
	            $download = new Download();
            }

            // Set status
            if($request->input('status') == 'P')
                $status = 'P';
            else
                $status = 'D';

	        // Upload File
	        if ($request->hasFile('file')) {
		        $file = $request->file('file');
		        $filename = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();

		        $file->move(public_path($this->uploadPath), $filename);

		        $download->file_name        = $filename;
		        $download->file_ext         = $file->getClientOriginalExtension();
		        $download->file_size        = $file->getClientSize();
		        $download->file_mime_type   = $file->getClientMimeType();

		        if ($request->input('old_file_name') != '') {
			        $oldFilename = public_path($this->uploadPath).'/'.$request->input('old_file_name');

			        if(\File::exists($oldFilename))
				        \File::delete($oldFilename);
		        }
	        }

	        // General Info
	        $download->name = $request->input('name');
	        $download->desc = $request->input('desc');
	        $download->download_category_id = $request->input('download_category_id');
	        $download->status = $status;
	        $download->publish_date_start = date('Y-m-d H:i:s', strtotime($request->input('publish_date_start').' '.$request->input('publish_time_start')));

	        $download->save();

            return redirect('backoffice/file/download')->with('success', 'Data berhasil disimpan.');
        }catch (QueryException $e){
            \Log::error($e->getMessage());

            return redirect('backoffice/file/download')->withErrors([
                'Gagal menyimpan data. Ulangi beberapa saat lagi.'
            ]);
        }
    }

    public function delete($id){
        try {
            $obj = Download::findOrFail($id);

            if(!is_null($obj)) {
            	$filename = public_path($this->uploadPath).'/'.$obj->file_name;

            	if(\File::exists($filename))
		            \File::delete($filename);

                $obj->delete();
                return redirect('backoffice/file/download')->with('success', 'Data berhasil dihapus.');
            }else{
                return redirect('backoffice/file/download')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/file/download')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }
}