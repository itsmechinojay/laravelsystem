@extends('layouts.app') 
@section('content')


@if (Auth::check() && Auth::user()->type == 'Admin')

<div class="container">
    <div class="card">
        <div class="card-header">
            Notify
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table id="evaluationlist" class="table table-sm table-hover" cellspacing="0" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th class="text-center">Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@elseif (Auth::check() && Auth::user()->type =='Client')

<div class="container">
    <div class="card">
        <div class="card-header">
            Evaluation List
        </div>
        <div class="card-body">
            @if($evaluation == true)
            <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th class="text-center">Rating</th>
                        </tr>
                    </thead>
                    <tbody id="evalemp">

                    </tbody>
                </table>
                <button id="evaluate-save" type="button" class="btn btn-primary">Save</button>
            @else
            <div id="evaluation-stop">
                <h3>The Evaluation period is every month</h3>
            </div>
            @endif
        </div>
    </div>
</div>

@endif


<script src="{{ asset('script/evaluationPage.js')}}"></script>
@endsection