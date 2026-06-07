<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_schedule_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('status')->default('confirmed'); // confirmed | cancelled | attended
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('class_schedule_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_bookings');
    }
};
