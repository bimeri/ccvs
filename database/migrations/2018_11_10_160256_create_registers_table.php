<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('semester')->nullable();
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->string('L1')->nullable(); 
            $table->string('L2')->nullable(); 
            $table->string('L3')->nullable(); 
            $table->string('L4')->nullable(); 
            $table->string('L5')->nullable(); 
            $table->string('L6')->nullable(); 
            $table->string('L7')->nullable(); 
            $table->string('L8')->nullable(); 
            $table->string('L9')->nullable(); 
            $table->string('L10')->nullable(); 
            $table->string('L11')->nullable();
            $table->string('L12')->nullable();
            $table->string('L13')->nullable();
            $table->string('L14')->nullable();
            $table->string('L15')->nullable();
            $table->string('L16')->nullable();
            $table->string('L17')->nullable();
            $table->string('L18')->nullable();
            $table->string('L19')->nullable();
            $table->string('L20')->nullable();
            $table->string('L21')->nullable();
            $table->string('L22')->nullable();
            $table->string('L23')->nullable();
            $table->string('L24')->nullable();
            $table->string('L25')->nullable();
            $table->string('L26')->nullable();
            $table->string('L27')->nullable();
            $table->string('L28')->nullable();
            $table->string('L29')->nullable();
            $table->string('L30')->nullable();
           
            $table->string('pres');
            $table->string('abs');
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
        Schema::dropIfExists('registers');
    }
}
