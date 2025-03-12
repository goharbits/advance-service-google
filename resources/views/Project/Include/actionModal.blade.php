<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Create Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
             <div class="alert alert-msgs-ajax mt-3 d-none">
                <span class="error_msg"></span>
               </div>
            <form id="projectForm">
                <div class="modal-body">

                    <input type="hidden" name="project_id" id="project_id">
                    <div class="form-group">
                        <label for="projectName">Title</label>
                        <input type="text" class="form-control" id="projectName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="projectDescription">Description</label>
                        <textarea class="form-control" id="projectDescription" name="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
