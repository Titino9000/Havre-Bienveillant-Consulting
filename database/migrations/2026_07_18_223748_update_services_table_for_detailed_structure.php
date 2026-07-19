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
        Schema::table('services', function (Blueprint $table) {
            $table->string('subtitle_en')->nullable();
            $table->string('subtitle_fr')->nullable();
            $table->text('audiences_en')->nullable();
            $table->text('audiences_fr')->nullable();
            $table->text('features_en')->nullable();
            $table->text('features_fr')->nullable();
            $table->text('benefits_en')->nullable();
            $table->text('benefits_fr')->nullable();
            $table->string('cta_text_en')->nullable();
            $table->string('cta_text_fr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle_en', 'subtitle_fr',
                'audiences_en', 'audiences_fr',
                'features_en', 'features_fr',
                'benefits_en', 'benefits_fr',
                'cta_text_en', 'cta_text_fr'
            ]);
        });
    }
};
