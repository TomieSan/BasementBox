<x-frontend-base title="BasementBox | Home" :includeNavbar="true" :includeFooter="true">
  @push('styles')
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  @endpush

  <section>
    <div class="content">
      <div class="info">
        <h2>What do you want to see?</h2>
        <div class="home-searchbar">
          <div class="searchbox">
            <form action="{{ url('/browse') }}">
              <button class="btn-menu"></button>
              <input id="search" type="text" placeholder="Search..." name="search" class="search">
              <button class="btn-search" type="submit">
                <img src="https://img.icons8.com/cotton/24/000000/search--v2.png">
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  @php
  function build_sort_url($criteria = 'name', $direction = 'asc')
  {
    return url('/browse').'?'.http_build_query(['criteria'=>$criteria, 'direction'=>$direction]);
  }
  @endphp

  <!--POPULAR-->
  <div class="container-fluid">
    <div class="products">
      Most Popular
    </div>
    <div class="row row-cols-3 justify-content-center">
      @foreach($popGames as $game)
      <x-frontend.product-card style="width:300px" :game="$game"/>
      @endforeach
    </div>
    <div class="text-center view-all">
      <a href="{{ build_sort_url('rating', 'desc') }}">
        <button>Browse Most Popular</button>
      </a>
    </div>
  </div>
  <!--End OF POPULAR-->

  <hr>

  <!--NEW GAMES-->
  <div class="container-fluid">
    <div class="products">
      New Games
    </div>
    <div class="row row-cols-3 justify-content-center">
      @foreach($newGames as $game)
      <x-frontend.product-card style="width:300px" :game="$game"/>
      @endforeach
    </div>
    <div class="text-center view-all">
      <a href="{{ build_sort_url('created_at', 'desc') }}">
        <button>Browse New Games</button>
      </a>
    </div>
  </div>
  <!--End OF NEW GAMES-->

  @push('scripts')

  @endpush
</x-frontend-base>