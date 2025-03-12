@extends('layouts.app')
@section('title', 'Tasks List')

@section('content')
<div class="container-two">
     <form id="filterForm" class="d-flex align-items-center">
            <div class="form-group mb-0">
                <div class="">
                    <select class="form-control-two" id="project" name="project" required>
                        <option value="" disabled selected>Select a project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"  {{ $searchParam == $project->id ? 'selected' : '' }}>{{ $project->title }}</option>
                        @endforeach
                        <option value="">All</option>

                    </select>
                </div>
            </div>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary btn-search-box">Search</button>
            </div>
        </form>
    </div>
    <div class="container ">
        <div class="board">
            @include('Task.Include.list')
        </div>
    </div>

 @endsection
