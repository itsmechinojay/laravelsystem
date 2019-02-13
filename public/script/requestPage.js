function Deploy(clientname,email) {
    $.ajax({
        url: "/admin/deploy/" + $("#btn-employee-deploy").attr("data-request-client"), 
        type: "GET",
        data: [{ clientname: clientname },{ email: email }],
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

function getRequest(id) {
    $.get("/admin/show/" + id, function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            $("#btn-request-approve").attr("data-request-id", id);
        }
    });
}

function getclient(clientname) {
    $.get("/admin/show/" + clientname, function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            $("#btn-employee-deploy").attr("data-request-client", clientname);
        }
    });
}

function getAllEmployee() {
    $.ajax({
        url: '/admin/getallemployee' ,
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#employeelist').DataTable().destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == 'success') {
                console.log(msg.employeelist);
                $('#employeelist').DataTable({
                    processing: true,
                    data: msg.employeelist,
                    responsive: true,
                    columns: [
                        { data: 'id' },
                        { data: 'position' },
                        { data: 'lastname' },
                        { data: 'firstname' },
                        { data: 'middlename' },
                        //     { data: 'needed'},
                        {
                            'render': function (data, type, full, meta) {
                                data =
                                '<button id="btn-employee-deploy" type="button" onclick="deployEmployee(,' +
                                full["email"] +
                                ');" class="btn btn-link btn-sm" >Deploy</button>';
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


function getAllRequest() {
    $.ajax({
        url: '/admin/getallrequest',
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#requestlist').DataTable().destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == 'success') {
                console.log(msg.requestlist);
                $('#requestlist').DataTable({
                    processing: true,
                    data: msg.requestlist,
                    responsive: true,
                    columns: [
                        { data: 'id' },
                        { data: 'client_id' },
                        {
                            'render': function (data, type, full, meta) {
                                if (full['status'] == 0) {
                                    data = '<td>Pending</td>'
                                    return data;
                                } else {
                                    data = '<td>Approved</td>'
                                    return data;
                                }
                            }
                        },
                        { data: 'position' },
                        { data: 'description' },
                        { data: 'needed' },
                        {
                            'render': function (data, type, full, meta) {
                                if (full['status'] == 0) {
                                    data = '<button id="btn-request-update" type="button" onclick="getRequest(' +
                                    full["id"] +
                                    ')" data-toggle="modal" data-toggle="modal" data-target="#approveModal" data-backdrop="static" data-keyboard="false" class="btn btn-link btn-sm" >Approve</button>'
                                    return data;
                                } 
                                else {
                                    data ='<button id="btn-request-delete" type="button" onclick="getAllEmployee()" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#requestModal" class="btn btn-link btn-sm" >Deploy</button>'
                                    return data;
                                }
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



$(document).ready(function () {
    getAllRequest();
    $("#form-approve-request").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url:
                "/admin/request/" +
                $("#btn-request-approve").attr("data-request-id"),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btn-request-approve").prop("disabled", true);
            },
            error: function (data) {
                $("#btn-request-approve").prop("disabled", false);
            },
            success: function (data) {
                var msg = JSON.parse(data);
                console.log(msg);
                if (msg.result == "success") {
                    alert("success");
                    $("#form-approve-request")[0].reset();
                    $("#btn-request-approve").prop("disabled", false);
                    getAllRequest();
                } else {
                    printErrorMsg(msg.error);
                    $("#btn-request-approve").prop("disabled", false);
                }
            }
        });
    });
});
