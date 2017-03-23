<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Download
 * @package App\Models
 * @author efriandika
 */
class Download extends Model
{
	protected $table = "download";
	protected $primaryKey = 'id';

	public function category() {
		return $this->belongsTo(DownloadCategory::class, 'download_category_id');
	}
}
