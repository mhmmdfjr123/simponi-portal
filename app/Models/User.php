<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Kodeine\Acl\Traits\HasRole;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class User
 * @package App\Models
 * @author efriandika
 */
class User extends Authenticatable implements AuditableContract
{
    use Notifiable, HasRole, SoftDeletes, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Audit threshold.
     *
     * @var int
     */
    protected $auditThreshold = 10;

    /**
     * Should the audit be strict?
     *
     * @var bool
     */
    protected $auditStrict = true;

    /**
     * Check username
     * @param String $username
     * @param String $id
     * @return Object
     */
    public function checkUsername($username, $id = ''){
        $data = User::where('username', '=', $username);

        if($id != "")$data->where('id', '<>', $id);

        return $data;
    }

    /**
     *
     * @param String $email
     * @param String $id
     * @return Object
     */
    public function checkEmail($email, $id = ''){
        $data = User::where('email', '=', $email);

        if($id != "")$data->where('id', '<>', $id);

        return $data;
    }

    public function getListStatus(){
        $query = $this->select(DB::raw('status, COUNT(*) as status_count'));
        return $query->groupBy('status')->get();
    }
}
