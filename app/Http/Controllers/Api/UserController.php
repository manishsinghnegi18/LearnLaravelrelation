<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect, Carbon;
use App\Models\User;

class UserController extends Controller
{
    public function user(Request $request)
    {
        $name = $request->name;
        $user = User::with(['subjects' => function ($q) use ($name) {
            if ($name)
                $q->where('name_en', $name);
        }])->first();
        return response()->json(['status' => true, 'message' => '', 'data' => ['user' => user($user)]], 200);
    }

    public function userdata(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $user = User::with(['subjects' => function ($q) use ($name) {
            if ($name)
                $q->where('name_en', 'LIKE', "%{$name}%");
        }]);
        if ($username) {
            $user = $user->where('name', 'LIKE', "%{$username}%");
        }
        return $user->get();
        return response()->json(['status' => true, 'message' => '', 'data' => ['user' => userdata($user)]], 200);
    }
}
