function deleteClient(id) {
    $.ajax({
        url: "/admin/client/delete",
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
                getAllClient();
            } else {
            }
        }
    });
}
function getAllClient() {
    $.ajax({
        url: "/admin/client/all",
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#clientlist")
                .DataTable()
                .destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == "success") {
                console.log(msg.client);
                $("#clientlist").DataTable({
                    processing: true,
                    data: msg.client,
                    responsive: true,
                    columns: [
                        { data: "id" },
                        { data: "clientname" },
                        { data: "email" },
                        { data: "address" },
                        { data: "city" },
                        { data: "contact" },
                        {
                            render: function (data, type, full, meta) {
                                data =
                                    '<button id="btn-client-view" type="button" onclick="getClient(' +
                                    full["id"] +
                                    ');" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addModal" class="btn btn-link btn-sm" >Edit</button>||<button id="btn-client-delete" type="button" onclick="deleteClient(' +
                                    full["id"] +
                                    ');" class="btn btn-link btn-sm" >Delete</button>';
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

function getClient(id) {
    $.get("/admin/show/" + id, function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            $("#clientname").val(msg.client.clientname);
            $("#email").val(msg.client.email);
            $("#address").val(msg.client.address);
            $("#city").val(msg.client.city);
            $("#contact").val(msg.client.contact);
            $("#btn-client-add").attr("data-client-id", id);
        }
    });
}

$(document).ready(function () {
    $("#btn-client-create").click(function () {
        $("#form-add-client")[0].reset();
        $("#btn-client-add").attr("data-client-id", 0);
    });

    getAllClient();

    $("#form-add-client").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url:
                "/admin/client/add/" +
                $("#btn-client-add").attr("data-client-id"),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btn-add-client").prop("disabled", true);
            },
            error: function (data) {
                $("#btn-add-client").prop("disabled", false);
            },
            success: function (data) {
                var msg = JSON.parse(data);
                console.log(msg);
                if (msg.result == "success") {
                    alert("success");
                    $("#form-add-client")[0].reset();
                    $("#btn-add-client").prop("disabled", false);
                    getAllClient();
                } else {
                    printErrorMsg(msg.error);
                    $("#btn-add-client").prop("disabled", false);
                }
            }
        });
    });
});

