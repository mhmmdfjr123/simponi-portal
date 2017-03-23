<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download', function (Blueprint $table) {
	        $table->increments('id', true);
	        $table->integer('download_category_id')->index('download_category_id');
	        $table->string('name', 50);
	        $table->string('desc', 300)->nullable();
	        $table->string('file_name', 500);
	        $table->string('file_mime_type', 300)->nullable();
	        $table->string('file_ext', 10)->nullable();
	        $table->integer('file_size');
	        $table->smallInteger('total_download')->default(0);
	        $table->dateTime('publish_date_start')->nullable();
	        $table->dateTime('publish_date_end')->nullable();
	        $table->string('status', 3)->default('Y');
	        $table->timestamps();

	        $table->foreign('download_category_id', 'download_id')->references('id')->on('download_category')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download');
    }
}
