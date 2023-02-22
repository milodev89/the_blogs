<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getAllUsers();
    public function getUserById($userId);
    public function getUserByUuid($userUuid);
    public function updateUser($userId, array $newDetails);
}