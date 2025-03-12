<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Project\ProjectRepository;
use App\Http\Resources\Project\ProjectCollection;
use App\Traits\ApiResponse;

class ProjectController extends Controller
{
    // Use the ApiResponse trait for standardized API responses
    use ApiResponse;

    // Display a listing of projects
    public function index(ProjectRepository $projectRepository)
    {
        // Get all projects from the repository
        $response = $projectRepository->index();

        // Transform the projects into a collection
        $projects = new ProjectCollection($response['projects']);

        // Return the view with the projects data
        return view('Project.index', compact('projects'));
    }

    // Store and update newly created project
    public function store(ProjectRepository $projectRepository, Request $request)
    {
        // Validate the request data
        $validator = $projectRepository->validation($request);
        if ($validator->fails()) {
            // If validation fails, return an error response with the first error message
            $errorMessage = $validator->errors()->first();
            return $this->error($errorMessage);
        }

        // Store the new project in the repository
        $response = $projectRepository->store($request);
        $response = json_decode($response->getContent());

        // Check if the response code is 200 (success)
        if ($response->code == 200) {
            return $this->success($response->message);
        } else {
            return $this->error($response->message);
        }
    }

    // Remove the specified project
    public function destroy(ProjectRepository $projectRepository, Request $request)
    {
        // Delete the project from the repository
        $response = $projectRepository->destroy($request);
        $response = json_decode($response->getContent());

        // Check if the response code is 200 (success)
        if ($response->code == 200) {
            return redirect()->back()->with(['success' => $response->message]);
        } else {
            return redirect()->back()->with(['error' => $response->message]);
        }
    }
}