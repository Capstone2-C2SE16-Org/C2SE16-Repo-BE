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
        Schema::create('learning_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->text('morning');
            $table->text('noon');
            $table->text('afternoon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_schedules');
    }
};
