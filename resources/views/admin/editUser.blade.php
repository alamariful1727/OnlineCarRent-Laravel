@extends('layouts.admin') 
@section('content')
    @include('inc.msg')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Edit-User</li>
        </ul>
    </div>
</div>
<section class="">
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display text-center">Details of ID: {{$user->id}}</h1>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.updateUser',[$user->id])}}" enctype="multipart/form-data">
                            {{-- name --}}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="name">@</span>
                                </div>
                                <input type="text" required name="name" class="form-control" placeholder="name" aria-label="name" aria-describedby="name"
                                    value="@if (old('name')!='') {{old('name')}} @else {{$user->name}} @endif">
                            </div>
                            {{-- description --}}
                            <div class="form-group">
                                <label for="description">Description</label> @if (old('description')!='')
                                <textarea name="description" required class="form-control" placeholder="who you are!!" id="description" rows="3">{{old('description')}}</textarea>                                @else
                                <textarea name="description" class="form-control" placeholder="who you are!!" id="description" rows="3">{{$user->description}}</textarea>                                @endif
                            </div>
                            {{-- URL --}}
                            <label for="basic-url">URL</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="url">https://ocr.com/</span>
                                </div>
                                <input type="text" required name="url" class="form-control" id="basic-url" aria-describedby="url" value="@if (old('url')!='') {{old('url')}} @else {{$user->url}} @endif">
                            </div>
                            {{-- image --}}
                            <div class="imgwrapper mb-2 text-center">
                                <img style="width:50%;" class="d-inline-block" src="/storage/user_images/{{$user->image}}">
                            </div>
                            {{-- file --}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="cover_image" type="file" onchange="readURL(this);" class="custom-file-input" id="cover_image" aria-describedby="inputGroupFileAddon04"
                                        accept="image/*">
                                    <label class="custom-file-label" for="cover_image">Choose photo..</label>
                                </div>
                                <small id="fileError" class="form-text text-danger"></small>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-info mx-auto d-block mt-4">Edit</button>
                        </form>
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