@extends('layouts/main-client')

@section('links')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('title', 'Confirmation')

@section('container')
{{-- Home / Confirmation --}}
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong
          class="text-black">Confirmation</strong></div>
    </div>
  </div>
</div>

<div class="container mt-4">
  <form enctype="multipart/form-data" action="{{ route('confirmation.store') }}" method="post">
    {{-- <form enctype="multipart/form-data" action="" method="post"> --}}
    {{ csrf_field() }}

    <h2 class="text-dark">Konfirmasi Pembayaran</h2>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="invoice_no" class="text-black">Invoice No <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="invoice_no" name="invoice_no" placeholder="h67g887s" maxlength="8"
          required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="transfer_date" class="text-black">Tanggal Transfer<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="transfer_date" name="transfer_date" placeholder="01/08/2019"
          required>
      </div>
      <div class="col-md-2">
        <label for="transfer_time" class="text-black">Waktu Transfer <span class="text-danger">*</span></label>
        <input type="time" class="form-control" id="transfer_time" name="transfer_time" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="sender_name" class="text-black">Nama Pengirim <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="Budiono" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="sender_phone" class="text-black">No. HP <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="sender_phone" name="sender_phone" placeholder="08114568787"
          required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="sender_bank" class="text-black">Bank Pengirim <span class="text-danger">*</span></label>
        <select id="sender_bank" class="form-control" name="sender_bank" onchange="senderBankOthers()" required>
          <option selected>Bank Mandiri</option>
          <option>BCA</option>
          <option>BRI</option>
          <option>BNI</option>
          <option>CIMB Niaga</option>
          <option>Mandiri Syariah</option>
          <option>BRI Syariah</option>
          <option>BNI Syariah</option>
          <option>Bank Lain</option>
        </select>
        <input type="hidden" class="form-control mt-2" id="sender_bank_others" name="sender_bank_others"
          placeholder="Bank Muamalat" required>
      </div>
      <div class="col-md-4">
        <label for="sender_acc_no" class="text-black">Account No <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="sender_acc_no" name="sender_acc_no" placeholder="1311249742103"
          required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="amount" class="text-black">Jumlah Transfer <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="amount" name="amount" placeholder="499000" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="receiver_name" class="text-black">Nama Penerima <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="receiver_name" name="receiver_name" placeholder="Jason" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4">
        <label for="receiver_bank" class="text-black">Bank Penerima <span class="text-danger">*</span></label>
        <select id="receiver_bank" class="form-control" name="receiver_bank" required>
          <option selected>Bank Mandiri</option>
          <option>BCA</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="receiver_acc_no" class="text-black">Account No <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="receiver_acc_no" name="receiver_acc_no"
          placeholder="1311249742103" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-6">
        <label for="file" class="text-black">Bukti Pembayaran <span class="text-danger">*</span></label>
        <input type="file" class="form-control-file" id="file" name="file" accept="image/*" onchange="imagePreview()">
      </div>
    </div>

    <div class="form-group row mb-4">
      <div class="col-md-6">
        <label for="notes" class="text-black">Keterangan</label>
        <textarea name="notes" id="notes" cols="30" rows="3" class="form-control"
          placeholder="a/n Melly, pembelian produk mylolo jacket..."></textarea>
      </div>
    </div>

    <div class="form-group row justify-content-center">
      <button type="submit" class="btn btn-md btn-primary col-4 mx-2">Konfirmasi Pembayaran</button>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script class="">
  $("#transfer_date").datepicker();

  function senderBankOthers()
  {
    var selectSenderBank = document.getElementById('sender_bank');
    if (selectSenderBank.value == 'Bank Lain') {
      document.getElementById('sender_bank_others').type = 'text';
    } else {
      document.getElementById('sender_bank_others').type = 'hidden';
    }
  }
</script>
@endsection