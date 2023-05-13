<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseSetsTable extends Migration
{
        /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_sets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->timestamps();
        });
        
        Schema::create('exercise_set_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exercise_set_id')->constrained('exercise_sets')->onDelete('cascade');
            $table->foreignId('latex_file_id')->constrained('latex_files')->onDelete('cascade');
            $table->integer('max_points')->nullable();
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
        Schema::dropIfExists('exercise_set_files');
        Schema::dropIfExists('exercise_sets');
    }
}
