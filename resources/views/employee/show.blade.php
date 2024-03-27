@extends('layouts.app')
@section('content')


<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{url('images/'.$user->image)}}" alt="User profile picture" style='border:none;'>
                        </div>

                        <h3 class="profile-username text-center"></h3>

                        <p class="text-muted text-center"></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Name: </b> <a class="float-right text-decoration-none text-dark ">{{$user->employee_name}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email: </b> <a class="float-right text-decoration-none text-dark">{{$user->employee_email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Designation: </b> <a class="float-right text-decoration-none text-dark">{{$user->designation}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>DOB:: </b> <a class="float-right text-decoration-none text-dark">{{$user->dob}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Departmaent: </b> <a class="float-right text-decoration-none text-dark">{{$user->department}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender: </b> <a class="float-right text-decoration-none text-dark">{{$user->gender}}</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection