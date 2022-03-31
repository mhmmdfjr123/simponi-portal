<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @author efriandika
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('AccountTableSeeder');
        $this->command->info('Account table seeded!');

        // Must be executed after Account Table Execution.
        $this->call('AclTableSeeder');
        $this->command->info('Acl table seeded!');
    }
}
