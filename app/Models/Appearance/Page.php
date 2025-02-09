<?php

namespace App\Models\Appearance;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'setting_pages';
    protected $guarded = [''];

    protected $casts = [
        'gallery' => 'array'
    ];
}
