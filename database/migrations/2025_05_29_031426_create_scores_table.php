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
            $table->string('result_no')->unique();
            $table->string('name');
            $table->string('no_induk', 50);
            $table->integer('score_l')->nullable();
            $table->integer('score_r')->nullable();
            $table->integer('score_total')->nullable();
            $table->string('group');
            $table->string('position');
            $table->string('category');
            $table->date('test_date')->nullable();
            $table->integer('last_score_l')->nullable();
            $table->integer('last_score_r')->nullable();
            $table->integer('last_score_total')->nullable();
            $table->timestamps();
            $table->foreign('no_induk')->references('no_induk')->on('peserta')->onDelete('cascade');
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
