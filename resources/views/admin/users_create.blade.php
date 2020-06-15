@extends('layouts.main-admin')

@section('title', 'Admin Create Users')

@section('links')
<link href="{{ asset('css/jquery-editable-select.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<!-- Page Heading -->
<h1>Create a User Here (On Progress)</h1>

@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

@if(\Session::has('success'))
<div class="alert alert-success">
  <p>{{\Session::get('success') }}</p>
</div>
@endif

<form enctype="multipart/form-data" action="{{ route('users.store') }}" method="post">
  {{ csrf_field() }}

  {{-- User Name --}}
  <div class="form-group">
    <label for="inputUser">Nama</label>
    <input type="text" class="form-control" id="inputUserName" name="name" placeholder="John Doe" required>
  </div>

  {{-- User Email --}}
  <div class="form-group">
    <label for="inputUser">Email</label>
    <input type="text" class="form-control" id="inputUserEmail" name="email" placeholder="johndoe@test.com" required>
  </div>

  {{-- User Phone --}}
  <div class="form-group">
    <label for="inputUser">Nomor Telpon</label>
    <input type="text" class="form-control" id="inputUserPhone" name="phone" placeholder="081212341234" required>
  </div>

  {{-- User IsAdmin --}}
  <div class="form-group">
    <label for="inputCategory">Status Admin</label>
    <select id="inputCategory" class="form-control" name="is_admin" required>
      <option selected>Client</option>
      <option>Admin</option>
    </select>
  </div>

  {{-- User Password --}}
  <div class="form-group">
    <label for="inputUser">Password</label>
    <input type="password" class="form-control" id="inputUserPassword" name="password" required>
  </div>

  {{-- User Confirm Password --}}
  <div class="form-group">
    <label for="inputUser">Confirm Password</label>
    <input type="password" class="form-control" id="inputUserPassword" name="c_password" required>
  </div>

  {{-- Submit & Cancel Button --}}
  <div class="container">
    <div class="form-group">
      <div class="row justify-content-center">
        <button type="submit" class="btn btn-md btn-primary col-3 mx-2">Submit</button>
        <button type="reset" class="btn btn-md btn-danger col-3 mx-2">Cancel</button>
      </div>
    </div>
  </div>
</form>

@endsection