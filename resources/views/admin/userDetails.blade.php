@extends('layouts.admin') 
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            <li class="breadcrumb-item active">User details</li>
        </ul>
    </div>
</div>
<section class="">
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display text-center">User details</h1>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search users data">
                        <div class="table-responsive">
                            <h3 class="text-center my-2">Total user: <span id="total-user"></span></h3>
                            {{-- @if (count($users)>0) --}}
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Description</th>
                                        <th>Url</th>
                                        <th>Type</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($users as $user) --}} {{--
                                    <tr>
                                        <th scope="row">{{$user->id}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->description}}</td>
                                        <td>{{$user->url}}</td>
                                        <td>{{$user->type}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>
                                            <a class="btn btn-success" href="" role="button" data-toggle="">Edit</a>
                                            <a class="btn btn-success" href="" role="button" data-toggle="">Delete</a>
                                        </td>
                                    </tr> --}} {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        {{-- @else
                        <p>No users found!!</p>
                        @endif {{$users->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .pagination {
        justify-content: center;
    }
</style>
<script>
    $(function () {
        fetch_user_data();
        function fetch_user_data(query='') { 
            $.ajax({
                type: "GET",
                url: "{{route('admin.getUsersInfo')}}",
                data: {query:query},
                dataType: "json",
                success: function (response) {
                    $('tbody').html(response.table_data);
                    $('#total-user').html(response.total_data);
                }
            });
        }
        $('#search').on('keyup', function () {
            var query = $(this).val();
            fetch_user_data(query);
        });
    });

</script>
@endsection