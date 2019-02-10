@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mx-auto">
        <div class="form-group col-3 text-center">
            <div class="form-group row text-center" style="text-align:center">
                <div class="text-center">
                    <img src="image/honest.png" class="rounded-circle" alt="..." style="width:60%">
                </div>
                <div class="form-group row rounded mx-auto" style="text-align:center">
                    <ul class="nav flex-column">
                        <div class="dropdown-divider"></div>
                        <li>
                            {{ Auth::user()->name }}
                        </li>
                        <div class="dropdown-divider"></div>
                        <li>
                            Position
                        </li>
                        <div class="dropdown-divider"></div>
                        <li>
                            Client
                        </li>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="form-group col-9">
            <div class="form-group row" style="border-style:groove">
                <textarea class="form-control" id="exampleTextarea" rows="4"></textarea>
                <button type="submit" class="btn btn-primary" style="margin-left:auto;margin-top:3px">Submit</button>
            </div>
            <div class="form-group row" style="border-style: groove">

            </div>
        </div>
    </div>
</div>

@endsection

