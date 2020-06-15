@extends('layouts/main-client')

@section('title', 'Cart')

@section('container')

{{-- Home / Cart --}}
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong
          class="text-black">Cart</strong></div>
    </div>
  </div>
</div>

{{-- Table Shopping Cart Web Version--}}
<div class="site-blocks-table d-none d-md-block table-wrapper-web">
  <table class="table table-hover table-borderless" id="cartTable">
    {{-- <table> --}}
    <thead>
      <tr>
        <th class="product-thumbnail">Product</th>
        <th class="product-name"></th>
        <th class="product-colour">Colour</th>
        <th class="product-size">Size</th>
        <th class="product-quantity">Quantity</th>
        <th class="product-total">Total</th>
      </tr>
    </thead>
    <tbody>
      <form id="cart-form" enctype="multipart/form-data" action="{{ route('cart.update') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        @foreach (session()->get('cart') as $item)
        <tr class="align-items-center text-dark">
          <td class="product-thumbnail">
            <img src="http://myloloid-backend.test/uploads/images/{{ $item['file'] }}" alt="" class="img-thumbnail">
          </td>
          <td class="product-name">{{ $item['name'] }}</td>
          <td class="product-colour">
            {{ Http::get('http://myloloid-backend.test/api/colours/'.$item['colour'])['data']['colour'] }}</td>
          <td class="product-size">
            {{ Http::get('http://myloloid-backend.test/api/sizes/'.$item['size'])['data']['size'] }}</td>
          <td class="product-quantity">
            <div class="input-group quantity-input text-align-center justify-content-center">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-primary minus-button js-btn-minus"
                  onclick="decreaseQuantityInp({{ $loop->index }})">&minus;</button>
              </div>
              <input type="text" class="form-control text-center quantity-text" value="{{ $item['quantity'] }}"
                id="quantityInput{{ $loop->index }}" readonly>
              <div class="input-group-append">
                <button type="button" class="btn btn-primary plus-button js-btn-plus"
                  onclick="addQuantityInp({{ $loop->index }})">&plus;</button>
              </div>
            </div>
          </td>
          <td class="product-total" id="productTotal{{ $loop->index }}">IDR {{ $item['price'] }}</td>
        </tr>
        <input type="hidden" id="productPrice{{ $loop->index }}" value="{{ $item['price'] }}">
        <input type="hidden" name="data[{{ $loop->index }}][id]" value="{{ $item['id'] }}">
        <input type="hidden" name="data[{{ $loop->index }}][colour]" value="{{ $item['colour'] }}">
        <input type="hidden" name="data[{{ $loop->index }}][size]" value="{{ $item['size'] }}">
        <input type="hidden" name="data[{{ $loop->index }}][quantity]" id="productQty{{ $loop->index }}"
          value="{{ $item['quantity'] }}">
        @endforeach
      </form>
    </tbody>
  </table>
</div>

{{-- Table Shopping Cart Mobile Version --}}
<div class="d-md-none table-wrapper-mobile">
  @foreach (session()->get('cart') as $item)
  {{-- First Card --}}
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <img src="http://myloloid-backend.test/uploads/images/{{ $item['file'] }}" alt="" class="rounded float-left"
            class="img-thumbnail">
        </div>
        <div class="col-6 text-left d-flex flex-column">
          <h6 class="text-primary">{{ $item['name'] }}</h6>
          <h6 class="text-dark">{{ Http::get(url('api/colours/'.$item['colour']))['data']['colour'] }},
            {{ Http::get(url('api/sizes/'.$item['size']))['data']['size'] }}</h6>
          <h5 class="text-black">IDR {{ $item['price'] }}</h5>
          <div class="input-group quantity-input mt-auto">
            <div class="input-group-prepend">
              <button type="button" class="btn btn-primary minus-button js-btn-minus">&minus;</button>
            </div>
            <input type="text" class="form-control text-center quantity-text" value="1" readonly>
            <div class="input-group-append">
              <button type="button" class="btn btn-primary plus-button js-btn-plus">&plus;</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

{{-- Coupon Form & Update Cart Button --}}
<div class="justify-content-xl-center coupon-cart-wrapper mt-4 mx-auto mb-4">
  <div class="row">
    {{-- First Col --}}
    <div class="col-md-7 col-lg-6">
      <div class="row mb-5">
        <div class="col-md-6 mb-3 mb-md-0">
          <button class="btn btn-primary btn-sm btn-block" type="submit" form="cart-form">Update Cart</button>
        </div>
        <div class="col-md-6">
          <a href="{{ url('/catalogue') }}" class="">
            <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="text-black h4" for="coupon">Coupon</label>
          <p>Enter your coupon code if you have one.</p>
        </div>
        <div class="col-md-7 col-lg-8 mb-3 mb-md-0">
          <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
        </div>
        <div class="col-md-5 col-lg-4">
          <button class="btn btn-primary btn-sm">Apply Coupon</button>
        </div>
      </div>
    </div>
    {{-- Second Col --}}
    <div class="col-md-5 col-lg-6 mt-2 mb-4">
      <div class="row justify-content-center justify-content-xl-end">
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-12 text-right text-sm-left border-bottom mb-4">
              <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <span class="text-black">Subtotal</span>
            </div>
            <div class="col-md-6 text-right">
              <strong class="text-black" id="subtotalText">IDR {{ $cartTotal }}</strong>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center text-sm-left">
              <a href="{{ url('/cart/checkout') }}">
                <button class="btn btn-primary btn-sm">
                  Proceed To Checkout
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  initPage()

  function initPage() {
    var table = document.getElementById("cartTable");
    for (var i = 0; i < table.rows.length-1; i++) {
      var qty = document.getElementById('quantityInput'+i).value;
      var price = document.getElementById('productPrice'+i).value;
      
      var rowtotal = parseInt(qty) * price;
      document.getElementById('productTotal'+i).innerHTML = 'IDR ' + rowtotal;
    }
  }

  function addQuantityInp (index) {
    var qty = document.getElementById('quantityInput'+index).value;
    var qtyInp = document.getElementById('productQty'+index);
    qtyInp.value = parseInt(qty)+1;
  }

  function decreaseQuantityInp (index) {
    var qty = document.getElementById('quantityInput'+index).value;
    var qtyInp = document.getElementById('productQty'+index);
    qtyInp.value = parseInt(qty)-1;
  }
</script>
@endsection