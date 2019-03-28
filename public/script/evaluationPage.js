var emp_id = 0;
$(document).ready(function () {
    getEmployee();
    getAllEvaluation();
    //checkEvaluationDate();
});

$('#evaluate-save').click(function () {
    addEvaluatePeriod(getEmpId());
});

var criterias = [];
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

function getCriteria() {
    $.ajax({
        url: '/evaluation/criteria',
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            var msg = JSON.parse(data);
            console.log(msg.criteria);
            $.each(msg.criteria, function (index, value) {
                var html = '<tr>';
                html += '<td>' + value['id'] + '</td>';
                html += '<td>' + value["criteria"] + '</td>';
                html += '<td>';
                html += '<select class="form-control" id="' + index + '">';
                html += '<option value="5">Excellent</option>';
                html += '<option value="4">Very Good</option>';
                html += '<option value="3">Good</option>';
                html += '<option value="2">Fair</option>';
                html += '<option value="1">Poor</option>';
                html += '</td>';
                html += '</select>';
                html += '</tr>';
                $('#tbodycriteria').append(html);
            });
        }
    });
    console.log('get criteria');
}

function addEvaluatePeriod(empid) {
    var result = 0;
    var requestData = {
        emp_id: getEmpId()
    };
    $.ajax({
        url:
            "/evaluation/addperiod",
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: "POST",
        data: requestData,
        beforeSend: function () {
        },
        error: function (data) {
        },
        success: function (data) {
            var msg = JSON.parse(data);
            console.log(msg);
            if (msg.result == "success") {
                // return msg.evalperiod_id.id;
                saveEvaulate(msg.evalperiod_id,empid);
            } else {
                printErrorMsg(msg.error);
            }
        }
    });
}

function saveEvaulate(evalid,empid) {
    console.log('save evaluation');
    $.ajax({
        url: '/evaluation/criteria',
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            var msg = JSON.parse(data);
            console.log(msg.criteria);
            $.each(msg.criteria, function (index, value) {
                console.log(index);
                var data = {
                    evalperiod_id: evalid,
                    emp_id: empid,
                    criteria_id: value["id"],
                    rating: $('#' + index).children("option:selected").val()
                };
                evaluateEmployee(data);
            });
        }
    });
}

function checkEvaluationDate() {
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
            if (msg.result == 'success') {
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

function evaluateEmployee(argdata) {
    console.log('Evaluate EMployee');
    console.log(argdata);

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

function getEmployee() {
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

                $.each(msg.employee, function (index, value) {
                    var html = '<tr>';
                    html += '<td>' + value['id'] + '</td>';
                    html += '<td>' + value['lastname'] + ',' + value['firstname'] + ' ' + value['middlename'] + '</td>';
                    // html += '<td>';
                    // html += '<select class="form-control" id="'+index+'">';
                    // html += '<option value="5">Excellent</option>';
                    // html += '<option value="4">Very Good</option>';
                    // html += '<option value="3">Good</option>';
                    // html += '<option value="2">Fair</option>';
                    // html += '<option value="1">Poor</option>';
                    // html += '</td>';
                    html += '</select>';
                    html += '<td class="text-center">' + '<button onclick="addEmpId(' + value["id"] + ');" id="btn-criteria-add" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#criteriaModal" class="btn btn-link btn-sm" >Evaluate</button>' + '</td>';
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

function addEmpId(empid) {
    this.emp_id = empid;
    console.log(this.emp_id);
    this.getCriteria();
}

function getEmpId(){
    return this.emp_id;
}