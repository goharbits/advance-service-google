document.addEventListener("DOMContentLoaded", function () {
    var lists = document.querySelectorAll(".list");
    lists.forEach(function (list) {
        new Sortable(list, {
            group: "shared",
            animation: 150,
            ghostClass: "sortable-ghost",
            onEnd: function (/**Event*/ evt) {
                var items = evt.to.querySelectorAll(".card");
                var priorities = [];

                // Extract IDs in the new order
                items.forEach(function (item, index) {
                    priorities.push(item.dataset.id);
                });

                // Send AJAX request to update priorities
                $.ajax({
                    url: "/update-task-priority/",
                    method: "Post",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: { priorities: priorities },
                    success: function (response) {
                        console.log(
                            "Priorities updated successfully:",
                            response
                        );
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(
                            "Error updating priorities:",
                            textStatus,
                            errorThrown
                        );
                    },
                });
            },
        });
    });
});

// delete the task

$(document).ready(function () {
    // Delete Task AJAX Request
    $(".delete-task").click(function () {
        var taskId = $(this).data("id");

        if (confirm("Are you sure you want to delete this task?")) {
            $.ajax({
                url: "/tasks/" + taskId,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    // Optionally handle success response
                    console.log("Task deleted successfully:", response);
                    // Remove the task from DOM
                    $("#card" + taskId).remove();
                },
                error: function (error) {
                    console.error("Error deleting task:", error);
                    // Optionally show an error message
                },
            });
        }
    });

    $("#createTaskForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "/tasks",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: $(this).serialize(),
            success: function (response) {
                if (response.code == 200) {
                    $(".alert-msgs-ajax")
                        .removeClass("d-none", "alert-danger")
                        .addClass("alert-success")
                        .html(response.message);
                    $("#createTaskModal").modal("hide");
                    location.reload(); // Reload the page to see the new task
                } else {
                    $(".alert-msgs-ajax")
                        .removeClass("d-none", "alert-success")
                        .addClass("alert-danger")
                        .html(response.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error creating task:", textStatus, errorThrown);
                // alert("Failed to create task");

                $(".alert-msgs-ajax")
                    .removeClass("d-none", "alert-success")
                    .addClass("alert-danger")
                    .html("Some Error Occurred");
            },
        });
    });

    $("#createTaskModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var mode = button.data("mode");
        var modal = $(this);
        var form = $("#createTaskForm")[0];

        if (mode === "edit") {
            var taskId = button.data("id");
            $.ajax({
                url: "/tasks/" + taskId,
                method: "GET",
                success: function (response) {
                    console.log(response, "response");
                    if (response.code == 200) {
                        var task = response.data;
                        form.reset();
                        modal.find(".modal-title").text("Edit Task");
                        $("#taskId").val(task.id);
                        $("#title").val(task.title);
                        $("#color").val(task.color);
                        $("#description").val(task.description);
                        $("#project_show").val(task.project_id);
                        $("#task_status").val(task.status);
                    } else {
                        alert("Failed to fetch task data");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(
                        "Error fetching task data:",
                        textStatus,
                        errorThrown
                    );
                    alert("Failed to fetch task data");
                },
            });
        } else {
            form.reset();
            modal.find(".modal-title").text("Create Task");
            $("#taskId").val("");
        }
    });
});
