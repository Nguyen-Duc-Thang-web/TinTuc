<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'is_approve',
        'is_hidden',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'edited' => 'boolean',
        'is_approve' => 'boolean',
        'is_hidden' => 'boolean',
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    // Định nghĩa mối quan hệ với các bảng khác nếu cần
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
