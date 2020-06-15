@extends('layouts.main-client')

@section('title', 'Client Dashboard')

@section('container')
<nav class="nav class=navbar navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Client Dashboard</a>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.show') }}">My Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/confirmation') }}">Confirm Payment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-5 mb-5">
  <form>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ Auth::user()->email }}">
      </div>
    </div>
    <div class="form-group row">
      <label for="updateName" class="col-sm-2 col-form-label">Full Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputName" value="{{ Auth::user()->name }}" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label for="updatePhone" class="col-sm-2 col-form-label">Phone</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPhone" value="{{ Auth::user()->phone }}" readonly>
      </div>
    </div>

    @isset(Auth::user()->whastapp)
    <div class="form-group row">
      <label for="updateWhatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputWhatsapp" value="{{ Auth::user()->whastapp }}">
      </div>
    </div>
    @endisset


    {{-- <div class="form-group row">
      <label for="updatePassword" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword" value="password">
      </div>
    </div> --}}

    {{-- <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck">
        <label class="form-check-label" for="gridCheck">
          Are you sure you want to update?
        </label>
      </div>
    </div> --}}
    {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
  </form>
</div>
@endsection