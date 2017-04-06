<?php namespace App\Http\Controllers\Backoffice\Layout;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class BannerController extends Controller {

    private $imageSize = [
        'minWidth' => 1900, // in px
        'minHeight' => 890, // in px
        'maxSize' => 600000 // in byte
    ];

    public function __construct(){

    }

    public function index(){
        $data = [
            'pageTitle' => 'Daftar Banner'
        ];

        return view('backoffice.layout.banner.index', $data);
    }

    public function listData(Request $request){
        $data = Banner::orderBy('created_at', 'DESC');

        $rowNum = 1;
        $startPage = $request->get('start');

        return Datatables::of($data)
            ->addColumn('rownum', function () use (&$rowNum, $startPage) {
                return $startPage + ($rowNum++);
            })
            ->editColumn('name', function ($model) {
                if($model->hyperlink != '')
                    $name = '<a href="'.$model->hyperlink.'" target="_blank">'.$model->name.'</a>';
                else
                    $name = $model->name;

                if($model->created_at != $model->updated_at)
                    $name .= '<div style="font-size: 10px; font-style: italic">Diperbarui: '.$model->updated_at->format('d-m-Y H:i:s').'</div>';

                return $name;
            })
            ->editColumn('status', function ($model) {
                return pageStatusTextWithStyle($model->status, $model->publish_date_start, $model->publish_date_end);
            })
            ->addColumn('created_date', function ($model) {
                return date('d-m-Y H:i:s', strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $button = '
                        <div class="btn-group">
                            <a href="'.url('backoffice/layout/banner/'.$model->id.'/edit').'" title="Ubah" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/layout/banner/'.$model->id.'/delete').'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus?\', \'Ya, Hapus Data\', \'Tidak\');" title="Hapus" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>
                        </div>
                    ';

                return $button;
            })
            ->rawColumns(['name', 'status', 'action'])
            ->make(true);
    }

    public function showNewForm(){
        $data = [
            'pageTitle' => 'Tambah Banner',
            'imageSize'  => $this->imageSize
        ];

        return view('backoffice.layout.banner.add', $data);
    }

    public function edit(Banner $banner){
        $data = [
            'pageTitle'  => 'Ubah Banner',
            'obj'        => $banner,
            'imageSize'  => $this->imageSize
        ];

        return view('backoffice.layout.banner.edit', $data);
    }

    public function submit(Banner $bannerModel, Request $request){
        try{
            if($request->input('id') != ''){
                $banner = $bannerModel->find($request->input('id'));
            }else{
                $banner = new Banner();
            }

            //Set status
            if($request->input('status') == 'P')
                $status = 'P';
            else
                $status = 'D';

            $banner->name = $request->input('name');
            $banner->hyperlink = $request->input('hyperlink');
            $banner->status = $status;
            $banner->publish_date_start = date('Y-m-d H:i:s', strtotime($request->input('publish_date_start').' '.$request->input('publish_time_start')));

            if($request->input('publish_date_end') != '' && $request->input('publish_time_end') != '')
                $banner->publish_date_end = date('Y-m-d H:i:s', strtotime($request->input('publish_date_end').' '.$request->input('publish_time_end')));
            else
                $banner->publish_date_end = null;

            $isImageUploaded = false;

            if($request->file('image') != ''){
                $file = $request->file('image');

                $destinationPath = public_path('file/banner');
                $filename = sha1($file->getClientOriginalName().time()).".".$file->getClientOriginalExtension();

                // Save File
                $uploadedFile = $file->move($destinationPath, $filename);

                if($uploadedFile) {
                    try {
                        // $destinationCopyPath = $destinationPath;
                        //$img = \Image::make($uploadedFile);

                        // Create standard Thumbs
                        /*
                        $img->resize(200, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($destinationCopyPath.'/'.$filename);
                        */

                        // save to DB
                        $banner->image_filename = $filename;

                        \Log::debug("Success to upload file: ". $uploadedFile);
                    } catch (QueryException $e) {
                        \Log::error($e->getMessage());

                        // Rollback uploaded file (Delete file)
                        \File::delete($uploadedFile);

                        return redirect()->back()->withErrors('Gambar gagal diupload. Silahkan coba beberapa saat lagi');
                    }
                } else {
                    return redirect()->back()->withErrors('Gambar gagal diupload. Silahkan coba beberapa saat lagi');
                }

                // Delete Old Images
                if($request->input('image_filename_old') != ''){
                    $oldFilename = $request->input('image_filename_old');

                    if(\File::exists($destinationPath.'/'.$oldFilename))
                        \File::delete($destinationPath.'/'.$oldFilename);
                }

                $isImageUploaded = true;
            }

            $banner->save();

            if($isImageUploaded)
                return redirect('backoffice/layout/banner/'.$banner->id.'/crop');
            else
                return redirect('backoffice/layout/banner')->with('success', 'Data berhasil disimpan.');
        }catch (QueryException $e){
            \Log::error($e->getMessage());

            return redirect()->back()->withErrors([
                'Gagal menyimpan data. Ulangi beberapa saat lagi.'
            ]);
        }
    }

    public function delete(Banner $banner) {
        try {
            if(!is_null($banner)) {
                // Delete file
                $originalFilePath = public_path('file/banner');

                if(\File::exists($originalFilePath.'/'.$banner->image_filename))
                    \File::delete($originalFilePath.'/'.$banner->image_filename);

                $banner->delete();

                return redirect('backoffice/layout/banner')->with('success', 'Banner dengan ID = #'.$banner->id.' telah dihapus.');
            }else{
                return redirect('backoffice/layout/banner')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/layout/banner')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    // Cropping
    public function showCroppingCanvas(Banner $banner){
        $originalImages = [];

        if($banner->image_filename == '' || !\File::exists('file/banner/'.$banner->image_filename))
            return redirect('backoffice/layout/banner')->withErrors('Crop gagal. Gambar pada banner #'.$banner->id.' tidak ditemukan');

        $originalImages[] = [
            'image_path'        => 'file/banner',
            'image_filename'    => $banner->image_filename,
            'crop_to_width'     => $this->imageSize['minWidth'],
            'crop_to_height'    => $this->imageSize['minHeight']
        ];

        $data = [
            'pageTitle'         => 'Crop Gambar',
            'originalImages'    => $originalImages,
            'id'                => $banner->id
        ];

        return view('backoffice.layout.banner.crop', $data);
    }

    public function cropImage(Request $request){
        try{
            foreach($request->input('metadata') as $input){
                $path = public_path('file/banner');

                $img = \Image::make($path.'/'.$input['filename']);
                $img->crop(round($input['width']), round($input['height']), round($input['x']), round($input['y']));

                // insert watermark at bottom-right corner with 15px offset
                // $img->insert(public_path('theme/front/images/watermark-white.png'), 'bottom-right', 15, 15);

                // Resize Cropped Image
                $img->resize($this->imageSize['minWidth'], null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.'/'.$input['filename']);
            }

            return redirect('backoffice/layout/banner')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect('backoffice/layout/banner')->withErrors('Gambar gagal diubah. Silahkan hubungi administrator');
        }
    }
}