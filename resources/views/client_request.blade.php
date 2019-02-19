@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Request
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 border text-center">
                    <button type="button" id="btn-employee-create" class="btn btn-link" data-toggle="modal" data-target="#addModal">Add Request</button>
                </div>
                <div class="table-responsive col-9">
                    <table id="requestlist" class="table table-sm table-hover" cellspacing="0" style="width:100%">
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
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-add-request">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Job Position') }}</label>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select class="custom-select mr-sm-4" id="position" name="position" style="margin-bottom: .1rem; width:300px">
                                            <option value="Access Control Management Officer">Access Control Management Officer</option>
                                            <option value="Accounting Assistant">Accounting Assistant</option>
                                            <option value="Angular JS Developer">Angular JS Developer</option>
                                            <option value="Business Analyst">Business Analyst</option>
                                            <option value="Business Analyst with PL/SQL Programming">Business Analyst with PL/SQL Programming</option>
                                            <option value="Business Process Analyst">Business Process Analyst</option>
                                            <option value="CAD Operator">CAD Operator</option>
                                            <option value="Customer Service Specialist">Customer Service Specialist</option>
                                            <option value="C#.NET DEVELOPER">C# .Net Developer</option>
                                            <option value="Data Analyst">Data Analyst</option>
                                            <option value="Data Architect">Data Architect</option>
                                            <option value="Database Administrator">Database Administrator</option>
                                            <option value="Defect Manager">Defect Manager</option>
                                            <option value="EDI Gentran Analyst">EDI Gentran Analyst</option>
                                            <option value="Helpdesk Specialist">Helpdesk Specialist</option>
                                            <option value="Information Security Management Officer">Information Security Management Officer</option>
                                            <option value="IT Project Manager">IT Project Manager</option>
                                            <option value="IT SECURITY">IT Security</option>
                                            <option value="IT Specialist - Security Control">IT Specialist - Security Control</option>
                                            <option value="Javascript Developer">Javascript Developer</option>
                                            <option value="Java Developer">Java Developer</option>
                                            <option value="Jr. Business Analyst">Jr. Business Analyst</option>
                                            <option value="Linux Technical Lead">Linux Technical Lead</option>
                                            <option value="Object Oriented Programmer">Object Oriented Programmer</option>
                                            <option value="Oracle Database Administrator">Oracle Database Administrator</option>
                                            <option value="PHP Developer">PHP Developer</option>
                                            <option value="Payroll Assistant / Supervisor">Payroll Assistant / Supervisor</option>
                                            <option value="PLC Programmer">PLC Programmer</option>
                                            <option value="Project Roll-out Manager">Project Roll-out Manager</option>
                                            <option value="Remedyforce Administrator">Remedyforce Administrator</option>
                                            <option value="Remedyforce Support">Remedyforce Support</option>
                                            <option value="Remedyforce/Salesforce">Remedyforce/Salesforce</option>
                                            <option value="RPG Developer with ICMS">RPG Developer with ICMS</option>
                                            <option value="Salesforce Developer">Salesforce Developer</option>
                                            <option value="SAP Administrator">SAP Administrator</option>
                                            <option value="SAP Business Intelligence Consultant">SAP Business Intelligence Consultant</option>
                                            <option value="SAP Finance Lead">SAP Finance Lead</option>
                                            <option value="SAP MM Process Analyst">SAP MM Process Analyst</option>
                                            <option value="Security Infrastructure Management Officer">Security Infrastructure Management Officer</option>
                                            <option value="Security Specialist">Security Specialist</option>
                                            <option value="Security Tester">Security Tester</option>
                                            <option value="Self Service Solutions Consultants">Self Service Solutions Consultants</option>
                                            <option value="Sharepoint Farm Administrator">Sharepoint Farm Administrator</option>
                                            <option value="Software Architect">Software Architect</option>
                                            <option value="Software Quality Assurance Enginner">Software Quality Assurance Enginner</option>
                                            <option value="Solutions Architect">Solutions Architect</option>
                                            <option value="Sr.Web Application Developer">Sr. Web Application Developer</option>
                                            <option value="Systems/Business Analyst">System/Bussiness Analyst</option>
                                            <option value="System Administrator">System Administrator</option>
                                            <option value="Systems Analyst">System Analyst</option>
                                            <option value="Technical Writer">Technical Writer</option>
                                            <option value="Test Analyst">Test Analyst</option>
                                            <option value="Test Execution Domain Lead">Test Execution Domain Lead</option>
                                            <option value="TIBCO Developer">TIBCO Developer</option>
                                            <option value="TIBCO Support Analyst">TIBCO Support Analyst</option>
                                            <option value="Workday Consultant">Workday Consultant</option>
                                            <option value="ZTE NGN Expert">ZTE NGN Expert</option>
                                            <option value=".NET Programmer">.Net Programmer</option>
                                        </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"
                                value="{{ old('description') }}" required> @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span> @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="needed" class="col-md-4 col-form-label text-md-right">{{ __('Employee Needed') }}</label>

                        <div class="col-md-6">
                            <input id="needed" type="number" class="form-control{{ $errors->has('needed') ? ' is-invalid' : '' }}" name="needed" value="{{ old('needed') }}"
                                required> @if ($errors->has('needed'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('needed') }}</strong>
                                </span> @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button id="btn-add-request" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="{{ asset('script/client_requestPage.js')}}"></script>
@endsection