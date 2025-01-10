<nav class="navbar navbar-expand-lg sticky-top navbar-light p-3 shadow-sm" style="background: #353B48;">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('photos/logo.png') }}" height="80" /> <strong>BASEMENTBOX</strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class=" collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="{{ url('/') }}">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="{{ url('/browse') }}">ALL PRODUCTS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="{{ url('/about') }}">ABOUT US</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto ">
        @auth
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="{{ url('/games/publish') }}"><i class="fa-solid fa-upload me-1"></i> PUBLISH</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="{{ url('/cart') }}"><i class="fa-solid fa-cart-shopping me-1"></i> CART</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="{{ url('/logout') }}"><i class="fa-solid fa-cart-shopping me-1"></i> LOG OUT</a>
        </li>
        @endauth
        @guest
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="{{ url('/login') }}"><i class="fa-solid fa-right-to-bracket"></i> LOGIN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="{{ url('/register') }}"><i class="fa-solid fa-user-plus"></i> SIGN UP</a>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>