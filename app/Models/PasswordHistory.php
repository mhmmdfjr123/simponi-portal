<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class PasswordHistory extends Model implements AuditableContract{
    use Auditable;

    /**
     * Audit threshold.
     *
     * @var int
     */
    protected $auditThreshold = 50;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
