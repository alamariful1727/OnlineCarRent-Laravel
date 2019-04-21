@extends('layouts.admin') 
@section('content')
    @include('inc.msg')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Blog details</li>
        </ul>
    </div>
</div>
<section class="">
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display text-center">Blog details</h1>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Search bar -->
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search blogs data">
                        <!-- Searched data  -->
                        <div class="table-responsive">
                            <h3 class="text-center my-2">Total blog: <span id="total-blog"></span></h3>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User-type</th>
                                        <th>Created by</th>
                                        <th>Description</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
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
        fetch_blog_data();
        function fetch_blog_data(query='') { 
            $.ajax({
                type: "GET",
                url: "{{route('admin.getBlogsInfo')}}",
                data: {query:query},
                dataType: "json",
                success: function (response) {
                    $('tbody').html(response.table_data);
                    $('#total-blog').html(response.total_data);
                }
            });
        }
        $('#search').on('keyup', function () {
            var query = $(this).val();
            fetch_blog_data(query);
        });
    });

</script>
@endsection