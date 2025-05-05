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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id(); // auto
            $table->string('certificate_id')->unique(); // data csv
            $table->string('student_nis'); // data csv
            $table->string('title'); // input
            $table->string('description')->nullable(); // input
            $table->string('organizer'); // input
            $table->string('filename'); // data csv
            $table->date('date'); // input
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
