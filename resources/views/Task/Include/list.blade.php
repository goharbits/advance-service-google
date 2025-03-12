        <div class="list-box" >
            <div class="list-header">Task List  <button class="btn btn-light float-right" data-toggle="modal" data-target="#createTaskModal"><b>Create Task</b> </button></div>
            <div class="list-container">
                <div class="list" id="list1">
                    @forelse($tasks as $task)
                    <div class="card" id="card{{ $task->id }}" data-id="{{ $task->id }}">
                        <div class="card-header cursor-pointer">
                            <h5 class="card-title">{{ $task->title }}</h5>
                            <span class="badge  badge-info p-2" style="background: {{$task->color}};">{{ @$task->project->title }}</span>
                        </div>
                        <div class="card-body">
                            <p class="float-right mb-0"> <span class="badge p-2 {{ $task->status == 1 ? ' badge-primary' : ' badge-danger' }}">
                                {{ $task->status === 1 ? 'Active' : 'Deactive' }}
                                </span> </p>
                            <p class="card-text">{{ $task->description }}</p>

                        </div>
                        <div class="card-footer">
                            <p class="mb-0">{{ $task->created_at->format('D, M-d-Y H:i:s') }}</p>

                            <div class="card-footer-box">
                                <button class="btn btn-primary float-right" data-toggle="modal" data-id="{{ $task->id }}" data-target="#createTaskModal" data-mode="edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-danger float-right delete-task" data-id="{{ $task->id }}"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center"> <b> No Tasks Found</b></p>
                    @endforelse
                    </div>

                </div>
            </div>
        </div>

        @include('Task.Include.actionModal')
