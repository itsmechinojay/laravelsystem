function getProfile(id) {
    $.get("/employee/profile/" + id, function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            $("#lastname").val(msg.profile.lastname);
            $("#firstname").val(msg.profile.firstname);
            $("#middlename").val(msg.profile.middlename);
            $("#position").val(msg.profile.position);
            $("#email").val(msg.profile.email);
            $("#address").val(msg.profile.address);
            $("#bday").val(msg.profile.bday);
            $("#city").val(msg.profile.city);
            $("#contact").val(msg.profile.contact);
        }
    });
}

$(document).ready(function() {
   getProfile(); 
});