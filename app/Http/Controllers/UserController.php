<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')->get();
        return view('home', ['users'=>$users]);
    }
}
