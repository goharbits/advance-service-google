<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Auth;
class DashboardController extends Controller
{
    public function index(){

    $user_id  =   Auth::user();
    $projects =  Project::where('user_id',$user_id->id)->get();
    $user     = User::find($user_id->id);
    $tasks = $user->highPriorityTasks(3);
    $closedTaskCount = Task::whereHas('project', function ($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })
                        ->where('tasks.status',0)
                        ->count();
    $openTaskCount = Task::whereHas('project', function ($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })
                        ->where('tasks.status',1)
                        ->count();

      return view('dashboard',compact('projects','tasks','closedTaskCount','openTaskCount'));
    }

}