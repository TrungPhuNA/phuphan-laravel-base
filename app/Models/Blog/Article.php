<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'bl_articles';
    protected $guarded = [''];

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }
}
