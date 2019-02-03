@extends('layouts.app')

@section('content')

<div class="container row mx-auto">
    <input class="rounded" type="text" placeholder="Search" style="margin-left:auto">

        <table id="employeelist" class="display table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;margin-top:10px;text-align:center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Position</th>
                    <th>Action</th>                                                
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{$employee->lastname}}, {{$employee->firstname}} {{$employee->middlename}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->contact}}</td>  
                    <td>{{$employee->position}}</td>
                    <td><button type="button" class="btn btn-primary">View</button></td>                                             
                </tr>               
                @endforeach
            </tbody>
        </table>
</div>   
@endsection