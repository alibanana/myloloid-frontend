@extends('layouts/main-client')

@section('title', 'Invoice')

@section('container')

{{-- Home / Invoice --}}
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong
          class="text-black">Invoice</strong></div>
    </div>
  </div>
</div>

<div class="container">
  <h4 class="text-dark mt-4 mb-2"><b>Delivery Details:</b></h4>
  <div class="row mb-4">
    <div class="col-md-6 mb-2">
      <div class="container">
        <h5 class="text-dark mb-0"><b>Nama:</b> {{ $invoice['delivery']['name'] }}</h5>
        <h5 class="text-dark mb-0"><b>No Telepon:</b> {{ $invoice['delivery']['phone'] }}</h5>
        <h5 class="text-dark mb-0"><b>Provinsi:</b> {{ $invoice['delivery']['provinsi'] }}</h5>
        <h5 class="text-dark mb-0"><b>Kabupaten:</b> {{ $invoice['delivery']['kabupaten'] }}</h5>
        <h5 class="text-dark mb-0"><b>Kecamatan:</b> {{ $invoice['delivery']['kecamatan'] }}</h5>
        <h5 class="text-dark mb-0"><b>Alamat:</b> {{ $invoice['delivery']['alamat'] }}</h5>
        @isset($invoice['delivery']['notes'])
        <h5 class="text-dark mb-0">Catatan Pembeli: {{ $invoice['delivery']['notes'] }}</h5>
        @endisset
      </div>
    </div>
    <div class="col-md-6">
      <div class="container">
        <h5 class="text-dark text-md-right mb-0"><b>Invoice No:</b> {{ $invoice['invoice_no'] }}</h5>
        <h5 class="text-dark text-md-right mb-0"><b>Date:</b> {{ $invoice['date'] }}</h5>
        <h5 class="text-dark text-md-right mb-0"><b>Status:</b> {{ $invoice['status'] }}</h5>
      </div>
    </div>
  </div>

  <table class="table table-bordered mb-4 text-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Product</th>
        <th scope="col">Colour</th>
        <th scope="col">Size</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invoice['transaction_details'] as $item)
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

  <div class="row mb-4">
    <div class="col-md-4">
      <h5 class="text-dark text-md-center"><b>Total:</b> IDR {{ $invoice['total'] }}</h5>
    </div>
    <div class="col-md-4">
      <h5 class="text-dark text-md-center mb-2"><b>Invoice No:</b> {{ $invoice['invoice_no'] }}</h5>
      <input type="text" class="w-100 text-center" value="{{ url()->current() }}" readonly>
    </div>
    <div class="col-md-4">
      <h5 class="text-dark text-md-center"><b>Status:</b> {{ $invoice['status'] }}</h5>
    </div>
  </div>

  <div class="container mb-4">
    <h4 class="text-dark"><b>Informasi Pembayaran:</b></h4>
    <div class="container mb-4">
      <h5 class="text-dark">
        <b>Bank Mandiri</b> a/n <b>Alifio Rasendriya</b>, 123521019238
      </h5>
      <h5 class="text-dark">
        <b>Bank BCA</b> a/n <b>Jason Sianandar</b>, 886241270918
      </h5>
    </div>
    <div class="container mb-4">
      <h5 class="text-dark text-md-center">
        Pembelian anda akan segera kami proses setelah pembayaran diterima.<br>
        Setelah melakukan pembayaran WAJIB melakukan konfirmasi pembayaran ke link
        <a href="{{ url('/confirmation') }}" class="">{{ url('/confirmation') }}</a> agar kami dapat langsung
        memproses
        pembelian yang masuk.
      </h5>
    </div>
    <div class="container">
      <h5 class="text-dark text-md-center">
        KONFIRMASI PEMBAYARAN HANYA BERLAKU 1 X 24 JAM DARI WAKTU SUBMIT ORDER.<br>
        JIKA MELEBIHI WAKTU TERSEBUT, ORDER ANDA SECARA OTOMATIS DIBATALKAN.
      </h5>
    </div>
  </div>


</div>

@endsection