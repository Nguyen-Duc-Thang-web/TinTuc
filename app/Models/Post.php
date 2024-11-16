<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'content',
        'is_active',
        'view'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function readHistories()
    {
        return $this->hasMany(ReadHistory::class);  // Một bài viết có thể có nhiều lượt đọc
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
