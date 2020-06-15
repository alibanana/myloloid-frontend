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
                <a class="nav-link" href="{{route('dashboard.index') }}">Dashboard</a>
            </li>
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

<div class="container">
    {{-- Main table --}}
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Invoice Number</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Payment Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction['date'] }}</td>
                <td>{{ $transaction['user']['name'] }}</td>
                <td><a href="{{ url('/invoice/'.$transaction['invoice_no']) }}"
                        class="">{{ $transaction['invoice_no'] }}</a></td>
                <td>{{ $transaction['status'] }}</td>
                <td>IDR {{ $transaction['total'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection