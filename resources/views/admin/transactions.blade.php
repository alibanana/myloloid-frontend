@extends('layouts.main-admin')

@section('title', 'Admin Transactions')

@section('content')
<!-- Page Heading -->
<h1>Transaction History Table (On Progress)</h1>

{{-- Main table --}}
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Date of Order</th>
      <th scope="col">Invoice Number</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Payment Total</th>
      <th scope="col"></th>

    </tr>
  </thead>

  <tbody>
    @foreach ($transactions as $transaction)
    <tr>
      <td>{{ $loop->iteration }}</td>
      @isset($transaction['user'])
      <td>{{ $transaction['user']['name'] }}</td>
      @endisset
      @empty($transaction['user'])
      <td>{{ $transaction['customer']['name'] }}</td>
      @endempty
      <td>{{ $transaction['date'] }}</td>
      <td>{{ $transaction['invoice_no'] }}</td>
      <td>@if($transaction['status'] == 'Pending')
        <span class="text-warning">Pending</span>
        @elseif ($transaction['status'] == 'Waiting Confirmation')
        <span class="text-primary">Waiting Confirmation</span>
        @elseif ($transaction['status'] == 'Confirmed')
        <span class="text-success">Confirmed</span>
        @elseif ($transaction['status'] == 'Cancelled')
        <span class="text-danger">Cancelled</span>
        @endif
      </td>
      <td>IDR {{ $transaction['total'] }}</td>
      <td>
        <a href="{{ url('/admin/transactions/'.$transaction['invoice_no']) }}"
          class=" btn btn-sm btn-primary">Details</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection