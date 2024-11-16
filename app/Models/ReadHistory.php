<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadHistory extends Model
{
    use HasFactory;
    protected $table = 'read_history';
    protected $fillable = [
        'user_id',
        'post_id',
        'read_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);  // Mỗi lịch sử đọc thuộc về một người dùng
    }

    /**
     * Quan hệ với model Post (bảng posts).
     */
    public function post()
    {
        return $this->belongsTo(Post::class);  // Mỗi lịch sử đọc liên kết với một bài viết
    }
}
