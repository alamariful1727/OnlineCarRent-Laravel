@extends('layouts.app') 
@section('content')
<style>
  body {
    background: #FC354C;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #0ABFBC, #FC354C);
    /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #0ABFBC, #FC354C);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  }
</style>
<script type="text/javascript">
  function validate()
  {
      // validating file
    var cover_image = document.getElementById('cover_image').files;
    const file = cover_image[0];
    const  fileType = file['type'];
    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'];
    var fileError = false;

    var error="";
    var name = document.getElementById( "bbody" );
    if( name.value.length == 0 )
    {
      error = "Can't be empty!!";
      document.getElementById( "bodyError" ).innerHTML = error;
      return false;
    }
    else if( name.value.length > 191)
    {
      error = "Length should be between 1-191";
      document.getElementById( "bodyError" ).innerHTML = error;
      return false;
    }
    else if(cover_image.length == 1){
        if (!validImageTypes.includes(fileType)) {
          fileError = true;
          document.getElementById('fileError').innerHTML = "It should be an image [gif, jpeg, jpg, png]!!";  
          return false;        
        }else if(file.size > 2 * 1024 * 1024){
          fileError = true;
          document.getElementById('fileError').innerHTML = "Can't be greater than 2mb!!";
          return false;        
        }else{
          fileError = false;
          return true;
        }
    }else{
      return true;
    }

  }

</script>
<div class="container">
  <h1 class="text-center head-text">Share your experience with us!!</h1>
  <hr class="head-hr">

  <!-- row ends -->
  <div class="row">
    <div class="offset-lg-3 col-lg-6 col-md-12">
      <div class="card p-3">
        <form method="POST" action="{{route('blog.store')}}" enctype="multipart/form-data" onsubmit="return validate()">
          <div class="form-group">
            <label for="body">Blog Description</label>
            <textarea name="body" class="form-control" placeholder="Write your thoughts about us.. ^_^" id="body" rows="3"></textarea>
            <small id="bodyError" class="form-text text-danger"></small>
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
          <button type="submit" class="btn btn-primary mx-auto d-block mt-4">Share <span><i
                  class="fas fa-share ml-2"></i></span></button>
        </form>
      </div>
      <!-- card ends -->
      <a href="{{route('blog.index')}}" class="head-text d-block text-center my-4 toggle-text">All blogs!!</a>
    </div>
    <!-- row ends -->
  </div>

  <script>
    console.log('{{ csrf_token() }}');
    // $('#body').ckeditor();
    // refreshing
    // document.getElementById('bodyError').innerHTML = "";
    //   document.getElementById('fileError').innerHTML = "";
    //   $("#cover_image").val('');
    //   $('.custom-file-label').html('');
  </script>
  <script>
    ////////////// file preview /////////////////
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('.custom-file-label').html(input.files[0].name);
    };
    reader.readAsDataURL(input.files[0]);
  } 
}
  </script>
@endsection