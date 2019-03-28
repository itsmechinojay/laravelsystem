
function getAllEmployee() {
    $.ajax({
        url: '/client_employee/getallemployee',
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
                console.log(msg.employee);
                var table = $('#employeelist').DataTable({
                    processing: true,
                    data: msg.employee,
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
                                    '<button id="btn-request-delete" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#contractModal" class="btn btn-link btn-sm" onclick="addEmpId(' + full["id"] + ');">Make Contract</button>'
                                return data;
                            }
                        }
                    ]
                });
                var data = table.rows().data();
                console.log(data);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) { // if error occured
            console.log("Error: " + thrownError);
        },
        complete: function () {
        },
    });
}



function makeContract(id, contractyear) {
    console.log(id);
    console.log(contractyear);
    $.ajax({
        url: 'client/contract/' + id + '/' + contractyear,
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "PUT",
        beforeSend: function (xhr) {

        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == 'success') {
                console.log(msg);
                getAllEmployee();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) { // if error occured
            console.log("Error: " + thrownError);
        },
        complete: function () {
        },
    });
}
var emp_id = 0;
function addEmpId(emp_id) {
    this.emp_id = emp_id;
}

function getEmpId() {
    return this.emp_id;
}

$(document).ready(function () {

    $("#btn-contract-add").click(function () {
        makeContract(getEmpId(), $("#contractyear").val());
    });

    getAllEmployee();
});