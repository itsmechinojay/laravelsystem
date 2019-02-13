@extends('layouts.app') 

@section('content')

<div class="container">
    <button type="button" id="btn-client-create" class="btn btn-link" data-toggle="modal" data-target="#addModal">Add Account</button>
    <table id="accountlist" class="display table-striped table-bordered text-center" style="width:100%;margin-top:10px;background-color:ghostwhite">
        <thead class="text-light" style="background-color:black">                                                                                                                                                         
            <tr>
                <th style="width:10px">#</th>
                <th  style="width:50px">Employee Name/Client Name</th>
                <th  style="width:50px">Email</th>
                <th style="width:50px">Account Type</th>
                <th style="width:50px">Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-add-account" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  placeholder="{{ __('Name') }}" required autofocus>
    
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required>
    
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="{{ __('Password') }}" name="password" required>
    
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                    </div>
    
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <select class="custom-select" id="type" name="type"  required>
                            <option value="Admin">Admin</option>
                            <option value="Client">Client</option>
                            <option value="Employee">Employee</option>
                        </select>
    
                    </div>
    
                    <button id="btn-add-account" type="submit" class="btn btn-block btn-success btn-primary">
                        {{ __('Create Account') }}
                    </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade ml-auto mr-auto" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true" style="width:30%">
    <div class="modal-dialog-lg" role="document">
        <form id="form-password-reset">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Reset Password?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary close" data-dismiss="modal">No</button>
                    <button id="btn-password-reset" type="submit" class="btn btn-primary">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('script/accountPage.js')}}"></script>
@endsection