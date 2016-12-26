<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
use App\Models\User;

class AccountTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
        DB::table('users')->delete();

        $account = new User();
        $account->id = -1;
        $account->name = 'Super Administrator';
        $account->username = 'admin';
        $account->email = 'efriandika@gmail.com';
        $account->password = bcrypt('AB123456CD');
        $account->gender = config('enums.user.gender.male');
        $account->date_of_birth = '1991-12-05';
        $account->status = config('enums.user.status.active');
        $account->save();
	}

}
