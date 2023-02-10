<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comment', 'post_id', 'user_id'
    ];

    public function post()
    {
		return $this->belongsTo(Post::class); 
    }

    public function user()
    {
		return $this->belongsTo(User::class); 
    }
}
