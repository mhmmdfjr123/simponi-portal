<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePageTable
 * @author efriandika
 */
class CreatePageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('page', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('alias', 300);
			$table->string('title', 250);
			$table->text('content')->nullable();
			$table->string('meta_key', 100)->nullable();
			$table->string('meta_desc', 300)->nullable();
			$table->smallInteger('order');
			$table->integer('parent')->nullable()->index('parent_page');
			$table->string('status', 3)->nullable()->default('D');
			$table->dateTime('publish_date_start')->nullable();
			$table->dateTime('publish_date_end')->nullable();
			$table->timestamps();
			$table->softDeletes();

            $table->foreign('parent', 'parent_page')->references('id')->on('page')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('page');
	}

}
