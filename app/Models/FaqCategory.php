<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class FaqCategory
 * @package App\Models
 * @author efriandika
 */
class FaqCategory extends Model implements AuditableContract
{
    use Auditable;

	protected $table = "faq_category";
	protected $primaryKey = 'id';

    /**
     * Audit threshold.
     *
     * @var int
     */
    protected $auditThreshold = 50;

	public function faqs() {
		return $this->hasMany(Faq::class, 'faq_category_id', 'id');
	}
}
