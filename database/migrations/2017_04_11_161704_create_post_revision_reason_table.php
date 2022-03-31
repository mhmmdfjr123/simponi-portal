<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRevisionReasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_revision_reason', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_revision_id')->index('page_revision_id');
            $table->integer('created_by')->index('page_rev_reason_created_by');
            $table->text('reason');
            $table->string('status', 3)->nullable()->default('P'); // A = Approved, P = Pending, R = Rejected
            $table->timestamps();

            $table->foreign('page_revision_id', 'page_revision_id')->references('id')->on('page_revision')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_revision_reason');
    }
}
