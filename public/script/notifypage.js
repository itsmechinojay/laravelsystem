function getAllNotify() {
    $.ajax({
        url: "/admin/notify/all",
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#notifylist")
                .DataTable()
                .destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == "success") {
                console.log(msg.notify);
                $("#notifylist").DataTable({
                    processing: true,
                    data: msg.notify,
                    responsive: true,
                    columns: [
                        { data: "id" },
                        { data: "sender" },
                        { data: "action" },
                        {
                            render: function (data, type, full, meta) {
                                data =
                                    '<button id="btn-account-delete" type="button" onclick="deleteNotify(' +
                                    full["id"] +
                                    ');" class="btn btn-link btn-sm" >Mark as Read</button>';
                                return data;
                            }
                        }
                    ]
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            // if error occured
            console.log("Error: " + thrownError);
        },
        complete: function () { }
    });
}

function getAllClientNotify() {
    $.ajax({
        url: "/admin/clientnotify/all",
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#clientnotifylist")
                .DataTable()
                .destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == "success") {
                console.log(msg.notify);
                $("#clientnotifylist").DataTable({
                    processing: true,
                    data: msg.notify,
                    responsive: true,
                    columns: [
                        { data: "id" },
                        { data: "sender" },
                        { data: "action" },
                        {
                            render: function (data, type, full, meta) {
                                data =
                                    '<button id="btn-account-delete" type="button" onclick="deleteNotify(' +
                                    full["id"] +
                                    ');" class="btn btn-link btn-sm">Mark as Read</button>';
                                return data;
                            }
                        }
                    ]
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            // if error occured
            console.log("Error: " + thrownError);
        },
        complete: function () { }
    });
}

function deleteNotify(id) {
    $.ajax({
        url:
            "/deletenotify/" +
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
                alert("Successfully Mark as Read");

                getAllNotify();
                getAllClientNotify();
            } else {
                printErrorMsg(msg.error);
            }
        }
    });
}

$(document).ready(function () {
    getAllNotify();
    getAllClientNotify();

});
