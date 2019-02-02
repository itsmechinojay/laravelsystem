function deleteEmployee(id) {
    $.ajax({
        url: "/admin/employee/delete",
        type: "GET",
        data: { id: id },
        beforeSend: function () { },
        error: function (data) {
            if (data.readyState == 4) {
                errors = JSON.parse(data.responseText);
                $.each(errors, function (key, value) {
                    console.log({ type: 2, text: value, time: 2 });
                });
            }
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == "success") {
                getAllEmployee();
            } else {
            }
        }
    });
}

function getAllEmployee() {
    $.ajax({
        url: "/admin/employee/all",
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#employeelist")
                .DataTable()
                .destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == "success") {
                console.log(msg.employee);
                $("#employeelist").DataTable({
                    processing: true,
                    data: msg.employee,
                    responsive: true,
                    columns: [
                        { data: "id" },
                        { data: "lastname" },
                        { data: "firstname" },
                        { data: "middlename" },
                        { data: "position" },
                        { data: "email" },
                        { data: "address" },
                        { data: "city" },
                        { data: "contact" },
                        {
                            render: function (data, type, full, meta) {
                                data =
                                    '<button id="btn-employee-view" type="button" onclick="getEmployee(' +
                                    full["id"] +
                                    ');" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addModal" class="btn btn-link btn-sm" >View</button>||<button id="btn-employee-delete" type="button" onclick="deleteEmployee(' +
                                    full["id"] +
                                    ');" class="btn btn-link btn-sm" >Delete</button>';
                                return data;
                            }
                        }
                    ]
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) { // if error occured
            console.log("Error: " + thrownError);
        },
        complete: function () {
        },
    });
}

function getDeployedEmployee() {
    $.ajax({
        url: "/admin/employee/deployed" +
        $("#btn-deployed-employee").attr("data-employee-id"),
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#employeelist")
                .DataTable()
                .destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == "success") {
                console.log(msg.employee);
                $("#employeelist").DataTable({
                    processing: true,
                    data: msg.employee,
                    responsive: true,
                    columns: [
                        { data: "id" },
                        { data: "lastname" },
                        { data: "firstname" },
                        { data: "middlename" },
                        { data: "position" },
                        { data: "email" },
                        { data: "address" },
                        { data: "city" },
                        { data: "contact" },
                        {
                            render: function (data, type, full, meta) {
                                data =
                                    '<button id="btn-employee-view" type="button" onclick="getEmployee(' +
                                    full["id"] +
                                    ');" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addModal" class="btn btn-link btn-sm" >View</button>||<button id="btn-employee-delete" type="button" onclick="deleteEmployee(' +
                                    full["id"] +
                                    ');" class="btn btn-link btn-sm" >Delete</button>';
                                return data;
                            }
                        }
                    ]
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) { // if error occured
            console.log("Error: " + thrownError);
        },
        complete: function () {
        },
    });
}

function getEmployee(id) {
    $.get("/admin/show/" + id, function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            $("#lastname").val(msg.employee.lastname);
            $("#firstname").val(msg.employee.firstname);
            $("#middlename").val(msg.employee.middlename);
            $("#position").val(msg.employee.position);
            $("#email").val(msg.employee.email);
            $("#address").val(msg.employee.address);
            $("#city").val(msg.employee.city);
            $("#contact").val(msg.employee.contact);
            $("#btn-employee-add").attr("data-employee-id", id);
        }
    });
}

$(document).ready(function () {

    $("#btn-employee-create").click(function () {
        $("#form-add-employee")[0].reset();
        $("#btn-employee-add").attr("data-employee-id", 0);
    });

    getAllEmployee();
    $("#form-add-employee").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url:
                "/admin/employee/add/" +
                $("#btn-employee-add").attr("data-employee-id"),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btn-employee-add").prop("disabled", true);
            },
            error: function (data) {
                $("#btn-add-employee").prop("disabled", false);
            },
            success: function (data) {
                var msg = JSON.parse(data);
                console.log(msg);
                if (msg.result == "success") {
                    alert("success");
                    $("#form-add-employee")[0].reset();
                    $("#btn-employee-add").prop("disabled", false);
                    getAllEmployee();
                } else {
                    printErrorMsg(msg.error);
                    $("#btn-employee-add").prop("disabled", false);
                }
            }
        });
    });

    
});

