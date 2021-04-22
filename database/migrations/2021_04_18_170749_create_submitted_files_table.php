<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittedFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_files', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->unsignedBigInteger('submission_id');
            $table->unsignedBigInteger('assignment_id')->nullable();
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('submitted_files');
    }
}
