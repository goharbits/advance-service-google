<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\Task\TaskRepositoryInterface;
use Auth;

class TaskRepository implements TaskRepositoryInterface
{
    // Use the ApiResponse trait for standardized API responses
    use ApiResponse;

    /**
     * Retrieve a list of tasks with optional project filtering.
     *
     * @return array
     */
    public function index()
    {
        $user = Auth::user();
         // Initialize the query to fetch tasks with their associated project
        $query = Task::with('project');
        // Check if a project filter is applied

        if (request()->project) {
            // Filter tasks by project ID
            $query->where('project_id', request()->project);
        } else {
            // Retrieve all tasks
            $query->whereHas('project', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }
        // Order tasks by priority and paginate the results
        $getTasks = $query->orderBy('priority', 'asc')->get();

        // Retrieve all projects
        $getProjects = Project::where('user_id',$user->id)->get();

        // Return tasks and projects
        return [
            'tasks' => $getTasks,
            'projects' => $getProjects,
        ];
    }

    /**
     * Validate the task request data.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validation($request)
    {
        // Validate the request data for creating/updating a task
        return Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'description' => 'required|string',
            'project' => 'required|integer',
        ]);
    }

    /**
     * Store a newly created or updated task.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($request)
    {
        $first = Task::first();
        $priority = 1;
        $task = '';

        // Check if the request is to update an existing task
        if (isset($request->id)) {
            $task = Task::where('id', $request->id)->first();
        }

        // Prepare task data
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'project_id' => $request->project,
            'color' => $request->color,
            'status' => $request->status,
        ];

        // Update or create the task
        if ($task) {
            $task->update($data);
        } else {
            if ($first) {
                // Increment the priority based on the max existing priority
                $priority = Task::max('priority') + 1;
            }
            $data['priority'] = $priority;
            $task = Task::create($data);
        }

        // Return success or error response based on the outcome
        if ($task) {
            return $this->success('Action Performed Successfully');
        } else {
            return $this->error('Some error occurred');
        }
    }

    /**
     * Delete a specified task.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($request)
    {
        if (isset(request()->task)) {
            $task = Task::find(request()->task);
            if ($task) {
                $task->delete();
                return $this->success('Project Deleted Successfully');
            }
            return $this->error('Some error occurred');
        }

        return $this->error('Some error occurred');
    }

    /**
     * Update the priority of multiple tasks.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePriority($request)
    {
        $priorities = $request->input('priorities');
        // Update the priority for each task
        foreach ($priorities as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }
        return $this->success('Priorities updated successfully');
    }

    /**
     * Retrieve a single task by its ID.
     *
     * @param int $id
     * @return array
     */
    public function show($id)
    {
        $getTask = Task::where('id', $id)->first();
        return [
            'task' => $getTask,
        ];
    }
}