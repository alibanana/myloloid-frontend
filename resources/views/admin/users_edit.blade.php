@extends('layouts.main-admin')

@section('title', 'Admin Edit Users')

@section('links')
<link href="{{ asset('css/jquery-editable-select.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<!-- Page Heading -->
<h1>Edit a User Here (On Progress)</h1>

@if (count($errors) > 0)
<div class = "alert alert-danger">
    <ul>
    @foreach($errors->all as $error)
        <li>{{$error}}</li>
    @endforeach
    </ul>
</div>
@endif

@if(\Session::has('success'))
<div class = "alert alert-success">
    <p>{{\Session::get('success') }}</p>
</div>
@endif

<form enctype="multipart/form-data" action="{{ route('users.update', $user['id']) }}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

    {{-- User Name --}}
    <div class="form-group">
      <label for="inputUser">Nama</label>
      <input type="text" class="form-control" id="inputUserName" name="name" value ="{{$user['name']}}" placeholder="John Doe"
        required>
    </div>

    {{-- User Email --}}
    <div class="form-group">
      <label for="inputUser">Email</label>
      <input type="text" class="form-control" id="inputUserEmail" name="email" value ="{{$user['email']}}" placeholder="johndoe@test.com"
        required>
    </div>

    {{-- User Phone --}}
    <div class="form-group">
      <label for="inputUser">Nomor Telpon</label>
      <input type="text" class="form-control" id="inputUserPhone" name="phone" value ="{{$user['phone']}}" placeholder="081212341234"
        required>
    </div>

    {{-- User IsAdmin --}}
    <div class="form-group">
        <label for="inputCategory">Status Admin</label>
        {{-- <select id="inputCategory" class="form-control" name="is_admin" required>
            <option @if (!$user['is_admin']) selected @endif>Client</option>
            <option @if ($user['is_admin']) selected @endif>Admin</option>
        </select> --}}
        @if (!$user['is_admin'])
        <input type="text" class="form-control" value='Client' id="inputCategory" readonly>
        @else 
        <input type="text" class="form-control" value='Admin' id="inputCategory" readonly>
        @endif
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

