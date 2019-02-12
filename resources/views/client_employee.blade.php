@extends('layouts.app')

@section('content')

<div class="container">
    <table id="employeelist" class="display text-center table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0"  style="width:100%;margin-top:10px;background-color:ghostwhite">
        <thead class="text-light" style="background-color:black">
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
<script src="{{ asset('script/client_employee.js')}}"></script>
@endsection