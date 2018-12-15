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
                    <a class="nav-link" data-toggle="tab" href="#employees">Employees</a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#deployed">Deployed</a>
                </li>
            </ul>
        </div>
        <div class="col-9 rounded" style=" margin-left:3%">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active show" id="dashboard">

                </div>

                <div class="tab-pane fade" id="employees">
                    <div class="container">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                            ADD
                        </button>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <table id="employeelist" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Position</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Contact</th> 
                                        <th>Action</th>                                           
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="deployed">
                        <input class="rounded" type="text" placeholder="Search" style="margin-left:75%">
                        <div class="dropdown-divider"></div>
                        <table id="employeelist" class="table table-striped table-bordered" cellspacing="0" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Position</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Contact</th> 
                                    <th>Action</th>                                                  
                                </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add-employee" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="form-group col">
                            <label for="lastname" class="col col-form-label text-md-left">{{ __('Last Name') }}</label>
    
                            <div class="col">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>
    
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="firstname" class="col col-form-label text-md-left">{{ __('First Name') }}</label>
    
                            <div class="col">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>
    
                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="middlename" class="col col-form-label text-md-left">{{ __('Middle Name') }}</label>
                            <div class="col">
                                <input id="middlename" type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" value="{{ old('middlename') }}" required autofocus>
    
                                @if ($errors->has('middlename'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col">
                            <label for="position" class="col col-form-label text-md-left">{{ __('Position') }}</label>
    
                            <div class="col">
                                <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="{{ old('position') }}" required autofocus>
    
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="gender" class="col col-form-label text-md-left">{{ __('Gender') }}</label>
    
                            <div class="col">
                                <input id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required autofocus>
    
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="bday" class="col col-form-label text-md-left">{{ __('Birth Date') }}</label>
                            <div class="col">
                                <input id="bday" type="date" class="form-control{{ $errors->has('bday') ? ' is-invalid' : '' }}" name="bday" value="{{ old('bday') }}" required autofocus>
    
                                @if ($errors->has('bday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-8">
                            <label for="address" class="col col-form-label text-md-left">{{ __('Address') }}</label>
    
                            <div class="col">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>
    
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label for="city" class="col col-form-label text-md-left">{{ __('City') }}</label>
    
                            <div class="col">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required autofocus>
    
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-8">
                            <label for="email" class="col col-form-label text-md-left">{{ __('Email Address') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
    
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label for="contact" class="col col-form-label text-md-left">{{ __('Contact') }}</label>

                            <div class="col">
                                <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}" required autofocus>
    
                                @if ($errors->has('contact'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="btn-add-employee" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function(){
        getAllEmployee();
        function getAllEmployee(){
            $.ajax({
                url: '/employee/all',
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
                        console.log(msg.employee);
                        $('#employeelist').DataTable({
                            processing: true,
                            data: msg.employee,
                            responsive: true,
                            columns: [
                                { data: 'lastname'},
                                { data: 'firstname'},
                                { data: 'middlename'},
                                { data: 'position'},
                                { data: 'email'},
                                { data: 'address'},
                                { data: 'city'},
                                { data: 'contact'},
                                {
                                    'render' : function (data, type, full, meta){             
                                        data = '<button id="btn-employee-delete" type="button" class="btn btn-danger btn-sm">Delete</button>'
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
        
        $('#form-add-employee').submit(function(e){
        e.preventDefault();
		$.ajax({
	        url: "/employee/add",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
	        beforeSend: function(){ 
	          $('#btn-add-employee').prop('disabled', true);
	        },
	        error: function(data){
	          $('#btn-add-employee').prop('disabled', false);
	        },
	        success: function(data){
	          var msg = JSON.parse(data);
              console.log(msg);
	          if(msg.result == 'success'){
                alert('success');
	            $("#form-add-employee")[0].reset();
	            $('#btn-add-employee').prop('disabled', false);
	            getAllEmployee();
	          } else{
	            printErrorMsg(msg.error);
	            $('#btn-add-employee').prop('disabled', false);
	          }
	        }
            });
        });
    });
    </script>

@endsection