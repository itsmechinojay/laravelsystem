@extends('layouts.app') 
@section('content') @if (Auth::check() && Auth::user()->type == 'Admin')

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
                            <th class="text-center">Overall Rating</th>
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
                        <th class="text-center">Criteria</th>
                    </tr>
                </thead>
                <tbody id="evalemp">

                </tbody>
            </table>
            <button id="evaluate-save" type="button" class="btn btn-primary">Save</button> @else
            <div id="evaluation-stop">
                <h3>The Evaluation period is every month</h3>
            </div>
            @endif
        </div>
    </div>
</div>

@endif

<!-- Modal -->
<div class="modal fade" id="criteriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                Performance Criteria
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="form-group col">
                        <label>Vocational competence</label>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select class="custom-select mr-sm-4" id="position" name="position" style="margin-bottom: .1rem; width:300px">
                                            <option value="5">Excellent</option>
                                            <option value="4">Very Good</option>
                                            <option value="3">Good</option>
                                            <option value="2">Fair</option>
                                            <option value="1">Poor</option>
                                        </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col">
                        <label>Responsibility at work and activity in the workplace </label>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select class="custom-select mr-sm-4" id="position" name="position" style="margin-bottom: .1rem; width:300px">
                                                <option value="5">Excellent</option>
                                                <option value="4">Very Good</option>
                                                <option value="3">Good</option>
                                                <option value="2">Fair</option>
                                                <option value="1">Poor</option>
                                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col">
                        <label>Quality and performance</label>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select class="custom-select mr-sm-4" id="position" name="position" style="margin-bottom: .1rem; width:300px">
                                                <option value="5">Excellent</option>
                                                <option value="4">Very Good</option>
                                                <option value="3">Good</option>
                                                <option value="2">Fair</option>
                                                <option value="1">Poor</option>
                                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button id="btn-employee-add" type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('script/evaluationPage.js')}}"></script>
@endsection