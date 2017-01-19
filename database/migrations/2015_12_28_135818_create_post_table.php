<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePostTable
 * @author efriandika
 */
class CreatePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 250);
			$table->string('alias', 300);
			$table->text('content')->nullable();
			$table->string('meta_key', 100)->nullable();
			$table->string('meta_desc', 300)->nullable();
			$table->string('status', 3)->nullable()->default('Y');
			$table->dateTime('publish_date_start')->nullable();
			$table->dateTime('publish_date_end')->nullable();
			$table->integer('created_by')->nullable()->index('created_by');
			$table->timestamps();
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->softDeletes();

            $table->foreign('created_by', 'post_created_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('updated_by', 'post_updated_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post');
	}

}
