<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class PageRevision Model
 *
 * @package App\Models
 * @author efriandika
 */
class PageRevision extends Model implements AuditableContract {

    use SoftDeletes, Auditable;

    protected $table = "page_revision";
    protected $primaryKey = 'id';

    /**
     * Audit threshold.
     *
     * @var int
     */
    protected $auditThreshold = 50;

    public function parent(){
        return $this->belongsTo(Page::class, 'parent');
    }

    public function original(){
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function getListStatus(){
        $query = $this->select(DB::raw('status, COUNT(*) as status_count'));
        return $query->groupBy('status')->get();
    }
}