<?php namespace App\Http\Controllers\Backoffice\Help;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
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
            'pageTitle' => 'Kategori'
        ];

        return view('backoffice.post.category.index', $data);
    }
}