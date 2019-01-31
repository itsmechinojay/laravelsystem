function deleteAccount(id) {
    $.ajax({
        url: "/admin/account/delete",
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
                getAllAccount();
            } else {
            }
        }
    });
}
function getAllAccount() {
    $.ajax({
        url: "/admin/account/all",
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#accountlist")
                .DataTable()
                .destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == "success") {
                console.log(msg.account);
                $("#accountlist").DataTable({
                    processing: true,
                    data: msg.account,
                    responsive: true,
                    columns: [
                        { data: "id" },
                        { data: "name" },
                        { data: "email" },
                        { data: "type" },
                        {
                            render: function (data, type, full, meta) {
                                data =
                                    '<button id="btn-client-view" type="button" onclick="getClient(' +
                                    full["id"] +
                                    ');" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addModal" class="btn btn-link btn-sm" >View</button>||<button id="btn-client-delete" type="button" onclick="deleteClient(' +
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

function getAccount(id) {
    $.get("/admin/show/" + id, function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            $("#clientname").val(msg.account.clientname);
            $("#email").val(msg.account.email);
            $("#address").val(msg.account.address);
            $("#city").val(msg.account.city);
            $("#contact").val(msg.account.contact);
            $("#btn-account-add").attr("data-account-id", id);
        }
    });
}

$(document).ready(function () {
    $("#btn-account-create").click(function () {
        $("#form-add-account")[0].reset();
        $("#btn-account-add").attr("data-account-id", 0);
    });

    getAllAccount();

    $("#form-add-account").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url:
                "/admin/account/add/" +
                $("#btn-account-add").attr("data-account-id"),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btn-add-account").prop("disabled", true);
            },
            error: function (data) {
                $("#btn-add-account").prop("disabled", false);
            },
            success: function (data) {
                var msg = JSON.parse(data);
                console.log(msg);
                if (msg.result == "success") {
                    alert("success");
                    $("#form-add-account")[0].reset();
                    $("#btn-add-account").prop("disabled", false);
                    getAllAccount();
                } else {
                    printErrorMsg(msg.error);
                    $("#btn-add-account").prop("disabled", false);
                }
            }
        });
    });
});

