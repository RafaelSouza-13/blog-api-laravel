<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getPosts(){
        $user = auth()->user();
        return response()->json($user, 200);
    }
}
