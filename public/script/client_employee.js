
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
                                '<button id="btn-employee-view" type="button" onclick="getEmployee(' +
                                full["id"] +
                                ');" class="btn btn-link btn-sm" >View</button>';
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

$(document).ready(function () {
    getAllEmployee();
    
});