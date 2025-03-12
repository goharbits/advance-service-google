<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTaskModalLabel">Create Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-msgs-ajax mt-3 d-none">
                            <span class="error_msg"></span>
                        </div>
                        <form id="createTaskForm">
                            @csrf
                             <input type="hidden" id="taskId" name="id">
                            <div class="form-group">
                                <label for="project_id">Projects</label>
                                <select class="form-control" id="project_show" name="project" required>
                                    <option value="" disabled selected>Select a project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{$project->id}}">{{$project->title}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="color" class="form-control" id="color" name="color" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                             <div class="form-group">

                                <label for="project_id">Status</label>
                                <select class="form-control" id="task_status" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">DeActive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
