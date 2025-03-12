<!DOCTYPE html>
<html>
<head>
    {{-- <title>Laravel CRUD</title> --}}
    <title>@yield('title', 'Task Manager')</title>
    <!-- Include CSRF token in your main layout or the specific Blade template -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SortableJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/project.js') }}"></script>
    <script src="{{ asset('js/task.js') }}"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><b>Task Manager</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('tasks.index') }}">Tasks</a>
      </li>
      <li class="nav-item active">
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
    @yield('content')
</div>

</body>
</html>
