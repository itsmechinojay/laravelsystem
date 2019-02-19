@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Notify
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table id="notifylist" class="table table-sm table-hover" cellspacing="0" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sender</th>
                            <th>Notification Information</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('script/notifypage.js')}}" type="text/javascript"></script>
@endsection