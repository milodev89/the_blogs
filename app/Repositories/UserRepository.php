<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Status;
use App\Models\User;

use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface 
{
    public function getAllUsers() 
    {
        return User::all();
    }

    public function getUserById($userId) 
    {
        return User::findOrFail($userId);
    }

    public function getUserByUuid($userUuid) 
    {
        return User::where(['uuid' => $userUuid])->firstOrFail();
    }    

    public function updateUser($userId, array $newDetails) 
    {
        DB::beginTransaction();
        try
        {   
            $newDetails['password'] = empty($newDetails['password']) ? null : Hash::make($newDetails['password']);
            if(empty($newDetails['password']))
                unset($newDetails['password']);
            
            $user = User::whereId($userId)->first();
            $user->update($newDetails);
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $e->getMessage();
        }
        return $user;
    }
}