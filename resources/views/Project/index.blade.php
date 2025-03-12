@extends('layouts.app')
@section('title', 'Projects List')
@section('content')
<div class="container">
    <h1>Projects</h1>
  <button class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#projectModal" data-action="create">Create Project</button>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            <p>{{ $message }}</p>
        </div>
    @endif
     @if ($error = Session::get('error'))
        <div class="alert alert-success mt-3">
            <p>{{ $error }}</p>
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @forelse ($projects as $project)
        <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->description }}</td>
            <td>
               <button class="btn btn-primary edit-project" data-toggle="modal" data-target="#projectModal" data-action="edit" data-id="{{ $project->id }}">Edit</button>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
 <p class="text-center"> <b> No Tasks Found</b></p>
        @endforelse
    </table>
    <div class="d-flex justify-content-center mt-4 mb-5">
        {{ $projects->links() }}
    </div>
</div>

<!-- Create and update Project Modal -->

@include('Project.Include.actionModal')
@endsection
