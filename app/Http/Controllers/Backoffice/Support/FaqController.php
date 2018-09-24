<?php namespace App\Http\Controllers\Backoffice\Support;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers\Backoffice\Help
 * @author efriandika
 */
class FaqController extends Controller {

    public function __construct(){

    }

    public function index(){
        $data = [
            'pageTitle' => 'FAQ'
        ];

        return view('backoffice.support.faq.index', $data);
    }

	public function showFaq(Request $request){
		$this->ajaxChecker($request);
		return view('backoffice.support.faq.showFaq', [
			'faqCategories' => FaqCategory::with(['faqs' => function ($query) {
				$query->orderBy('order');
			}])->orderBy('order')->get()
		]);
	}

	// FAQ Category Management
	public function addCategory(Request $request){
		$this->ajaxChecker($request);
		return view('backoffice.support.faq.addCategory');
	}

	public function editCategory(Request $request, $id){
		$this->ajaxChecker($request);
		try {
			$obj = FaqCategory::find($id);

			if(!is_null($obj)) {
				$data = [
					'pageTitle'  => 'Ubah Kategori',
					'obj'        => $obj
				];

				return view('backoffice.support.faq.editCategory', $data);
			}else{
				return response('Not Found.', 404);
			}
		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return response('Something wrong.', 500);
		}
	}

	public function deleteCategory(Request $request, $id){
		try {
			$obj = FaqCategory::find($id);

            if(!is_null($obj)) {
				$obj->delete();

				return redirect('backoffice/support/faq')->with('success', 'Kategori FAQ berhasil dihapus.');
			}else{
				return redirect('backoffice/support/faq')->withErrors([
					'Data tidak ditemukan.'
				]);
			}
		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return redirect('backoffice/support/faq')->withErrors([
				'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
			]);
		}
	}

	public function submitCategory(Request $request){
		try {
			$id = $request->input('id');

			if($id != ""){
				$faqCategory = FaqCategory::find($id);

				if(count($faqCategory) == 0){
					return response()->json([
						'status' => 'error',
						'message'=> 'Data tidak ditemukan.'
					]);
				}
			}else{
				$faqCategory = new FaqCategory();
				$faqCategory->order = FaqCategory::max('order') + 1;
			}

			$faqCategory->name = $request->input('name');
			$faqCategory->desc = $request->input('desc');
			$faqCategory->status = ($request->input('status') == 'Y') ? 'Y':'N';

			$faqCategory->save();

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

	public function reOrderFaqCategories(Request $request) {
		try {
			\DB::beginTransaction();

			$index = 0;
			$items = $request->input('items');

			foreach($items as $item){
				$faqCategory = FaqCategory::find($item);
				$faqCategory->order = $index++;
				$faqCategory->save();
			}

			\DB::commit();

			return response()->json([
				'status' => 'ok',
				'message'=> 'Data berhasil disimpan.'
			]);
		} catch (QueryException $e) {
			\DB::rollBack();

			\Log::error($e->getMessage());

			return response()->json([
				'status' => 'error',
				'message'=> 'Data gagal disimpan. Ulangi beberapa saat lagi'
			]);
		}
	}

	// FAQ Management
	public function addItem($faqCategoryId) {
		$data = [
			'pageTitle'     => 'Tambah FAQ',
			'faqCategory'   => FaqCategory::FindOrFail($faqCategoryId)
		];

		return view('backoffice.support.faq.addItem', $data);
	}

	public function editItem($id) {
		$obj = Faq::findOrFail($id);

		$data = [
			'pageTitle'     => 'Ubah FAQ',
			'obj'           => $obj,
			'faqCategory'   => $obj->category
		];

		return view('backoffice.support.faq.editItem', $data);
	}

	public function submitItem(Request $request) {
		try {
			$id = $request->input('id');

			if($id != ""){
				$faq = Faq::find($id);

				if(count($faq) == 0){
					return response()->json([
						'status' => 'error',
						'message'=> 'Data tidak ditemukan.'
					]);
				}
			}else{
				$faq = new Faq();
				$faq->order = Faq::max('order') + 1;
				$faq->faq_category_id = $request->input('faq_category_id');
			}

			$faq->question = $request->input('question');
			$faq->answer = $request->input('answer');
			$faq->status = ($request->input('status') == 'Y') ? 'Y':'N';

			$faq->save();

			return redirect('backoffice/support/faq')->with('success', 'Data berhasil disimpan.');

		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return redirect('backoffice/support/faq')->withErrors([
				'Data gagal disimpan. Ulangi beberapa saat lagi'
			]);
		}
	}

	public function deleteItem($id) {
		try {
			$obj = Faq::find($id);

            if(!is_null($obj)) {
				$obj->delete();

				return redirect('backoffice/support/faq')->with('success', 'Item FAQ berhasil dihapus.');
			}else{
				return redirect('backoffice/support/faq')->withErrors([
					'Data tidak ditemukan.'
				]);
			}
		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return redirect('backoffice/support/faq')->withErrors([
				'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
			]);
		}
	}

	public function reOrderFaqItems(Request $request) {
		try {
			\DB::beginTransaction();

			$index = 0;
			$items = $request->input('items');
			$faqCategoryId = $request->input('parentId');

			foreach($items as $item){
				$faq = Faq::find($item);
				$faq->faq_category_id = $faqCategoryId;
				$faq->order = $index++;
				$faq->save();
			}

			\DB::commit();

			return response()->json([
				'status' => 'ok',
				'message'=> 'Data berhasil disimpan.'
			]);
		} catch (QueryException $e) {
			\DB::rollBack();

			\Log::error($e->getMessage());

			return response()->json([
				'status' => 'error',
				'message'=> 'Data gagal disimpan. Ulangi beberapa saat lagi'
			]);
		}
	}

	private function ajaxChecker(Request $request) {
		if(!$request->ajax())
			abort(404);
	}
}