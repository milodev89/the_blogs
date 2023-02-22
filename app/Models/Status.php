<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'status';

    protected $fillable = [
        'name', 'table'
    ];

    public function scopeDraft($query)
    {
        return $query->where('name', 'Draft');
    }

    public function scopePosted($query)
    {
        return $query->where('name', 'Posted');
    }
}
