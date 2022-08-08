<?php
// 此為mvc中的m，-c為controller，-cr即controller+resource
// 大多同時建立migration，model命名基本上使用單數
// https://laravel.com/docs/9.x/eloquent
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content'];
    use SoftDeletes;
    public function category()
    {
        // 一篇文章只會有一個分類所以使用單數
        return $this->belongsTo('App\Models\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function toTagString()
    {
        $tagTitle = [];
        foreach ($this->tags as $tag) {
            $tagTitle[] = $tag->title;
        };
        $tagTiltleString = implode('、', $tagTitle);
        return $tagTiltleString;
    }

}
