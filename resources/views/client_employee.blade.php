@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Employee
        </div><div class="card-body">
            <div class="table-responsive ">
                <table id="employeelist" class="table table-sm table-hover" cellspacing="0" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Position</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('script/client_employee.js')}}"></script>
@endsection