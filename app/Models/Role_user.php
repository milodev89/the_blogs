<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['role_id', 'user_id'];

    public function user(){
		return $this->hasOne(User::class); // THave one user.
    }

    public function role(){
		return $this->hasOne(Role::class); // Have one role.
    }
}
