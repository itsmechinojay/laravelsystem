function getRequest() {
    $.ajax({
        url: '/client_user/get_request',
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
                console.log(msg.request);
                $('#requestlist').DataTable({
                    processing: true,
                    data: msg.request,
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
                                data = '<button id="btn-client-delete" type="button" onclick="deleteClient(' + full['id'] + ');" class="btn btn-link btn-sm" >Delete</button>'
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
$(document).ready(function () {
    getRequest();
    $('#form-add-request').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/client_request/add",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#btn-add-request').prop('disabled', true);
            },
            error: function (data) {
                $('#btn-add-request').prop('disabled', false);
            },
            success: function (data) {
                var msg = JSON.parse(data);
                console.log(msg);
                if (msg.result == 'success') {
                    alert('success');
                    getRequest();
                    $("#form-add-request")[0].reset();
                    $('#btn-add-request').prop('disabled', false);
                } else {
                    printErrorMsg(msg.error);
                    $('#btn-add-request').prop('disabled', false);
                }
            }
        });
    });
});