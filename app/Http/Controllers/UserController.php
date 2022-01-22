<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserCollection;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): view
    {
        $users = DB::table('users')->get();
        return view('home', ['users' => $users]);
    }
}
