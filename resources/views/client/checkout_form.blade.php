@extends('layouts/main-client')

@section('title', 'Cart')

@section('container')

{{-- Home / Cart / Checkout --}}
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0">
        <a href="/">Home</a> <span class="mx-2 mb-0">/</span> <a href="{{ url('/cart') }}">Cart</a> <span
          class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    @empty($user)
    <div class="row mb-5">
      <div class="col-md-12">
        <div class="border p-4 rounded" role="alert">
          Returning customer? <a href="#">Click here</a> to login
        </div>
      </div>
    </div>
    @endempty
    <div class="row">
      <div class="col-md-6 mb-5 mb-md-0">
        <h2 class="h3 mb-3 text-black">Billing Details</h2>
        <div class="p-3 p-lg-5 border">
          <form id="checkout-form" enctype="multipart/form-data" action="{{ route('cart.store') }}" method="post">
            {{ csrf_field() }}

            @isset($user)
            <input type="hidden" name="c_user_id" value="{{ $user->id }}">
            @endisset

            <h2 class="text-dark">Data Pemesan</h2>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_email" class="text-black">Email Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_email" name="c_email" placeholder="test@test.com"
                  @isset($user) value="{{ $user->email }}" readonly @endisset required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_name" class="text-black">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Budiono" @isset($user)
                  value="{{ $user->name }}" readonly @endisset required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_phone" class="text-black">No. HP <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="c_phone" name="c_phone" placeholder="08114568787"
                  @isset($user) value="{{ $user->phone }}" readonly @endisset required>
              </div>
            </div>

            <div class="form-group row mb-5">
              <div class="col-md-12">
                <label for="c_whatsapp" class="text-black">Whatsapp</label>
                <input type="number" class="form-control" id="c_whatsapp" name="c_whatsapp" placeholder="08114568787"
                  @isset($user) @isset($user->whatsapp) value="{{ $user->whatsapp }}" readonly @endisset @endisset>
              </div>
            </div>

            <h2 class="text-dark">Data Penerima</h2>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="r_name" class="text-black">Atas Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="r_name" name="r_name" placeholder="Budiono" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="r_phone" class="text-black">No. HP <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="r_phone" name="r_phone" placeholder="08114568787"
                  required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="r_provinsi" class="text-black">Provinsi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="r_provinsi" name="r_provinsi" placeholder="Jawa Barat"
                  required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="r_kabupaten" class="text-black">Kotamadya / Kabupaten <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control" id="r_kabupaten" name="r_kabupaten" placeholder="Kota Bandung"
                  required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="r_kecamatan" class="text-black">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="r_kecamatan" name="r_kecamatan" placeholder="Ciwidey"
                  required>
              </div>
            </div>

            <div class="form-group row mb-5">
              <div class="col-md-12">
                <label for="r_address" class="text-black">Alamat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="r_address" name="r_address"
                  placeholder="Jl. Panjaitan Mawar II, no. 76" required>
              </div>
            </div>

            {{-- <div class="form-group">
            <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account"
              role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1"
                id="c_create_account">
              Create an account?</label>
            <div class="collapse" id="create_an_account">
              <div class="py-2">
                <p class="mb-3">Create an account by entering the information below. If you are a
                  returning customer please login at the top of the page.</p>
                <div class="form-group">
                  <label for="c_account_password" class="text-black">Account Password</label>
                  <input type="email" class="form-control" id="c_account_password" name="c_account_password"
                    placeholder="">
                </div>
              </div>
            </div>
          </div> --}}

            <div class="form-group">
              <label for="r_notes" class="text-black">Catatan Pembeli</label>
              <textarea name="r_notes" id="r_notes" cols="30" rows="5" class="form-control"
                placeholder="Pagar Putih, Mobil Avanza Hitam, etc..."></textarea>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">

        <div class="row mb-5">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Coupon Code</h2>
            <div class="p-3 p-lg-5 border">

              <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
              <div class="input-group w-75">
                <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code"
                  aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Your Order</h2>
            <div class="p-3 p-lg-5 border">
              <table class="table site-block-order-table mb-5">
                <thead>
                  <th>Product</th>
                  <th>Total</th>
                </thead>
                <tbody>
                  @foreach(session('cart') as $item)
                  <tr>
                    <td>{{ $item['name'] }}<strong class="mx-2"> x
                      </strong>{{ $item['quantity'] }}<br>{{ Http::get(url('api/colours/'.$item['colour']))['data']['colour'] }}
                      {{ Http::get(url('api/sizes/'.$item['size']))['data']['size'] }}
                    </td>
                    <td id="productTotalText{{ $loop->index }}">IDR {{ $item['price'] }}</td>
                    <input type="hidden" id="productQuantity{{ $loop->index }}" value="{{ $item['quantity'] }}">
                    <input type="hidden" id="productPrice{{ $loop->index }}" value="{{ $item['price'] }}">
                  </tr>
                  @endforeach
                  <tr>
                    <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                    <td class="text-black" id="subtotalText">IDR {{ $cartTotal }}</td>
                  </tr>
                  <tr>
                    <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                    <td class="text-black font-weight-bold" id="totalText"><strong>IDR {{ $cartTotal }}</strong></td>
                  </tr>
                </tbody>
              </table>

              <div class="border p-3 mb-3">
                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button"
                    aria-expanded="false" aria-controls="collapsebank">Direct Bank
                    Transfer</a></h3>

                <div class="collapse" id="collapsebank">
                  <div class="py-2">
                    <p class="mb-0">Make your payment directly into our bank account. Please use
                      your Order ID as the payment reference. Your order won’t be shipped until
                      the funds have cleared in our account.</p>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <button class="btn btn-primary btn-lg py-3 btn-block" type="submit" form="checkout-form">Place
                  Order</button>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- </form> -->
  </div>
</div>
@endsection

@section('scripts')
@endsection