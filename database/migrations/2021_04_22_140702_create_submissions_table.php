<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_id')->nullable();
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->string('std_id')->unique();
            $table->string('class');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('section');
            $table->string('gender');
            $table->date('birth_date')->nullable();
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('submissions');
    }
}
