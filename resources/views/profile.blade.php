@extends('layouts.app') 
@section('content')
<div class="container" style="width: 70%">
    <div class="card">
        <div class="card-header">
            My Profile
        </div>
        <div class="card-body">
            <form>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-2">
                            <img src="image/honest.png" class="img-fluid" alt="Responsive image">
                        </div>
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Last Name</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Last Name" val="">
                                </div>
                                <div class="form-group col">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" id="firstname" placeholder="First Name">
                                </div>
                                <div class="form-group col">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" placeholder="Middle Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Position</label>
                                    <input type="text" class="form-control" id="position" placeholder="Position">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="exampleFormControlSelect1">Gender</label>
                                    <select class="form-control" id="gender">
                                          <option>MALE</option>
                                          <option>FEMALE</option>

                                        </select>
                                </div>
                                <div class="form-group col">
                                    <label for="inputPassword4">Contact</label>
                                    <input type="number" class="form-control" id="contact" placeholder="Contact">
                                </div>
                                <div class="form-group col">
                                    <label for="inputPassword4">Birthday</label>
                                    <input type="text" class="form-control" id="bday" placeholder="Birthdate">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>City</label>
                                    <input class="form-control" type=text id="city" placeholder="City">
                                </div>
                                <div class="form-group col">
                                    <label for="exampleFormControlTextarea1">Address</label>
                                    <textarea class="form-control" id="address" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('script/profile.js')}}" type="text/javascript"></script>
@endsection