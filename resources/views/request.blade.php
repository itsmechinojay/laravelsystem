@extends('layouts.app') 
@section('content')
<div class="container">
    <table id="requestlist" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;margin-top:10px;text-align:center">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Job Request</th>
                <th>Job Description</th>
                <th>Number of Employee needed</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog-lg" role="document">
        <form id="form-add-request">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Employee List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <table id="employeelist" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Job Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button id="btn-add-request" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function getAllEmployee()
{
    $.ajax({
            url: '/admin/getallemployee',
            type: "GET",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#employeelist').DataTable().destroy(); 
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg.employeelist);
                    $('#employeelist').DataTable({
                        processing: true,
                        data: msg.employeelist,
                        responsive: true,
                        // columns: [
                        //     { data: 'id'},
                        //     { data: 'position'},
                        //     { data: 'description'},
                        //     { data: 'needed'},
                        //     {
                        //         'render' : function (data, type, full, meta){             
                        //             data = '<button id="btn-request-view" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#requestModal" class="btn btn-link btn-sm" >Approve</button>'
                        //             return data;
                        //         }
                        //     }
                        // ]
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // if error occured
                console.log("Error: " + thrownError);
            },
            complete: function() {
            },
        });
}

function getAllRequest(){
    $.ajax({
            url: '/admin/getallrequest',
            type: "GET",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#requestlist').DataTable().destroy(); 
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg.requestlist);
                    $('#requestlist').DataTable({
                        processing: true,
                        data: msg.requestlist,
                        responsive: true,
                        columns: [
                            { data: 'id'},
                            {
                                'render' : function (data, type, full, meta){             
                                    if(full['status'] == 0){
                                        data = '<td>Pending</td>'
                                        return data;
                                    } else{
                                        data = '<td>Approved</td>'
                                        return data;
                                    }
                                }
                            },
                            { data: 'position'},
                            { data: 'description'},
                            { data: 'needed'},
                            {
                                'render' : function (data, type, full, meta){             
                                    data = '<button id="btn-client-delete" type="button" onclick="getAllEmployee()" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#requestModal" class="btn btn-link btn-sm" >Approve</button>'
                                    return data;
                                }
                            }
                        ]
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // if error occured
                console.log("Error: " + thrownError);
            },
            complete: function() {
            },
        });
}
        $(document).ready(function(){
            getAllRequest();
            
        });
</script>
@endsection