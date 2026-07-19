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
        Schema::create('knowledge_hubs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('article'); // article, pdf
            $table->string('file_path')->nullable(); // For PDFs
            $table->string('image_path')->nullable();
            $table->longText('content')->nullable(); // For Articles
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_hubs');
    }
};
