@extends('layouts/main-client')

@section('title', $title)

@section('container')
<div class="container d-flex error-container">
    <div class="row justify-content-center align-self-center">
        <div class="col-12">
            <h1 class="">{{ $message['heading'] }}</h1>
        </div>
        <div class="col-12">
            <h2 class="text-dark">{{ $message['message'] }}</h2>
        </div>
    </div>
</div>
@endsection