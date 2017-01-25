<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('menu_category_id')->nullable()->index('menu_category_id');
			$table->string('menu_name', 80)->nullable();
			$table->string('menu_type', 3)->nullable();
			$table->string('menu_type_param', 500)->nullable();
			$table->integer('menu_parent')->nullable()->index('menu_parent');
			$table->string('is_homepage')->nullable()->default('N');
			$table->smallInteger('order')->nullable();
			$table->timestamps();

            $table->foreign('menu_category_id', 'menu_cat')->references('id')->on('menu_category')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('menu_parent', 'menu_parent')->references('id')->on('menu')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu');
	}

}
