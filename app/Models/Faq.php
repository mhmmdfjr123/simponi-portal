<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Faq
 * @package App\Models
 * @author efriandika
 */
class Faq extends Model implements AuditableContract
{
    use Auditable;

	protected $table = "faq";
	protected $primaryKey = 'id';

    /**
     * Audit threshold.
     *
     * @var int
     */
    protected $auditThreshold = 10;

	public function category() {
		return $this->belongsTo(FaqCategory::class, 'faq_category_id');
	}
}
