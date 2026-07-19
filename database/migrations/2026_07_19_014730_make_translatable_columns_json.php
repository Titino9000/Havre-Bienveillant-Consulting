<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'services' => ['title', 'description', 'short_description'],
            'sliders' => ['title', 'subtitle', 'button_text'],
            'faqs' => ['question', 'answer'],
            'knowledge_hubs' => ['title', 'content', 'excerpt']
        ];

        foreach ($tables as $table => $columns) {
            if (\Illuminate\Support\Facades\Schema::hasTable($table)) {
                $records = \Illuminate\Support\Facades\DB::table($table)->get();
                foreach ($records as $record) {
                    $updateData = [];
                    foreach ($columns as $col) {
                        if (isset($record->$col) && !is_array(json_decode($record->$col, true))) {
                            // Only encode if it's not already valid JSON
                            $updateData[$col] = json_encode(['en' => $record->$col]);
                        }
                    }
                    if (!empty($updateData)) {
                        \Illuminate\Support\Facades\DB::table($table)->where('id', $record->id)->update($updateData);
                    }
                }
            }
        }
    }

    public function down(): void
    {
        $tables = [
            'services' => ['title', 'description', 'short_description'],
            'sliders' => ['title', 'subtitle', 'button_text'],
            'faqs' => ['question', 'answer'],
            'knowledge_hubs' => ['title', 'content', 'excerpt']
        ];

        foreach ($tables as $table => $columns) {
            if (\Illuminate\Support\Facades\Schema::hasTable($table)) {
                $records = \Illuminate\Support\Facades\DB::table($table)->get();
                foreach ($records as $record) {
                    $updateData = [];
                    foreach ($columns as $col) {
                        if (isset($record->$col)) {
                            $decoded = json_decode($record->$col, true);
                            if (is_array($decoded) && isset($decoded['en'])) {
                                $updateData[$col] = $decoded['en'];
                            }
                        }
                    }
                    if (!empty($updateData)) {
                        \Illuminate\Support\Facades\DB::table($table)->where('id', $record->id)->update($updateData);
                    }
                }
            }
        }
    }
};
