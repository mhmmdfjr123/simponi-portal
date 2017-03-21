<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqCategory
 * @package App\Models
 * @author efriandika
 */
class FaqCategory extends Model
{
	protected $table = "faq_category";
	protected $primaryKey = 'id';

	public function faqs() {
		return $this->hasMany(Faq::class, 'faq_category_id', 'id');
	}
}
