<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pickup_point_id')->constrained()->cascadeOnDelete();
            $table->string('location_found');
            $table->string('photo')->nullable();
            $table->enum('status', ['tersedia', 'diverifikasi', 'terklaim'])->default('tersedia');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
