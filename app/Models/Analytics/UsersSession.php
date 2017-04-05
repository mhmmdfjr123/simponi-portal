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
	    $query = \DB::connection($this->connection)->table($this->table.' as US');
        $query->join('users as U', \DB::raw('"U"."ACCOUNT"'), \DB::raw('"US"."ACCOUNT"'));

		$query->where(\DB::raw("TRUNC(dateexpires)"), \DB::raw("TO_DATE('".date('Y-m-d')."', 'YYYY-MM-DD')"));
		$query->where(function ($q) {
            $q->where(\DB::raw('"U"."TYPE"'), 'PERORANGAN');
            $q->orWhere(\DB::raw('"U"."TYPE"'), 'PERUSAHAAN');
        });

		return $query->count();
	}

	public function getRegistrationHistory($startDate, $endDate) {
        $query = \DB::connection($this->connection)->table('USERS as U');
        $query->select(\DB::raw('COUNT("U"."ACCOUNT") AS counter, "DATE_SEQ"."DATE"'));
        $query->rightJoin(
            \DB::raw('(SELECT date \''.$startDate.'\' + level - 1 As "DATE" from dual CONNECT BY LEVEL <= date \''.$endDate.'\' - date \''.$startDate.'\' + 1) "DATE_SEQ"'),
            \DB::raw('"DATE_SEQ"."DATE"'),
            '=',
            \DB::raw('"U"."DATECREATED"')
        );

        $query->groupBy(\DB::raw('"DATE_SEQ"."DATE"'));
        $query->orderBy(\DB::raw('"DATE_SEQ"."DATE"'), 'DESC');

        return $query->get();
    }
}
