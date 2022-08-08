<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug'];

    public function posts(){
        // 分類會對應多篇文章，所以用複數。
        return $this->hasMany('App\Models\Post');
    }
}
