<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePostCategoryRelTable
 * @author efriandika
 */
class CreatePostCategoryRelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_category_rel', function(Blueprint $table)
		{
			$table->integer('post_id');
			$table->integer('post_category_id')->index('post_cat_id');
			$table->primary(['post_id','post_category_id'], 'post_cat_rel_pkey');

            $table->foreign('post_id', 'post_cat_rel_post_id')->references('id')->on('post')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('post_category_id', 'post_cat_rel_post_cat_id')->references('id')->on('post_category')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_category_rel');
	}

}
