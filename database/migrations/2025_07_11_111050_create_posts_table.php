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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('title');
            $table->string('slug'); // Unique slug for URLs
            $table->text('content');
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
            $table->string('description')->nullable();
            $table->enum('posted', ['yes', 'not'])->default('not'); // Enum for 'yes' or 'not'
            $table->string('image')->nullable();
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};