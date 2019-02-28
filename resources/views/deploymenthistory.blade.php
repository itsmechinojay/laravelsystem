@extends('layouts.app') 

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Deployment History
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table id="historylist" class="table table-sm table-hover" cellspacing="0" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Previous Client</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('script/history.js')}}" type="text/javascript"></script>
@endsection 