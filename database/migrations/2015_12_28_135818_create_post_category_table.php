<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePostCategoryTable
 * @author efriandika
 */
class CreatePostCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_category', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent')->nullable()->index('parent');
			$table->string('alias', 50)->nullable();
			$table->string('name', 50)->nullable();
			$table->string('desc', 300)->nullable();
			$table->string('status', 3)->nullable()->default('Y');
			$table->smallInteger('order')->nullable();
			$table->timestamps();

            $table->foreign('parent', 'post_category_parent')->references('id')->on('post_category')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_category');
	}

}
