<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(Request $request)
    {
        $user = $this->user->create([
            'password'     => \bcrypt($request->password),
            'email'      => $request->email,
            'name'      => $request->name,
            'level'      => 2
        ]);

        return response()->json($user, 201);
    }
}
