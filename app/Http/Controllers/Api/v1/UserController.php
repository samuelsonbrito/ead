<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

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

    public function verify(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        

        if($user) {
            if(password_verify($request->password, $user->password)) {
                return response()->json([
                    'success' => true,
                    'user' => [
                        'id' => $user->id,
                        'email' => $user->email
                    ]
                ]);
            }
        }

        return response()->json(['success' => false], 404);
    }
}
