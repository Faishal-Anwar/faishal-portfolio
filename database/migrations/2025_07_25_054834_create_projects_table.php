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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('client');
            $table->string('link')->nullable();
            $table->string('image');
            $table->text('approach')->nullable();
            $table->text('vision')->nullable();
            $table->text('design')->nullable();
            $table->text('overview')->nullable();
            $table->text('conclusion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
