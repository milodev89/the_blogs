<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid', 'title', 'body', 'slug', 'user_id', 'status_id', 'category_id'
    ];

    public function user()
    {
		return $this->belongsTo(User::class); 
    }

    public function status()
    {
		return $this->hasOne(Status::class); 
    }

    public function category()
    {
		return $this->hasOne(Status::class); 
    }

    public function tags()
    {
		return $this->hasMany(Tag::class, 'post_id'); 
    }
}
