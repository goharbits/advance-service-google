$(document).ready(function () {
    // Open modal for edit
    $(".edit-project").on("click", function () {
        var projectId = $(this).data("id");
        var projectTitle = $(this).closest("tr").find("td:eq(0)").text();
        var projectDescription = $(this).closest("tr").find("td:eq(1)").text();

        $("#projectModalLabel").text("Edit Project");
        $("#projectForm").attr("action", "/projects/" + projectId);
        $("#project_id").val(projectId);
        $("#projectName").val(projectTitle);
        $("#projectDescription").val(projectDescription);

        $("#projectModal").modal("show");
    });

    // Open modal for create
    $('[data-action="create"]').on("click", function () {
        $("#projectModalLabel").text("Create Project");
        $("#projectForm").attr("action", "/projects");
        $("#project_id").val("");
        $("#projectName").val("");
        $("#projectDescription").val("");

        $("#projectModal").modal("show");
    });

    // Handle form submission
    $("#projectForm").on("submit", function (e) {
        e.preventDefault();

        var formData = {
            title: $("#projectName").val(),
            description: $("#projectDescription").val(),
            _token: $('meta[name="csrf-token"]').attr("content"),
        };

        var project_id = $("#project_id").val();
        if (project_id) {
            formData.id = project_id;
        }
        var url = "/projects/";
        var method = "POST";

        $.ajax({
            type: method,
            url: url,
            data: formData,
            dataType: "json",
            success: function (response) {
                console.log(response, "response");
                if (response.code == 200) {
                    $(".alert-msgs-ajax")
                        .removeClass("d-none", "alert-danger")
                        .addClass("alert-success")
                        .html(response.message);
                    location.reload();
                } else {
                    $(".alert-msgs-ajax")
                        .removeClass("d-none")
                        .addClass("alert-danger")
                        .html(response.message);
                }
            },
            error: function (error) {
                alert("An error occurred. Please try again.");
                $(".error_msg").val(error);
                $(".alert-msgs-ajax")
                    .removeClass("d-none")
                    .addClass("alert-danger")
                    .html(error);
            },
        });

        // $("#projectModal").modal("hide");
    });
});
