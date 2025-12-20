<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

        public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->orderBy('id', 'desc')->get();
        return response()->json($users);
    }
}