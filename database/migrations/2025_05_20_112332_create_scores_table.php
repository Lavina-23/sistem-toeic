<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id('score_id');
            $table->string('result_no');
            $table->string('name');
            $table->string('student_id');
            $table->integer('score_l')->nullable();
            $table->integer('score_r')->nullable();
            $table->integer('score_total')->nullable();
            $table->string('group');
            $table->string('position');
            $table->string('category');
            $table->date('test_date');
            $table->integer('last_score_l')->nullable();
            $table->integer('last_score_r')->nullable();
            $table->integer('last_score_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
