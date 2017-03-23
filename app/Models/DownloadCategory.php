<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DownloadCategory
 * @package App\Models
 * @author efriandika
 */
class DownloadCategory extends Model
{
	protected $table = "download_category";
	protected $primaryKey = 'id';

	public function faqs() {
		return $this->hasMany(Download::class, 'download_category_id', 'id');
	}
}
