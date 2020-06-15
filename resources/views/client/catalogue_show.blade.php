@extends('layouts/main-client')

@section('title', 'Product')

@section('container')

{{-- Home / Shop --}}
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ url('/catalogue') }}">Catalogue</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Product</strong></div>
        </div>
    </div>
</div>

{{-- Main Container --}}
<div class="site-section">
    <div class="container">
        <div class="row">
            {{-- Image Carousel --}}
            <div class="col-md-8">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($product['photos'] as $photo)
                        @if ($loop->first)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="active">
                        </li>
                        @else
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}">
                        </li>
                        @endif
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($product['photos'] as $photo)
                        @if ($loop->first)
                        <div class="carousel-item active">
                            <img src="http://myloloid-backend.test/uploads/images/{{ $photo['file'] }}"
                                class="d-block w-100 img-thumbnail" alt="...">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img src="http://myloloid-backend.test/uploads/images/{{ $photo['file'] }}"
                                class="d-block w-100 img-thumbnail" alt="...">
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            {{-- Product Details --}}
            <div class="col-md-4">
                <h5 class="mb-0 text-secondary">{{ $product['category']['category'] }}</h5>
                <h1 class="mb-4 text-primary">{{ $product['name'] }}</h1>

                <label for="productDescription" class="text-dark font-weight-bold mb-0">Description</label>
                <div class="container">
                    <p class="">{{ $product['description'] }}</p>
                </div>

                <form enctype="multipart/form-data" action="{{ url('catalogue/products/'.$product['id']) }}"
                    method="post">
                    {{ csrf_field() }}

                    {{-- Colours Button Group --}}
                    <label for="coloursButtonGroup" class="text-dark font-weight-bold">Colour</label>
                    <div class="container mb-2" id="coloursButtonGroup">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            @foreach ($product['colours'] as $colour)
                            @if ($loop->first)
                            <label class="btn btn-light active">
                                <input type="radio" name="colour" id="option{{ $loop->index }}"
                                    value="{{ $colour['id'] }}" checked>{{ $colour['colour'] }}
                            </label>
                            @else
                            <label class="btn btn-light">
                                <input type="radio" name="colour" id="option{{ $loop->index }}"
                                    value="{{ $colour['id'] }}">{{ $colour['colour'] }}
                            </label>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Sizes Button Group --}}
                    <label for="sizesButtonGroup" class="text-dark font-weight-bold">Size</label>
                    <div class="container mb-4" id="sizesButtonGroup">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            @foreach ($product['sizes'] as $size)
                            @if ($loop->first)
                            <label class="btn btn-light active">
                                <input type="radio" name="size" id="option{{ $loop->index }}" value="{{ $size['id'] }}"
                                    checked>{{ $size['size'] }}
                            </label>
                            @else
                            <label class="btn btn-light">
                                <input type="radio" name="size" id="option{{ $loop->index }}"
                                    value="{{ $size['id'] }}">{{ $size['size'] }}
                            </label>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Quantity --}}
                    <div class="form-group mb-4">
                        <label for="inputQuantity" class="text-dark font-weight-bold">Quantity</label>
                        <div class="container">
                            <input type="number" class="form-control w-25" id="inputQuantity" name="quantity" min="1"
                                max="9" onchange="updateTotal()" value="1" required>
                        </div>
                    </div>

                    {{-- Add to Cart Button --}}
                    <div class="form-group">
                        <div class="container">
                            <div class="row">
                                <h4 class="text-dark font-weight-bold mr-4 my-auto" id="priceText">IDR
                                    {{ $product['price'] }}</h4>
                                <button type="submit" class="btn btn-md btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function updateTotal() {
        var qty = document.getElementById('inputQuantity').value;
        var price = document.getElementById('priceText');
        price.textContent = 'IDR ' + <?php echo $product['price'] ?> * qty;
    }
</script>
@endsection