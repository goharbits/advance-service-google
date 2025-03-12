

@extends('layouts.app')
@section('title', 'Tasks List')

@section('content')

<div class="container dashboard-container">

    <div class="row mt-5">
        <!-- Projects Section -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Your Projects</h5>
                </div>
                <ul class="list-group list-group-flush">
                   @foreach($projects as $project)
                    <li class="list-group-item">
                        <a href="#" class="text-primary">{{ $project->title }}</a>
                    </li>
                    @endforeach

                </ul>
                <div class="card-body">
                    <a href="{{route('projects.index')}}" class="btn btn-create btn-block">View Project</a>
                </div>
            </div>
        </div>

        <!-- Tickets Section -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Assigned Tasks</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <!-- Replace with dynamic ticket data -->
                     @foreach($tasks as $task)
                    <li class="list-group-item">
                        <a href="#" class="text-primary">{{ $task->title}}</a>
                        <div class="text-muted small">Active | Assigned to You</div>
                    </li>
                    @endforeach

                    <!-- End dynamic ticket data -->
                </ul>
                <div class="card-body">
                    <a href="{{route('tasks.index')}}" class="btn btn-create btn-block">View Ticket</a>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="col-md-4">
            <div class="card stats-card">
                <h5 class="card-title mt-2">Statistics</h5>
                <p>Total Projects: <strong>{{ $projects->count() ?? 0}}</strong></p>
                <p>Active Tickets: <strong>{{ @$closedTaskCount ?? 0}}</strong></p>
                <p>Closed Tickets: <strong>{{ @$openTaskCount ?? 0}}</strong></p>

            </div>
        </div>
    </div>
</div>
@endsection
