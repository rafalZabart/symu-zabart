<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
         $users = DB::table('users')->get();

         return view('users', ['users' => $users]);
    }

    public function login(Request $request) {

        $user = DB::table('users')->where([
            ['mail', request()->input('email')],
            ['password', request()->input('password')]
        ])->get();

        $logged = false;
        if(sizeof($user) > 0) {
            $logged = true;
        }
        //request()->session()->put('logged', $logged);
        return view('panel', ['logged' => session('logged')]);
    }

    public function logout() {
        session()->flush();
    }

    public function ajaxRequest() {
        return view('panel');
    }

    public function ajaxRequestPost() {
        $user = DB::table('users')->where([
            ['mail', request()->input('email')],
            ['password', request()->input('password')]
        ])->get();
        $logged = false;
        if(sizeof($user) > 0) {
            $logged = true;
            request()->session()->put('userId', $user[0]->id);
        }
        request()->session()->put('logged', $logged);
        return response()->json(['logged' => $logged]);
    }
}