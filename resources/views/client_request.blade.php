@extends('layouts.app') 
@section('content')
<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
        ADD
    </button>
    <input class="rounded" type="text" placeholder="Search" style="margin-left:auto">

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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-add-request">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Job Position') }}</label>

                        <div class="col-md-6">
                            <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position"
                                value="{{ old('position') }}" required> @if ($errors->has('positionl'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('position') }}</strong>
                                </span> @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"
                                value="{{ old('description') }}" required> @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span> @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="needed" class="col-md-4 col-form-label text-md-right">{{ __('Employee Needed') }}</label>

                        <div class="col-md-6">
                            <input id="needed" type="number" class="form-control{{ $errors->has('needed') ? ' is-invalid' : '' }}" name="needed" value="{{ old('needed') }}"
                                required> @if ($errors->has('needed'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('needed') }}</strong>
                                </span> @endif
                        </div>
                    </div>
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
function getRequest(){
    $.ajax({
            url: '/client_user/get_request',
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
                    console.log(msg.request);
                    $('#requestlist').DataTable({
                        processing: true,
                        data: msg.request,
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
                                    data = '<button id="btn-client-delete" type="button" onclick="deleteClient('+full['id']+');" class="btn btn-link btn-sm" >Delete</button>'
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
            getRequest();
            $('#form-add-request').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "/client_request/add",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(){ 
                      $('#btn-add-request').prop('disabled', true);
                    },
                    error: function(data){
                      $('#btn-add-request').prop('disabled', false);
                    },
                    success: function(data){
                      var msg = JSON.parse(data);
                      console.log(msg);
                      if(msg.result == 'success'){
                        alert('success');
                        getRequest();
                        $("#form-add-request")[0].reset();
                        $('#btn-add-request').prop('disabled', false);
                      } else{
                        printErrorMsg(msg.error);
                        $('#btn-add-request').prop('disabled', false);
                      }
                    }
                });
            });    
        });
        </script>
@endsection



