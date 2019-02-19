function getAllNotify() {
    $.ajax({
        url: '/notify',
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#notifylist').DataTable().destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == 'success') {
                console.log(msg.notifylist);
                $('#notifylist').DataTable({
                    processing: true,
                    data: msg.notifylist,
                    responsive: true,
                    columns: [
                        { data: 'id' },
                        { data: 'sender' },
                        { data: 'action' },
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

$(document).ready(function () {
    getAllNotify();

});
