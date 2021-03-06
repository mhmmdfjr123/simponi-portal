<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @package App\Models
 * @author efriandika
 */
class Banner extends Model implements AuditableContract {

    use Auditable;

    protected $table = "banner";
    protected $primaryKey = 'id';

    /**
     * Audit threshold.
     *
     * @var int
     */
    protected $auditThreshold = 50;

    function getBanners() {
        $query = $this->select(['banner.*']);
        $query->where('banner.status', 'P');
        $query->where('banner.publish_date_start', '<=', Carbon::now());
        $query->orderBy('order')->orderBy('updated_at', 'DESC');

        return $query->get();
    }
}