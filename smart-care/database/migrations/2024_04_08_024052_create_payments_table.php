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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(0);
            $table->string('tnx_ref');
            $table->integer('total_amount');
            $table->dateTime('date_of_payment', $precision = 0)->nullable();
            $table->unsignedBigInteger('tuition_id');
            $table->foreign('tuition_id')->references('id')->on('tuitions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
