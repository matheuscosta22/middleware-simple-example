<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $user = new User();
        $user->fill($request->all());
        $user->save();
        return response()->json($user);
    }
}
