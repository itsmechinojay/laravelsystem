@extends('layouts.app') 
@section('content')
<div class="container" style="width: 70%">
    {{--
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
    </div> --}}
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
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="Last Name">
                                </div>
                                <div class="form-group col">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="First Name">
                                </div>
                                <div class="form-group col">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="Middle Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Position</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="Position">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="exampleFormControlSelect1">Gender</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                          <option>MALE</option>
                                          <option>FEMALE</option>

                                        </select>
                                </div>
                                <div class="form-group col">
                                    <label for="inputPassword4">Contact</label>
                                    <input type="number" class="form-control" id="inputPassword4" placeholder="Contact">
                                </div>
                                <div class="form-group col">
                                    <label for="inputPassword4">Birthday</label>
                                    <input type="text" class="form-control" id="inputPassword4" placeholder="Birthdate">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>City</label>
                                    <input class="form-control" placeholder="City">
                                </div>
                                <div class="form-group col">
                                    <label for="exampleFormControlTextarea1">Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection