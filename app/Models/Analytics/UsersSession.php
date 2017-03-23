<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Analytics
 * @author efriandika
 */
class UsersSession extends Model
{
	public $timestamps = false;

	protected $connection = 'oracle-analytics';
	protected $table = "users_session";
	protected $primaryKey = 'account';

	public function getTotalLoginOnToday() {
		$query = $this->join('users', 'users.account', '=', 'users_session.account');

		// $query->where('dateexpires', 'John');
		/*$query->where(function ($query) {
			      $query->where('users.type', 'PERORANGAN')
			            ->orWhere('users.type', 'PERUSAHAAN');
		      });*/

		return $query->count();
	}
}
