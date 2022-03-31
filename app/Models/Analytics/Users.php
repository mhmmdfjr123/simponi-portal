<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;

/**
 * To handle S_USERS table from back end API directly
 * PS: This model will be deprecated in the future, if back end API is ready for analytical API
 *
 * @package App\Models\Analytics
 * @author efriandika
 */
class Users extends Model
{
	public $timestamps = false;

	protected $connection = 'oracle-analytics';
	protected $table = "users";
	protected $primaryKey = 'account';

	public function getIndividualAccountTotal() {
		return $this->where('type', 'PERORANGAN')->count();
	}

	public function getCompanyAccountTotal() {
		return $this->where('type', 'PERUSAHAAN')->count();
	}
}
