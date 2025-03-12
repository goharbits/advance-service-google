<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Task\TaskRepository;
use App\Http\Resources\Task\TaskCollection;
use App\Traits\ApiResponse;

class TaskController extends Controller
{
    // Use the ApiResponse trait for standardized API responses
    use ApiResponse;

    /**
     * Display a listing of the tasks.
     *
     * @param TaskRepository $taskRepository
     * @return \Illuminate\View\View
     */
    public function index(TaskRepository $taskRepository)
    {
        // Get tasks and projects from the repository
        $response = $taskRepository->index();
        $tasks = new TaskCollection($response['tasks']);
        $projects = $response['projects'];
        $searchParam = request()->project;

        // Return the view with tasks, projects, and search parameters
        return view('Task.index', compact('tasks', 'projects', 'searchParam'));
    }

    /**
     * Update the priority of a task.
     *
     * @param TaskRepository $taskRepository
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTaskPriority(TaskRepository $taskRepository, Request $request)
    {
        // Update task priority using the repository
        $response = $taskRepository->updatePriority($request);
        $response = json_decode($response->getContent());

        // Return success or error response based on the outcome
        if ($response->code == 200) {
            return $this->success($response->message);
        } else {
            return $this->error($response->message);
        }
    }

    /**
     * Remove the specified task from storage.
     *
     * @param TaskRepository $taskRepository
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TaskRepository $taskRepository, Request $request)
    {
        // Delete the task using the repository
        $response = $taskRepository->destroy($request);
        $response = json_decode($response->getContent());

        // Return success or error response based on the outcome
        if ($response->code == 200) {
            return $this->success($response->message);
        } else {
            return $this->error($response->message);
        }
    }

    /**
     * Store and update newly created task in storage.
     *
     * @param TaskRepository $taskRepository
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskRepository $taskRepository, Request $request)
    {
        // Validate the request data
        $validator = $taskRepository->validation($request);
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            return $this->error($errorMessage);
        }

        // Store the task using the repository
        $response = $taskRepository->store($request);
        $response = json_decode($response->getContent());

        // Return success or error response based on the outcome
        if ($response->code == 200) {
            return $this->success($response->message);
        } else {
            return $this->error($response->message);
        }
    }

    /**
     * Display the specified task.
     *
     * @param TaskRepository $taskRepository
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TaskRepository $taskRepository, Request $request)
    {
        // Retrieve the task using the repository
        $response = $taskRepository->show($request->task);
        $task = $response['task'];

        // Return success response with task data
        return $this->success('Data found', $task);
    }
}