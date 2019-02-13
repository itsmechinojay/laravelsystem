@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Employee
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2 border text-center">
                    <button type="button" id="btn-employee-create" class="btn btn-link" data-toggle="modal" data-target="#addModal">Add Account</button>
                </div>
                <div class="table-responsive col-9">
                    <table id="employeelist" class="table table-sm table-hover" cellspacing="0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Contact</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add-employee" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">

                        <div class="form-group col">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                        </div>

                        <div class="form-group col">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>

                        <div class="form-group col">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-5">
                            <label>Position</label>
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

                        <div class="form-group col-3">
                            <label>Gender</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select class="custom-select mr-sm-4" id="gender" name="gender" style="margin-bottom: .1rem; width:150px">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-4">
                            <label>Birth Date</label>
                            <input type="date" class="form-control" id="bday" name="bday">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-8">
                            <label>Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>

                        <div class="form-group col-4">
                            <label>City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-8">
                            <label>Email Address<a class="font-small">(Prepared email for Login)</a></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Example@wesupportinc.com">
                        </div>
                        <div class="form-group col-4">
                            <label>Contact</label>
                            <input type="contact" class="form-control" id="contact" name="contact" placeholder="9** *** ****">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button id="btn-employee-add" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{--
<script>
    move to employeePage.js

</script> --}}

<script src="{{ asset('script/employeePage.js')}}"></script>
@endsection