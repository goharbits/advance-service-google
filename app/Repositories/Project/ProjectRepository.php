<?php

namespace App\Repositories\Project;

use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\Project\ProjectRepositoryInterface;
use Auth;
class ProjectRepository implements ProjectRepositoryInterface
{
    // Use the ApiResponse trait for standardized API responses
    use ApiResponse;

    // Get a paginated list of projects
    public function index()
    {
        $user  =   Auth::user();
        // Retrieve projects with pagination (15 per page)
        $getProjects = Project::where('user_id',$user->id)->simplePaginate(15);

        // Return the projects
        return [
            'projects' => $getProjects,
        ];
    }

    // Validate the request data for storing or updating a project
    public function validation($request)
    {
        // Define validation rules
        return Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:255',
        ]);
    }

    // Store a new project or update an existing one
    public function store($request)
    {
        // Assume a user ID for the sake of this example
        $user_id =  Auth::user()->id;
        $project = '';

        // Check if a project ID is provided to update an existing project
        if (isset($request->id)) {
            $project = Project::where('id', $request->id)->first();
        }

        // Prepare the data for the project
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user_id,
        ];

        // If the project exists, update it; otherwise, create a new one
        if ($project) {
            $project->update($data);
        } else {
            $project = Project::create($data);
        }

        // Return a success or error response based on the outcome
        if ($project) {
            return $this->success('Action Performed Successfully');
        } else {
            return $this->error('Some error occurred');
        }
    }

    // Delete an existing project
    public function destroy($request)
    {
        // Check if the project ID is provided in the request
        if (isset(request()->project)) {
            // Find the project by ID and delete it
            $project = Project::find(request()->project);
            $project->delete();

            // Return a success response if the project was deleted
            if ($project) {
                return $this->success('Project Deleted Successfully');
            }
            return $this->error('Some error occurred');
        }

        // Return an error response if the project ID is not provided
        return $this->error('Some error occurred');
    }
}