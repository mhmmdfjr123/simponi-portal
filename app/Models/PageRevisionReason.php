<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 * @author efriandika
 */
class PageRevisionReason extends Model {
    protected $table = "page_revision_reason";
    protected $primaryKey = 'id';

    public function parent(){
        return $this->belongsTo(PageRevision::class, 'page_revision_id');
    }
}