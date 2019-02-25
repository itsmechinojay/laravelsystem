$(document).ready(function() {
    getEmployee();
    //checkEvaluationDate();
});
$('#evaluate-save').click(function(){
    addEvaluatePeriod();
});

function getAllEvaluation() {
$.ajax({
    url: "/admin/evaluationlist/all",
    type: "GET",
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
        $("#evaluationlist")
            .DataTable()
            .destroy();
    },
    success: function (data) {
        var msg = JSON.parse(data);
        if (msg.result == "success") {
            console.log(msg.evaluation);
            $("#evaluationlist").DataTable({
                processing: true,
                data: msg.evaluation,
                responsive: true,
                columns: [
                    { data: "id" },
                    { data: "emp_id" },
                    { data: "rating" },
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

function addEvaluatePeriod(){
    var result = 0;
    $.ajax({
        url:
            "/evaluation/addperiod",
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "POST",
        data: null,
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
                // return msg.evalperiod_id.id;
                saveEvaulate(msg.evalperiod_id);
            } else {
                printErrorMsg(msg.error);
            }
        }
    });
}

function saveEvaulate(evalid){
    $.ajax({
    url: '/client_employee/getallemployee',
    type: "GET",
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function (xhr) {
        
    },
    success: function (data) {
        var msg = JSON.parse(data);
        if (msg.result == 'success') {
            $.each(msg.employee, function( index, value ) {
                var data = {
                    evalperiod_id: evalid,
                    emp_id: value['id'],
                    rating: $('#' + index).children("option:selected").val()
                    };
                evaluateEmployee(data);
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

function checkEvaluationDate(){
    $.ajax({
    url: '/evaluation/checkevaluation',
    type: "GET",
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function (xhr) {
        
    },
    success: function (data) {
        var msg = JSON.parse(data);
        if(msg.result == 'success'){
            $("#evaluation-stop").hide();
            $("#evaluation-start").show();
        } else {
            $("#evaluation-start").hide();
            $("#evaluation-stop").show();
        }
    },
    error: function (xhr, ajaxOptions, thrownError) { // if error occured
        console.log("Error: " + thrownError);
    },
    complete: function () {
    },
});
}
function evaluateEmployee(argdata){
    $.ajax({
        url:
            "/evaluation/evaluateemployee",
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "POST",
        data: argdata,
        beforeSend: function () {
        },
        error: function (data) {
        },
        success: function (data) {
            var msg = JSON.parse(data);
            console.log(msg);
            if (msg.result == "success") {
                
            } else {
                printErrorMsg(msg.error);
            }
        }
    });
}
function getEmployee(){
$.ajax({
    url: '/client_employee/getallemployee',
    type: "GET",
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function (xhr) {
        
    },
    success: function (data) {
        var msg = JSON.parse(data);
        if (msg.result == 'success') {
            console.log(msg);

            $.each(msg.employee, function( index, value ) {
                var html = '<tr>';
                html += '<td>'+value['id']+'</td>';
                html += '<td>'+value['lastname']+','+value['firstname']+' '+ value['middlename'] +'</td>';
                html += '<td>';
                html += '<select class="form-control" id="'+index+'">';
                html += '<option value="5">Excellent</option>';
                html += '<option value="4">Very Good</option>';
                html += '<option value="3">Good</option>';
                html += '<option value="2">Fair</option>';
                html += '<option value="1">Poor</option>';
                html += '</td>';
                html += '</select>';
                html += '</tr>';
                $('#evalemp').append(html);
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