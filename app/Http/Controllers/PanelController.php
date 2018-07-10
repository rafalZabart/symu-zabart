<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class PanelController extends Controller
{
    public function getProjects() {
        if(session('logged') && session()->exists('userId')) {
            $projects = DB::table('projects')->where([
                ['user_id', session('userId')]
            ])->get();
            $user = DB::table('users')->where([
                ['id', session('userId')] 
            ])->get();
            return view('panel', ['projects' => $projects, 'users' => $user]);
        } else {
            return view('home');
        }
    }

    public function addProjects(Request $request) {
        $randStr = str_random(20);
        DB::table('projects')->insert(
            [
                'name' => $request->input('name'), 
                'image_url' => 'storage/uploads/'.$request->file('file')->getClientOriginalName(),
                'project_url' => '/project/'.$randStr,
                'user_id' => session('userId')
            ]
        );
        if(session('logged') && session()->exists('userId')) {
            $projects = DB::table('projects')->where([
                ['user_id', session('userId')]
            ])->get();
        }
        $request->file('file')->storeAs('public/uploads', $request->file('file')->getClientOriginalName());
        $user = DB::table('users')->where([
            ['id', session('userId')] 
        ])->get();
        return view('panel', ['projects' => $projects, 'users' => $user]);
    }

    public function deleteProjects(Request $request) {
        DB::table('projects')->where('id', $request->projectId)->delete();
        if(session('logged') && session()->exists('userId')) {
            $projects = DB::table('projects')->where([
                ['user_id', session('userId')]
            ])->get();
        }
        $user = DB::table('users')->where([
            ['id', session('userId')] 
        ])->get();
        return view('panel', ['projects' => $projects, 'users' => $user]);
    }
}