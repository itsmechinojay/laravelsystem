
function getHistory() {
    $.ajax({
        url: '/deployment_history',
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#historylist').DataTable().destroy();
        },
        success: function (data) {
            var msg = JSON.parse(data);
            if (msg.result == 'success') {
                console.log(msg.historylist);
                var table = $('#history').DataTable({
                    processing: true,
                    data: msg.historylist,
                    responsive: true,
                    columns: [
                        { data: 'id' },
                        { data: 'lastname' },
                        { data: 'firstname' },
                        { data: 'middlename' },
                        { data: 'email' },
                        { data: 'pastclient' },
                        //     { data: 'needed'},
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
    getHistory();
    
});