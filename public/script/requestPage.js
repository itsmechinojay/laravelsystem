var clientname;
var position;
var client;

function getAllEmployee(position, client) {
    this.clientname = client;
    this.position = position;
    this.client = client;
    console.log('Deploy: ' + position);
    $.ajax({
        url: '/admin/getallemployee/' + position,
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function (xhr) {
            $('#employeelist').DataTable().destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == 'success') {
                console.log(msg);
                $('#employeelist').DataTable({
                    processing: true,
                    data: msg.employeelist,
                    responsive: true,
                    columns: [
                        { data: 'lastname' },
                        { data: 'firstname' },
                        { data: 'middlename' },
                        { data: 'email' },
                        //     { data: 'needed'},
                        {
                            'render': function (data, type, full, meta) {
                                data =
                                    '<button id="btn-employee-deploy" type="button" onclick="deployEmployee(' + full['id'] + ',\'' + this.clientname + '\')" class="btn btn-link btn-sm" >Deploy</button>';
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



function getRequest(id) {
    $.get("/admin/show/" + id, function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            $("#btn-request-approve").attr("data-request-id", id);
        }
    });
}
function deployEmployee(positionid, clientname, ) {
    $.ajax({
        url: 'request/update/' + positionid + '/' + clientname,
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "PUT",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function (xhr) {

        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == 'success') {
                console.log(msg);
                getAllEmployee(position, client);
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
                                    data = '<button id="btn-approve" type="button" onclick="approveRequest(' + full['id'] + ')" class="btn btn-link">Approve</button>'
                                    return data;
                                }
                                else {
                                    data = '<button id="btn-request-delete" type="button" onclick="getAllEmployee(\'' + full["position"] + '\',\'' + full["client_id"] + '\');" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#requestModal" class="btn btn-link btn-sm" >Deploy</button> || <button class="btn btn-link" id="btn-request-delete" type="button" onclick="closeRequest(' + full['id'] + ');">Close</button>'
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

function closeRequest(client_id) {
    $.ajax({
        url: 'request/closerequest/' + client_id,
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "PUT",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function (xhr) {

        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == 'success') {
                console.log(msg);
                getAllRequest();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) { // if error occured
            console.log("Error: " + thrownError);
        },
        complete: function () {
        },
    });
}

function approveRequest(id) {
    $.ajax({
        url:
            "/admin/request/" +
            id,
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
        },
        error: function (data) {
        },
        success: function (data) {
            var msg = JSON.parse(data);
            console.log(msg);
            if (msg.result == "success") {
                alert("success");
                
                getAllRequest();
            } else {
                printErrorMsg(msg.error);
            }
        }
    });
}
$(document).ready(function () {
    getAllRequest();

});
