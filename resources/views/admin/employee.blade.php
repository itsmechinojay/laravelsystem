@extends('layouts.app') 
@section('content')

<div class="container">
    <button type="button" id="btn-employee-create" class="btn btn-link" data-toggle="modal" data-target="#addModal">Add Employee</button>
    <table id="employeelist" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
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
                                <label>Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname">
                            </div>

                            <div class="form-group col">
                                <label>First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname">
                            </div>

                            <div class="form-group col">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" id="middlename" name="middlename">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group col-5">
                                <label>Position</label>
                                <input type="text" class="form-control" id="position" name="position">
                            </div>

                            <div class="form-group col-3">
                                <label>Gender</label>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="custom-select mr-sm-4" id="gender" name="gender" style="margin-bottom: .1rem;">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-4">
                                <label>Birth Date</label>
                                <input type="date" class="form-control" id="bday" name="bday">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group col-8">
                                <label>Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>

                            <div class="form-group col-4">
                                <label>City</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group col-8">
                                <label>Email Address</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group col-4">
                                <label>Contact</label>
                                <input type="contact" class="form-control" id="contact" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="btn-employee-add" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{--
    <script>
        move to employeePage.js
    </script> --}}

    <script src="{{ asset('script/employeePage.js')}}"></script>
    
@endsection