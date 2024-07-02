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
        Schema::create('dashboard', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp');
            $table->float('temperature');
            $table->integer('left_off_length');
            $table->integer('right_off_length');
            $table->integer('width');
            $table->string('tr_no', 6);
            $table->timestamp('started_no')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('operation_time')->nullable();
            $table->string('current_status');
            $table->float('pt_vs_art')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard');
    }
};
