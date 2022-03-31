<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_revision', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 300);
            $table->string('title', 250);
            $table->text('content')->nullable();
            $table->string('meta_key', 100)->nullable();
            $table->string('meta_desc', 300)->nullable();
            $table->smallInteger('order');
            $table->integer('parent')->nullable()->index('page_rev_parent_page');
            $table->string('status', 3)->nullable()->default('P'); // A = Approved, PEN = Pending, R = Rejected, D = Draft
            $table->dateTime('publish_date_start')->nullable();
            $table->dateTime('publish_date_end')->nullable();

            $table->integer('page_id')->nullable()->index('page_rev_page_id');
            $table->integer('created_by')->nullable()->index('page_rev_created_by');
            $table->integer('updated_by')->nullable()->index('page_rev_updated_by');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent', 'page_rev_parent_page')->references('id')->on('page')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('page_id', 'page_rev_page_id')->references('id')->on('page')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('created_by', 'page_rev_created_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('updated_by', 'page_rev_updated_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_revision');
    }
}
