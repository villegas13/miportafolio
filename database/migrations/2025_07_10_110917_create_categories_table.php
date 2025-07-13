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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title',500);
            $table->string('slug',500);
            $table->string('description', 1000)->nullable();
            $table->string('content', 1000)->nullable();
            $table->string('image', 1000)->nullable();
            $table->enum('posted', ['yes', 'not'])->default('not');
            $table->timestamp('posted_at')->nullable();
            $table->forenignId('category_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
