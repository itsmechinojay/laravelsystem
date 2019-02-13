@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Evaluation List
        </div>
        <div class="card-body">
            @if($evaluation == true)
            <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th class="text-center">Rating</th>
                        </tr>
                    </thead>
                    <tbody id="evalemp">

                    </tbody>
                </table>
                <button id="evaluate-save" type="button" class="btn btn-primary">Save</button>
            @else
            <div id="evaluation-stop">
                <h3>The Evaluation period is every month</h3>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        getEmployee();
        //checkEvaluationDate();
    });
    $('#evaluate-save').click(function(){
        addEvaluatePeriod();
    });
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
                $.each(msg.employeelist, function( index, value ) {
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

                $.each(msg.employeelist, function( index, value ) {
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

</script>
@endsection