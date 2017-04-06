<?php namespace App\Http\Controllers\Backoffice\Layout;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BannerController extends Controller {

    private $imageSize = [
        'minWidth' => 1900, // in px
        'minHeight' => 890, // in px
        'maxSize' => 600000 // in byte
    ];

    public function index(){
        $data = [
            'pageTitle' => 'Daftar Banner',
            'banners'   => Banner::orderBy('order')->get()
        ];

        return view('backoffice.layout.banner.index', $data);
    }

    public function reOrder(Request $request) {
        try {
            \DB::beginTransaction();

            $index = 0;
            $items = $request->input('items');

            foreach($items as $item){
                $banner = Banner::find($item);
                $banner->order = $index++;
                $banner->save();
            }

            \DB::commit();

            return response()->json([
                'status' => 'ok',
                'message'=> 'Data berhasil disimpan.'
            ]);
        } catch (QueryException $e) {
            \DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message'=> 'Data gagal disimpan. Ulangi beberapa saat lagi'
            ]);
        }
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