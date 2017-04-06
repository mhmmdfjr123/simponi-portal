<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 300);
            $table->string('image_filename', 500);
            $table->string('hyperlink', 500)->nullable();
            $table->dateTime('publish_date_start')->nullable();
            $table->dateTime('publish_date_end')->nullable();
            $table->string('status', 3)->default('P');

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
        Schema::dropIfExists('banner');
    }
}
