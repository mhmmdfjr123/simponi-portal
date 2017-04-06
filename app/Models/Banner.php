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
    protected $auditThreshold = 10;

    function getBanners() {
        $query = $this->select(['banner.*'])->orderBy('updated_at', 'DESC');
        $query->where('banner.status', 'P');
        $query->where('banner.publish_date_start', '<=', Carbon::now());
        $query->orderBy('order');

        return $query->get();
    }
}