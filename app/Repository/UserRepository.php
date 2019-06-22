<?php


namespace App\Repository;


use App\User;

class UserRepository extends Repository
{
    function __construct()
    {
        parent::__construct(User::class);
    }
}
