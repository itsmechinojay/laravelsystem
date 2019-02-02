function getAllEmployee(position) {
    $.ajax({
        url: '/admin/getallemployee',
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        data:{position ,position},
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
                                data = '<button id="btn-request-view" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#requestModal" class="btn btn-link btn-sm" >Deploy</button>'
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
                                    data = '<button id="btn-request-update" type="button" onclick="updateRequest()" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-link btn-sm" >Approve</button>'
                                    return data;
                                } else {
                                    data = '<button id="btn-request-delete" type="button" onclick="getAllEmployee(' +
                                    full["position"] +
                                    ')" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#requestModal" class="btn btn-link btn-sm" >Deploy</button>'
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



function updateRequest(){
    $.ajax({
        url: "/admin/action",
        type: "POST",
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

$(document).ready(function () {
    getAllRequest();

});


