@extends('layouts/main-client')

@section('title', 'Home')

@section('container')

{{-- Main Heading --}}
<div class="site-blocks-cover" style="background-image: url(/images/homepage/background1_stretch.jpg);" data-aos="fade">
  <div class="container">
    <div class="row align-items-center justify-content-center justify-content-md-end">
      <div class="col-12 col-md-5 text-center text-md-left pt-5 pt-md-0">
        <h2 class="mb-2 text-black">High-End Quality Women’s Apparel</h2>
        <div class="intro-text text-center text-md-left">
          <p class="mb-4">Best Price Guaranteed</p>
          <p>
            <a href="#" class="btn btn-sm btn-primary">Shop Now</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Shipping, Payments & Customer Support --}}
<div class="site-section site-section-sm site-blocks-1">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
        <div class="icon mr-4 align-self-start">
          <span class="icon-truck"></span>
        </div>
        <div class="text">
          <h2 class="text-uppercase">Detail Pengiriman</h2>
          <p>Semua barang yang kita jual adalah PO (Pre-Order)
            dari Hongkong & Bangkok paling cepet 1 Minggu &
            paling lama 3 Minggu</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
        <div class="icon mr-4 align-self-start">
          <span class="icon-refresh2"></span>
        </div>
        <div class="text">
          <h2 class="text-uppercase">Sistem Pembayaran</h2>
          <p>Sistem Pembayarannya bisa di DP dulu 50%, kalau
            barang sudah sampai baru pelunasan sisanya. Money
            back guaranteed / Uang akan dikembalikan 100% jika
            barangnya tidak sampai</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
        <div class="icon mr-4 align-self-start">
          <span class="icon-help"></span>
        </div>
        <div class="text">
          <h2 class="text-uppercase">Customer Support</h2>
          <p>Jika ada keluhan/kendala bisa langsung contact
            kita di nomor yang tertera dibawah.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- List of Collections --}}
<div class="site-section site-blocks-2">
  <div class="container">
    <div class="row">
      @foreach ($categories as $category)
      <div class="col-sm-6 col-md-6 col-lg-4 mb-4" data-aos="fade" data-aos-delay="">
        <a class="block-2-item category-thumbnail"
          href="{{ route('catalogue.category', ['category' => $category['category']]) }}">
          <figure class="image">
            <img
              src="http://myloloid-backend.test/uploads/images/{{ Http::get('http://myloloid-backend.test/api/categories/'.$category['id'].'/thumbnail')['data']['file'] }}"
              alt="" class="img-fluid">
          </figure>
          <div class="text">
            <span class="text-uppercase">Collections</span>
            <h3>{{ $category['category'] }}</h3>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- Best Sellers --}}
<div class="site-section block-3 site-blocks-2 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 site-section-heading text-center pt-4">
        <h2>Best Sellers</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="nonloop-block-3 owl-carousel">
          <div class="item">
            <div class="block-4 text-center">
              <figure class="block-4-image">
                <img src="images/homepage/bestseller1.jpg" alt="Image placeholder" class="img-fluid">
              </figure>
              <div class="block-4-text p-4">
                <h3><a href="#">Jacket</a></h3>
                <p class="mb-0">Mylo Multicolor Jacket</p>
                <p class="text-primary font-weight-bold">IDR 399k</p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="block-4 text-center">
              <figure class="block-4-image">
                <img src="images/homepage/bestseller2.jpg" alt="Image placeholder" class="img-fluid">
              </figure>
              <div class="block-4-text p-4">
                <h3><a href="#">Tops</a></h3>
                <p class="mb-0">Mylo Mesh Wrinkled Top</p>
                <p class="text-primary font-weight-bold">IDR 359k</p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="block-4 text-center">
              <figure class="block-4-image">
                <img src="images/homepage/bestseller3.jpg" alt="Image placeholder" class="img-fluid">
              </figure>
              <div class="block-4-text p-4">
                <h3><a href="#">Tops</a></h3>
                <p class="mb-0">Mylo Ruffle Top</p>
                <p class="text-primary font-weight-bold">IDR 379k</p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="block-4 text-center">
              <figure class="block-4-image">
                <img src="images/homepage/bestseller4.jpg" alt="Image placeholder" class="img-fluid">
              </figure>
              <div class="block-4-text p-4">
                <h3><a href="#">Dress</a></h3>
                <p class="mb-0">Mylo Slashed Dress</p>
                <p class="text-primary font-weight-bold">IDR 349k</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Sales or Promotion Section --}}
{{-- <div class="site-section block-8">
  <div class="container">
    <div class="row justify-content-center  mb-5">
      <div class="col-md-7 site-section-heading text-center pt-4">
        <h2>Big Sale!</h2>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-md-12 col-lg-7 mb-5">
        <a href="#"><img src="images/blog_1.jpg" alt="Image placeholder" class="img-fluid rounded"></a>
      </div>
      <div class="col-md-12 col-lg-5 text-center pl-md-5">
        <h2><a href="#">50% less in all items</a></h2>
        <p class="post-meta mb-4">By <a href="#">Carl Smith</a> <span class="block-8-sep">&bullet;</span> September
          3, 2018</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste dolor accusantium
          facere corporis ipsum animi deleniti fugiat. Ex, veniam?</p>
        <p><a href="#" class="btn btn-primary btn-sm">Shop Now</a></p>
      </div>
    </div>
  </div>
</div> --}}
@endsection