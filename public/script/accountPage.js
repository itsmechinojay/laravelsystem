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
                                    '<button id="btn-account-view" type="button" onclick="getPassword(' +
                                    full["id"] +
                                    ');"  data-backdrop="static" data-toggle="modal" data-target="#resetModal" data-keyboard="false"  class="btn btn-link btn-sm" >Reset Password</button>||<button id="btn-account-delete" type="button" onclick="deleteAccount(' +
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
            $("#btn-add-account").attr("data-account-id", id);
        }
    });
}

function getPassword(id) {
    $.get("/admin/password/" + id, function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            $("#btn-password-reset").attr("data-account-id", id);
        }
    });
}



$(document).ready(function () {
    $("#btn-account-create").click(function () {
        $("#form-add-account")[0].reset();
        $("#btn-add-account").attr("data-account-id", 0);
    });

    getAllAccount();
    $("#form-add-account").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url:
                "/admin/account/add/" +
                $("#btn-add-account").attr("data-account-id"),
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


    $("#form-password-reset").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url:
                "/admin/reset/" +
                $("#btn-password-reset").attr("data-account-id"),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btn-password-reset").prop("disabled", true);
            },
            error: function (data) {
                $("#btn-password-reset").prop("disabled", false);
            },
            success: function (data) {
                var msg = JSON.parse(data);
                console.log(msg);
                if (msg.result == "success") {
                    alert("success");
                    $("#form-password-reset")[0].reset();
                    $("#btn-password-reset").prop("disabled", false);
                    getAllAccount();
                } else {
                    printErrorMsg(msg.error);
                    $("#btn-password-reset").prop("disabled", false);
                }
            }
        });
    });
});

