@extends('layouts.app') 
@section('content')

<div class="container">
    <button type="button" id="btn-client-create" class="btn btn-link" data-toggle="modal" data-target="#addModal">Create Client</button>
    <table id="clientlist" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Client Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>City</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
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
                {{-- <div class="modal-body">
                    <div class="form-group row">
                            <label>Client Name</label>
                            <input type="text" class="form-control" id="clientname" name="clientname">
                    </div>

                    <div class="form-group row">
                            <label>Email Address</label>
                            <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group row">
                            <label>Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                    </div>

                    <div class="form-group row">
                            <label>City</label>
                            <input type="text" class="form-control" id="city" name="city">
                    </div>

                    <div class="form-group row">
                            <label>Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact">
                    </div>
                </div> --}}
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button id="btn-client-add" data-client-id="0" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- 
<script>
    Move to clientPage.js
</script> --}}

<script src="{{ asset('script/clientPage.js')}}"></script>
@endsection