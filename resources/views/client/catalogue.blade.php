@extends('layouts/main-client')

@section('title', 'Catalogue')

@section('container')

{{-- Home / Shop --}}
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
          class="text-black">Shop</strong></div>
    </div>
  </div>
</div>

{{-- Main Container --}}
<div class="site-section">
  <div class="container">

    {{-- Upper Row; Basically all the filters and products --}}
    <div class="row mb-5">
      {{-- Shop Sections; including the 2 dropdowns --}}
      <div class="col-md-9 order-2">
        {{-- Upper row; the 'Shop All' label and dropdowns --}}
        <div class="row">
          <div class="col-md-12 mb-5">
            <div class="float-md-left mb-4">
              <h2 class="text-black h5">Shop All</h2>
            </div>
            <div class="d-flex">
              <div class="dropdown mr-1 ml-md-auto">
                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  @if (array_key_exists('orderby', $params))
                  @if ($params['orderby'] == 'price')
                  Price, low to high
                  @elseif ($params['orderby'] == 'price_desc')
                  Price, high to low
                  @elseif ($params['orderby'] == 'name')
                  Name, A to Z
                  @elseif ($params['orderby'] == 'name_desc')
                  Name, Z to A
                  @endif
                  @else
                  Latest
                  @endif
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                  <a class="dropdown-item" href="{{ url()->current() }}">Latest</a>
                  <a class="dropdown-item" href="{{ url()->current() }}/?orderby=name">Name, A to Z</a>
                  <a class="dropdown-item" href="{{ url()->current() }}/?orderby=name_desc">Name, Z to A</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url()->current() }}/?orderby=price">Price,
                    low to high</a>
                  <a class="dropdown-item" href="{{ url()->current() }}/?orderby=price_desc">Price, high to low</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Row containing the products --}}
        <div class="row mb-5">
          @foreach ($products as $product)
          <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
            <div class="product-container">
              <a href="{{ url('catalogue/products/'.$product['id']) }}">
                <div class="row cat-product-thumbnail justify-content-center align-items-top m-0"><img
                    src="http://myloloid-backend.test/uploads/images/{{ Http::get('http://myloloid-backend.test/api/products/'.$product['id'].'/thumbnail')['data']['file'] }}"
                    alt="Image placeholder" class="">
                </div>
              </a>
              <div class="text-center cat-product-thumbnail-text">
                <p class="">{{ $product['name'] }}</p>
                <p class="text-primary font-weight-bold">IDR {{ $product['price'] }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        {{-- List of pages available --}}
        <div class="row" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      {{-- Col containing the categories and filter features --}}
      <div class="col-md-3 order-1 mb-5 mb-md-0">
        <div class="border p-4 rounded mb-4">
          <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
          <ul class="list-unstyled mb-0">
            <li class="mb-1"><a href="#" class="d-flex"><span>Bottoms</span> <span
                  class="text-black ml-auto">(15)</span></a></li>
            <li class="mb-1"><a href="#" class="d-flex"><span>Blazers / Jackets</span> <span
                  class="text-black ml-auto">(27)</span></a></li>
            <li class="mb-1"><a href="#" class="d-flex"><span>Outers-Coat</span> <span
                  class="text-black ml-auto">(9)</span></a></li>
            <li class="mb-1"><a href="#" class="d-flex"><span>Tops</span> <span
                  class="text-black ml-auto">(32)</span></a>
            </li>
            <li class="mb-1"><a href="#" class="d-flex"><span>Dresses</span> <span
                  class="text-black ml-auto">(15)</span></a></li>
            <li class="mb-1"><a href="#" class="d-flex"><span>Jumpsuits</span> <span
                  class="text-black ml-auto">(10)</span></a></li>
          </ul>
        </div>

        <div class="border p-4 rounded mb-4">
          <div class="mb-4">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
            <div id="slider-range" class="border-primary"></div>
            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
          </div>
        </div>
      </div>
    </div>

    {{-- Lower Row; The collections/categories sections --}}
    <div class="row">
      <div class="col-md-12">
        <div class="site-section site-blocks-2">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7 site-section-heading pt-4">
              <h2>Categories</h2>
            </div>
          </div>
          <div class="row">
            @foreach ($categories as $category)
            <div class="col-sm-6 col-md-6 col-lg-4 mb-4" data-aos="fade" data-aos-delay="">
              <a class="block-2-item category-thumbnail"
                href="{{ route('catalogue.category', ['category' => $category['category']]) }}">
                <figure class="image">
                  <img
                    src="http://myloloid-backend.test/uploads/images/{{ Http::get('http://mylolo-id.test/api/categories/'.$category['id'].'/thumbnail')['data']['file'] }}"
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
    </div>

  </div>
</div>

@endsection