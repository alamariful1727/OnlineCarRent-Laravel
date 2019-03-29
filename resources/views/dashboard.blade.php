@extends('layouts.app') 
@section('content')
<style>
    body {
        background: linear-gradient(to right, #30CFD0 0%, #330867 100%);
    }
</style>
<div class="container">
    <h1 class="text-center head-text">Profile</h1>
    <hr class="head-hr">

    <!-- row starts -->
    <div class="row">
        <div class="col-lg-5 col-md-12 mt-3">

            <!--Section: Basic Info-->
            <section class="card card-cascade card-avatar mb-4">
                <div class="mt-2">
                    <div class="d-flex justify-content-center h-100">
                        <a href="/user/upload" class="go_upload">
                            <div class="image_outer_container">
                                <div class="green_icon"></div>
                                <div class="image_inner_container">

                                    {{-- <img class="img-fluid" src="/uploads/<%= user.photo %>"> --}}

                                    <img class="img-fluid" src="{{ asset('uploads/new.jpg') }}">

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title">Hi, I'm <strong style="text-transform: capitalize;">Name</strong></h4>
                    <hr class="my-3">
                    <div class="row">
                        <div class="col-8">
                            <h6><i class="fas fa-map-marker-alt mr-2"></i>From</h6>
                        </div>
                        <div class="col-4">
                            <h6>
                                city, country
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <h6><i class="fas fa-user mr-2"></i>Member Since</h6>
                        </div>
                        <div class="col-4">
                            <h6>
                                Jan 2019
                            </h6>
                        </div>
                    </div>
                    <hr class="my-3">

                    <!-- description -->
                    <h6>Description</h6>
                    <p class="text-muted">
                        desc
                    </p>

                </div>

            </section>
            <!--Section: Basic Info ENDS-->
            <!-- Section: user info -->
            <section class="card mb-4">
                <div class="card-body text-center">
                    <h5>
                        <strong>Information</strong>
                    </h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">National ID</th>
                                <td>
                                    NID
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>
                                    email.asd.com
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Username</th>
                                <td>
                                    Username
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Occupation</th>
                                <td>
                                    occupation
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Social -->

                    <a class="btn btn-info btn-md" href="/user/settings" role="button" data-toggle="">Edit profile<i class="fas fa-pencil-alt ml-2"></i></a>

                </div>
            </section>
            <!-- Section: user info -->
        </div>
        <div class="col-lg-7 col-md-12 mt-3">
            <!--Section: Recent transactions-->
            <section class="card mb-4">
                <div class="card-body text-center">
                    <h5>
                        <strong>Recent transactions</strong>
                    </h5>
                    <hr class="my-3">
                </div>
            </section>
            <!--Section: Recent transactions-->
        </div>
    </div>
    <!-- row ends -->
</div>
@endsection