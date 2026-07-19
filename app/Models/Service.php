<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];
    public $translatable = ['title', 'subtitle', 'description', 'short_description', 'audiences', 'features', 'benefits', 'cta_text'];
}
