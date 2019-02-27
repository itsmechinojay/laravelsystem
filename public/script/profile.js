function getProfile() {
    $.ajax({
        url: "/employee/profile/" + email,
        type: "GET",
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == "success") {
                console.log(msg);
                $("#lastname").val(msg.profile.lastname);
            }
        }
    });
}

$(document).ready(function () {
    getProfile();
});