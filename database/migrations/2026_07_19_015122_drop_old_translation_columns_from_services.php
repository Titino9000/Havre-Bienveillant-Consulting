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
            $table->dropColumn([
                'title_en', 'title_fr',
                'subtitle_en', 'subtitle_fr',
                'description_en', 'description_fr',
                'audiences_en', 'audiences_fr',
                'features_en', 'features_fr',
                'benefits_en', 'benefits_fr',
                'cta_text_en', 'cta_text_fr'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            //
        });
    }
};
