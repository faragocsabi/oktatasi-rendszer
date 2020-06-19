<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string('solution');
            $table->integer('grade')->nullable();
            $table->string('gradetext')->nullable();
            
            $table->boolean('checked')->default(false);
            $table->date('checked_at')->nullable();
            $table->date('uploaded_at');

            $table->string('filename')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('task_id');
            $table->timestamps();

            
            $table->softDeletes();
            
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solutions');
    }
}
