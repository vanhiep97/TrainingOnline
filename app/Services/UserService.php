<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($user)
    {
        return User::create($user);
    }

    public function updateProfile($user)
    {
        return Auth::user()->update($user);
    }

    public function changePwd($user)
    {
        return $user = Auth::user()->update($user);
    }

    public function findByEmail($email)
    {
        return User::where(['email' => $email])->first();
    }

    public function updateById($id, $data)
    {
        return User::find($id)->update(array_filter($data));
    }

    public function getAllUserByColumns($valueWhere)
    {
        return User::where('type', $valueWhere)->get();
    }
}
