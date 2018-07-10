<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function getProject(Request $request) {
        $project = DB::table('projects')->where([
            ['id', $request->projectId]
        ])->get();
        request()->session()->put('project', $project);
        $discussions = DB::table('discussion')->where([
            ['project_id', $request->projectId]
        ])->get();
        request()->session()->put('discussions', $discussions);
    }

    public function displayProject() {
        return view('project', ['project' => session('project'), 'discussions' => session('discussions')]);
    }

    public function addDiscussion(Request $request) {
        $project = session('project');
        foreach($project as $proj) {
            $projectId = $proj->id;
        }
        $id = DB::table('discussion')->insertGetId(
            ['pos_top' => $request->posTop, 'pos_left' => $request->posLeft, 'project_id' => $projectId]
        );
        //if($request->comment != "") {
            DB::table('comments')->insert(
                ['comment' => $request->comment, 'user_id' => session('userId'), 'discussion_id' => $id]
            );
        //}
        
        $discussions = DB::table('discussion')->where([
            ['project_id', $projectId]
        ])
            ->orderBy('id', 'desc')
            ->get();
        request()->session()->put('discussions', $discussions);
        
        return response()->json(['discussions' => session('discussions')]);
    }
}