<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('class_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trainer_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('day_of_week'); // 1=Pzt ... 7=Paz (ISO-8601)
            $table->time('start_time');
            $table->time('end_time');
            $table->string('level')->default('orta');   // baslangic | orta | ileri | tum-seviyeler
            $table->unsignedSmallInteger('capacity')->default(20);
            $table->string('room')->nullable();          // Stüdyo A, Fonksiyonel Alan...
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['day_of_week', 'start_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
