@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-2 rounded" style="text-align:center">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#dashboard">Dashboard</a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#clients">Clients</a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#request">Client Request</a>
                </li>
            </ul>
        </div>
        <div class="col-9 rounded" style=" margin-left:3%">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active show" id="dashboard">

                </div>

                <div class="tab-pane fade" id="clients">
                    <div class="container">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                            ADD
                        </button>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                        <table id="clientlist" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Contact</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>                                          
                                    </tr>
                                </thead>
                                <!-- <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{$client->clientname}}</td>
                                        <td>{{$client->email}}</td>
                                        <td>{{$client->contact}}</td>                                            
                                    </tr>               
                                    @endforeach
                                </tbody> -->
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="request">
                        <div class="dropdown-divider"></div>
                        <table id="employeelist" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Job Request</th>
                                    <th>Number of Employee needed</th>   
                                    <th>Action</th>                                               
                                </tr>
                            </thead>
                            <tbody>
                                   
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-add-client" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="clientname" class="col-md-4 col-form-label text-md-right">{{ __('Client Name') }}</label>

                        <div class="col-md-6">
                            <input id="clientname" type="text" class="form-control{{ $errors->has('clientname') ? ' is-invalid' : '' }}" name="clientname" value="{{ old('clientname') }}" required autofocus>

                            @if ($errors->has('clientname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('clientname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>

                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required>

                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>

                        <div class="col-md-6">
                            <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}" required>

                            @if ($errors->has('contact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="btn-add-client" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function(){
    getAllClient();
    function getAllClient(){
        $.ajax({
            url: '/client/all',
            type: "GET",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#clientlist').DataTable().destroy(); 
            },
            success: function(data) {
                var msg = JSON.parse(data);
                if(msg.result == 'success'){
                    console.log(msg.client);
                    $('#clientlist').DataTable({
                        processing: true,
                        data: msg.client,
                        responsive: true,
                        columns: [
                            { data: 'id'},
                            { data: 'clientname'},
                            { data: 'email'},
                            { data: 'address'},
                            { data: 'city'},
                            { data: 'contact'},
                            { data: 'created_at'},
                            { data: 'updated_at'}
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
    

    $('#form-add-client').submit(function(e){
        e.preventDefault();
		$.ajax({
	        url: "/client/add",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
	        beforeSend: function(){ 
	          $('#btn-add-client').prop('disabled', true);
	        },
	        error: function(data){
	          $('#btn-add-client').prop('disabled', false);
	        },
	        success: function(data){
	          var msg = JSON.parse(data);
              console.log(msg);
	          if(msg.result == 'success'){
                alert('success');
	            $("#form-add-client")[0].reset();
	            $('#btn-add-client').prop('disabled', false);
	            getAllClient();
	          } else{
	            printErrorMsg(msg.error);
	            $('#btn-add-client').prop('disabled', false);
	          }
	        }
	      });
		
	});
});
</script>
@endsection