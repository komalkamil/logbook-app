<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        
        $users = User::get()->findOrFail(Auth::id());

        $logbooks = Logbook::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('user.index', compact('logbooks', 'users'));
    }
}
