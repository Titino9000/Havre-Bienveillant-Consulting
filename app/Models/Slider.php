<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;

    protected $guarded = [];
    public $translatable = ['title', 'subtitle', 'button_text'];
}
