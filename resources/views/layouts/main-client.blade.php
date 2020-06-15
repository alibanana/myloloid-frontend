<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">

  {{-- CSS From Shoppers Template --}}
  <link rel="stylesheet" href="{{ asset('templates/client/fonts/icomoon/style.css') }} ">
  <link rel="stylesheet" href="{{ asset('templates/client/css/bootstrap.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('templates/client/css/magnific-popup.css') }} ">
  <link rel="stylesheet" href="{{ asset('templates/client/css/jquery-ui.css') }} ">
  <link rel="stylesheet" href="{{ asset('templates/client/css/owl.carousel.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('templates/client/css/owl.theme.default.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('templates/client/css/aos.css') }} ">
  <link rel="stylesheet" href="{{ asset('templates/client/css/style.css') }} ">

  {{-- Own CSS --}}
  <link rel="stylesheet" href="{{ asset('/css/added.css') }}">

  @yield('links')

  <title>@yield('title')</title>

</head>

<body>

  <div class="site-wrap">

    {{-- Navigation Bar --}}
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="d-flex align-items-center justify-content-between">
            {{-- <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Search">
              </form>
            </div> --}}

            {{-- Shop Logo --}}
            <div class="logo">
              <div class="site-logo">
                <a href="/" class="js-logo-clone">MyloloID</a>
              </div>
            </div>

            {{-- Site Navigations --}}
            <div class="main-nav d-none d-lg-block">
              <nav class="site-navigation text-right text-md-center" role="navigation">
                <ul class="site-menu js-clone-nav d-none d-md-block">
                  <li><a href="/">Home</a></li>
                  <li class="has-children">
                    <a href="/catalogue">Catalogue</a>
                    <ul class="dropdown">
                      @foreach ($categories as $category)
                      <li><a
                          href="{{ route('catalogue.category', ['category' => $category['category']]) }}">{{ $category['category'] }}</a>
                      </li>
                      @endforeach
                    </ul>
                  </li>
                  <li><a href="/cart">Cart</a></li>
                  <li><a href="#">How to Order</a></li>
                  <li><a href="/confirmation">Confirmation</a></li>
                </ul>
              </nav>
            </div>

            {{-- Icons on the right --}}
            <div class="site-top-icons">
              <ul>
                <li><a href="/dashboard"><span class="icon icon-person"></span></a></li>
                <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                <li>
                  <a href="/cart" class="site-cart">
                    <span class="icon icon-shopping_cart"></span>
                    @if (session()->has('cart'))
                    <span class="count">{{ count(session('cart')) }}</span>
                    @endif
                  </a>
                </li>
                <li class="d-inline-block d-lg-none">
                  <a href="#" class="site-menu-toggle js-menu-toggle">
                    <span class="icon-menu"></span></a>
                </li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </header>

    @yield('container')

    @if (Route::current()->getName() != 'invoice.index')
    <footer class="site-footer border-top">
      <div class="container">
        <div class="row mb-sm-2">
          <div class="col-sm-6 mb-2 mb-sm-0">
            <h3 class="footer-heading mb-4 text-center text-sm-left">Navigations</h3>
            <div class="row">
              <div class="col-6">
                <ul class="list-unstyled">
                  <li><a href="/">Home</a></li>
                  <li><a href="/catalogue">Catalogue</a></li>
                  <li><a href="/cart">Shopping cart</a></li>
                </ul>
              </div>
              <div class="col-6">
                <ul class="list-unstyled">
                  <li><a href="#">How to Order</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-6 mb-2 mb-sm-0">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4 text-center text-sm-left">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="instagram"><a href="https://www.instagram.com/mylolo.id/">mylolo.id</li>
                <li class="phone"><a href="tel://+628112383399">+62 811 238 3399</a></li>
                <li class="email">mylolo.id@gmail.com</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-sm-6 ">
            <div class="block-7">
              <form action="#" method="post">
                <label for="email_subscribe" class="footer-heading">Subscribe</label>
                <div class="form-group">
                  <input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">
                  <input type="submit" class="btn btn-sm btn-primary" value="Send">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i>
              by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>
      </div>
    </footer>
    @endif

  </div>

  {{-- Javascripts from Shoppers Template --}}
  <script src="{{ asset('templates/client/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('templates/client/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('templates/client/js/popper.min.js') }}"></script>
  <script src="{{ asset('templates/client/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('templates/client/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('templates/client/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('templates/client/js/aos.js') }}"></script>
  <script src="{{ asset('templates/client/js/main.js') }}"></script>

  @yield('scripts')
</body>

</html>