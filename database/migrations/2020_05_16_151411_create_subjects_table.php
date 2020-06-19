<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('teacher_id');
            $table->string('description')->nullable();
            $table->string('code');
            $table->integer('credit');
            $table->boolean('public')->default(false);
            $table->timestamps();
            
            $table->softDeletes();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('student_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            $table->unique(['student_id', 'subject_id']);
          
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('student_subject');
    }
}
