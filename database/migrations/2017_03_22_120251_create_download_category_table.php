<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_category', function (Blueprint $table) {
	        $table->increments('id', true);
	        $table->string('name', 50);
	        $table->string('alias', 300);
	        $table->string('desc', 300)->nullable();
	        $table->string('status', 3)->default('Y');
	        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_category');
    }
}
