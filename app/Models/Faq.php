<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Faq
 * @package App\Models
 * @author efriandika
 */
class Faq extends Model
{
	protected $table = "faq";
	protected $primaryKey = 'id';

	public function category() {
		return $this->belongsTo(FaqCategory::class, 'faq_category_id');
	}
}
