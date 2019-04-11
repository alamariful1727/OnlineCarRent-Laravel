@extends('layouts.app') 
@section('content')
<div class="container">
  <h1 class="text-center head-text">Users experience with us!!</h1>
  <hr class="head-hr">
  <!-- row ends -->
  @if (count($users)>0) @foreach ($users as $user)
  <table>
    <tr>
      <td>ID</td>
      <td>Email</td>
    </tr>
    <tr>
      <td>{{$user->id}}</td>
      <td>{{$user->email}}</td>
    </tr>
  </table>
  @endforeach @else
  <p>No user found!!</p>
  @endif
  <!-- card columns ends -->


  {{-- pagination --}} @if(Request::url() === 'http://onlinecarrent.com/blog') {{$blogs->links()}} @endif
  <!-- row ends -->
</div>
@endsection