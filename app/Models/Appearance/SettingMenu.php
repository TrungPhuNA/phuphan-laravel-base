<?php

namespace App\Models\Appearance;

use Illuminate\Database\Eloquent\Model;

class SettingMenu extends Model
{
    protected $table = 'setting_menus';
    protected $guarded = [''];

    protected $casts = [
        'sub_menus' => 'array'
    ];
}
