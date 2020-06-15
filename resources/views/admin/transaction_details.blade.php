@extends('layouts.main-admin')

@section('title', 'Admin Transaction Details')

@section('content')
<!-- Page Heading -->
<h1 class="mb-4">Transaction Details Table (On Progress)</h1>

<h4 class="mt-4 mb-2"><b>Delivery Details:</b></h4>
<div class="row mb-4">
  <div class="col-md-6 mb-2">
    <div class="container">
      <h5 class="mb-0"><b>Nama:</b> {{ $transaction['delivery']['name'] }}</h5>
      <h5 class="mb-0"><b>No Telepon:</b> {{ $transaction['delivery']['phone'] }}</h5>
      <h5 class="mb-0"><b>Provinsi:</b> {{ $transaction['delivery']['provinsi'] }}</h5>
      <h5 class="mb-0"><b>Kabupaten:</b> {{ $transaction['delivery']['kabupaten'] }}</h5>
      <h5 class="mb-0"><b>Kecamatan:</b> {{ $transaction['delivery']['kecamatan'] }}</h5>
      <h5 class="mb-0"><b>Alamat:</b> {{ $transaction['delivery']['alamat'] }}</h5>
      @isset($transaction['delivery']['notes'])
      <h5 class="mb-0">Catatan Pembeli: {{ $transaction['delivery']['notes'] }}</h5>
      @endisset
    </div>
  </div>
  <div class="col-md-6">
    <div class="container">
      <h5 class="text-md-right mb-0"><b>Invoice No:</b> {{ $transaction['invoice_no'] }}</h5>
      <h5 class="text-md-right mb-0"><b>Date:</b> {{ $transaction['date'] }}</h5>
      <h5 class="text-md-right mb-0"><b>Status:</b>@if($transaction['status'] == 'Pending')
        <span class="text-warning">Pending</span>
        @elseif ($transaction['status'] == 'Waiting Confirmation')
        <span class="text-primary">Waiting Confirmation</span>
        @elseif ($transaction['status'] == 'Confirmed')
        <span class="text-success">Confirmed</span>
        @elseif ($transaction['status'] == 'Cancelled')
        <span class="text-danger">Cancelled</span>
        @endif
      </h5>
    </div>
  </div>
</div>

<table class="table table-hover mt-5 mb-5">
  <thead>
    <tr>
      <th scope="row">#</th>
      <th scope="row">Product Name</th>
      <th scope="row">Color</th>
      <th scope="row">Size</th>
      <th scope="row">Quantity</th>
      <th scope="row">Price</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($transaction['transaction_details'] as $item)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $item['product']['name'] }}</td>
      <td>{{ $item['colour']['colour'] }}</td>
      <td>{{ $item['size']['size'] }}</td>
      <td>{{ $item['quantity'] }}</td>
      <td>IDR {{ $item['product']['price'] }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="row mb-5">
  <div class="col-md-4">
    <h5><b>Status:</b>@if($transaction['status'] == 'Pending')
      <span class="text-warning">Pending</span>
      @elseif ($transaction['status'] == 'Waiting Confirmation')
      <span class="text-primary">Waiting Confirmation</span>
      @elseif ($transaction['status'] == 'Confirmed')
      <span class="text-success">Confirmed</span>
      @elseif ($transaction['status'] == 'Cancelled')
      <span class="text-danger">Cancelled</span>
      @endif
    </h5>
    <form enctype="multipart/form-data" action="{{ route('admin.transactions.update', $transaction['id']) }}"
      method="post">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="form-group col-md-6">
        <select id="inputCategory" class="form-control" name="status" required>
          <option @if ($transaction['status']=='Pending' ) selected @endif>Pending</option>
          <option @if ($transaction['status']=='Waiting Confirmation' ) selected @endif>Waiting Confirmation
          </option>
          <option @if ($transaction['status']=='Confirmed' ) selected @endif>Confirmed</option>
          <option @if ($transaction['status']=='Cancelled' ) selected @endif>Cancelled</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary col-md-6">Update Status</button>
    </form>
  </div>
  <div class="col-md-4">
    <h5><b>Invoice No:</b> {{ $transaction['invoice_no'] }}</h5>
  </div>
  <div class="col-md-4">
    <h5><b>Total:</b> IDR {{ $transaction['total'] }}</h5>
  </div>
</div>

@isset ($transaction['transfer'])
<h4 class="mt-4 mb-2"><b>Transfer Details:</b></h4>
<div class="row mb-4">
  <div class="col-md-6 mb-2">
    <div class="container">
      <h5 class="mb-0"><b>Transfer Date:</b> {{ $transaction['transfer']['transfer_date'] }}</h5>
      <h5 class="mb-2"><b>Transfer Time:</b> {{ $transaction['transfer']['transfer_time'] }}</h5>
      <h5 class="mb-0"><b>Sender Name:</b> {{ $transaction['transfer']['sender_name'] }}</h5>
      <h5 class="mb-0"><b>Sender Phone:</b> {{ $transaction['transfer']['sender_phone'] }}</h5>
      <h5 class="mb-0"><b>Sender Bank:</b> {{ $transaction['transfer']['sender_bank'] }}</h5>
      <h5 class="mb-2"><b>Sender Acc No:</b> {{ $transaction['transfer']['sender_acc_no'] }}</h5>
      <h5 class="mb-2"><b>Amount Transfered:</b> IDR {{ $transaction['transfer']['amount'] }}</h5>
      <h5 class="mb-0"><b>Receiver Name:</b> {{ $transaction['transfer']['receiver_name'] }}</h5>
      <h5 class="mb-0"><b>Receiver Bank:</b> {{ $transaction['transfer']['receiver_bank'] }}</h5>
      <h5 class="mb-2"><b>Receiver Acc No:</b> {{ $transaction['transfer']['receiver_acc_no'] }}</h5>
      @isset($transaction['transfer']['notes'])
      <h5 class="mb-0">Catatan Pembeli: {{ $transaction['transfer']['notes'] }}</h5>
      @endisset
    </div>
  </div>
  <div class="col-md-3 mb-2">
    <div class="image-preview-transaction mx-auto">
      <img src="http://myloloid-backend.test/uploads/invoices/{{ $transaction['transfer']['file'] }}"
        alt="Image Preview">
    </div>
  </div>
</div> @endisset @endsection