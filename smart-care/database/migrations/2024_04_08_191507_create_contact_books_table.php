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
        Schema::create('contact_books', function (Blueprint $table) {
            $table->id();
            $table->float('height', 8, 2);
            $table->float('weight', 8, 2);
            $table->string('blood_group');
            $table->string('blood_pressure');
            $table->string('vision_test');
            $table->string('allergies');
            $table->integer('total_absences');
            $table->json('good_behavior_certificates')->nullable();
            $table->text('comment');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_books');
    }
};
