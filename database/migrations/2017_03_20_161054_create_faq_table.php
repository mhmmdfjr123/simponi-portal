<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->increments('id', true);
	        $table->integer('faq_category_id')->index('faq_category_id');
	        $table->string('question', 300);
	        $table->text('answer');
	        $table->string('status', 3)->default('Y');
	        $table->smallInteger('order')->nullable();
            $table->timestamps();

	        $table->foreign('faq_category_id', 'faq_id')->references('id')->on('faq_category')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq');
    }
}
