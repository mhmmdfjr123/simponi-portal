<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Kodeine\Acl\Traits\HasRole;

class Account extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword, HasRole, SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'account';
    protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'fullname', 'password', 'bio', 'date_of_birth', 'phone_mobile', 'address', 'status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function posts(){
        return $this->hasMany('App\Models\Post', 'account_id', 'id');
    }

    /**
     * Check username
     * @param String $username
     * @param String $id
     * @return Object
     */
    public function checkUsername($username, $id = ''){
        $data = Account::where('username', '=', $username);

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
        $data = Account::where('email', '=', $email);

        if($id != "")$data->where('id', '<>', $id);

        return $data;
    }

    /**
     * Get list user
     * @param unknown $offset
     * @param unknown $limit
     * @param unknown $search
     * @param unknown $sortCol
     * @param unknown $sortDir
     * @return unknown
     */
    public function listUser($offset, $limit, $search, $sortCol, $sortDir, $status = ''){
        if($sortCol != "")
            $query = $this->orderBy($sortCol, $sortDir);
        else
            $query = $this->orderBy("username", "asc");

        if(strtolower($status) == "deleted"){
            $query->onlyTrashed();
        }else if($status != '')
            $query->where("status", $status);

        if($search != ""){
            $query->where(function ($query) use ($search) {
                $query->where("fullname", 'ILIKE', '%'.$search.'%');
                $query->orWhere("username", 'ILIKE', '%'.$search.'%');
                $query->orWhere("email", 'ILIKE', '%'.$search.'%');
            });
        }

        if($limit == -1)return $query;
        else return $query->take($limit)->skip($offset);
    }

    /**
     * Count list of user
     * @param string $search
     * @return number
     */
    public function countListUser($search = '', $status = ''){
        $query = DB::table($this->table);

        if(strtolower($status) == "deleted"){
            $query = $this->onlyTrashed();
        }else if($status != '')
            $query->where("status", $status);


        if($search != ""){
            $query->where(function ($query) use ($search) {
                $query->where("fullname", 'ILIKE', '%'.$search.'%');
                $query->orWhere("username", 'ILIKE', '%'.$search.'%');
                $query->orWhere("email", 'ILIKE', '%'.$search.'%');
            });
        }

        return $query->count();
    }

    public function getListStatus(){
        $query = $this->select(DB::raw('status, COUNT(*) as status_count'));
        return $query->groupBy('status')->get();
    }
}
