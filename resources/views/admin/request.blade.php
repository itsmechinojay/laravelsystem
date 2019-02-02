@extends('layouts.app') 
@section('content')
<div class="container">
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
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog-lg" role="document">
        <form id="form-add-request">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Employee List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <table id="employeelist" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
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
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button id="btn-add-request" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('script/requestPage.js')}}"></script>

@endsection