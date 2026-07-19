<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class KnowledgeHub extends Model
{
    use HasTranslations;

    protected $guarded = [];
    public $translatable = ['title', 'content', 'excerpt'];
}
