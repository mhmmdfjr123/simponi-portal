<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @package App\Models
 * @author efriandika
 */
class Download extends Model implements AuditableContract
{
    use Auditable;

	protected $table = "download";
	protected $primaryKey = 'id';

    /**
     * Audit threshold.
     *
     * @var int
     */
    protected $auditThreshold = 50;

	public function category() {
		return $this->belongsTo(DownloadCategory::class, 'download_category_id');
	}

	public function getFiles($limit, $offset, $catId = ''){
		$query = $this->select(['download.*'])->orderBy('updated_at', 'DESC');

		if($catId != '')
			$query->where('download_category_id', $catId);

		$query->where('download.status', 'P');
		$query->where('download.publish_date_start', '<=', Carbon::now());

		return $query->take($limit)->skip($offset)->get();
	}

	public function getFilesWithPagination($perPage, $catId = ''){
		$query = $this->select(['download.*'])->orderBy('updated_at', 'DESC');

		if($catId != '')
			$query->where('download_category_id', $catId);

		$query->where('download.status', 'P');
		$query->where('download.publish_date_start', '<=', Carbon::now());

		return $query->paginate($perPage);
	}
}
