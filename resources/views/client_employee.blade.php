@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Employee
        </div>
        <div class="card-body">
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

<!-- Modal -->
<div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                Year of Contract
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="number" class="form-control" id="contractyear" name="contractyear">
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button id="btn-contract-add" type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('script/client_employee.js')}}"></script>
@endsection