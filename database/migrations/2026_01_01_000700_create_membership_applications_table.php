<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_plan_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('birth_date')->nullable();
            $table->string('goal')->nullable();           // kilo verme, kas, kondisyon...
            $table->string('billing_period')->default('monthly'); // monthly | quarterly | yearly
            $table->text('message')->nullable();
            $table->string('status')->default('new');     // new | contacted | approved | rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_applications');
    }
};
