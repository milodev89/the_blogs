<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public $timestamps = true;

    public function user()
    {
		return $this->belongsTo(User::class); 
    }

    public function status()
    {
		return $this->belongsTo(Status::class); 
    }

    public function category()
    {
		return $this->hasOne(Status::class); 
    }

    public function tags()
    {
		return $this->hasMany(Post_tag::class, 'post_id'); 
    }

    public function scopePosted($query)
    {
        return $query->where('status_id', Status::posted()->first()->id);
    }

}
