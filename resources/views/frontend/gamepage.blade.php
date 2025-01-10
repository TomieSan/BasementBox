<x-frontend-base title="BasementBox | Viewing game blah" :includeNavbar="true" :includeFooter="true">
  @push('styles')
  <link rel="stylesheet" href="{{ asset('css/gamepage.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  @endpush

  <div class="pd-wrap">
    <div class="container">
      <div class="heading-section">
        <h2>Product Details</h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div id="slider" class="owl-carousel product-slider">
            @php
            $imgs = ['logo', 'gamePic1', 'gamePic2', 'gamePic3', 'gamePic4'];
            $hasImgs = false;
            foreach($imgs as $img)
            {
              if($game[$img])
                $hasImgs = true;
            }
            @endphp
            @if($hasImgs)
            @foreach($imgs as $img)
            @if($game[$img] ?? false)
            <div class="item">
              <img src="{{ asset($game[$img]) }}" />
            </div>
            @endif
            @endforeach
            @else
            <div class="item">
              <img src="{{ asset('photos/nologo.png') }}" />
            </div>
            @endif
          </div>
          <div id="thumb" class="owl-carousel product-thumb">
            @if($hasImgs)
            @foreach($imgs as $img)
            @if($game[$img] ?? false)
            <div class="item">
              <img src="{{ asset($game[$img]) }}" />
            </div>
            @endif
            @endforeach
            @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="product-dtl">
            <div class="product-info">
              <div class="product-name"><strong class="text-dark">{{ $game->name }}</strong></div>
              <div class="text-muted"><em>By {{ $game->publisher()->first()['username'] }}</em></div>
              <div class="reviews-counter">
                <span class="hint-star star">
                  @for($i = floor($game->rating); $i > 0; $i--)
                  <i class="fa fa-star" aria-hidden="true"></i>
                  @endfor
                </span>
                <span>{{ $game->reviews()->count() }} Reviews</span>
              </div>
              <div class="product-price-discount">P{{ $game->price }}</div>
            </div>
            <p>
            @if($game->excerpt)
            {{ $game->excerpt }}
            @else
            <em>The publisher has not provided an excerpt for this game.</em>
            @endif
            </p>
            <div class="product-count">
              <label for="size">Quantity</label>
              <form action="{{ url('/cart/new') }}" method="post">
                @csrf
                <div class="display-flex">
                  <div class="qtyminus">-</div>
                  <input type="hidden" name="game_id" value="{{ $game->id }}">
                  <input type="text" name="quantity" min="1" value="1" class="qty">
                  <div class="qtyplus">+</div><br>
                </div>
                <button type="submit" class="round-black-btn">Add to Cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="product-info-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
          </li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="description" role="tabpanel" aria-labelledby="description-tab">
          @if($game->description)
          {{ $game->description }}
          @else
          <em>The publisher has not provided a description for this game.</em>
          @endif
          </div>
          <div class="tab-pane" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
            @auth
            <div class="review-heading">SUBMIT A REVIEW</div>
            <div id="review-form" class="mb-4">
              <form action="{{ url('/games/review/new') }}" method="post" class="review-form">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}">
                <div class="form-group">
                  <label>Your rating</label>
                  <div class="reviews-counter">
                    <div class="rate">
                      @for($i = 5; $i > 1; $i--)
                      <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}"/>
                      <label for="star{{$i}}" title="text">{{$i}} stars</label>
                      @endfor
                      <input type="radio" id="star1" name="rating" value="1" />
                      <label for="star1" title="text">1 star</label>
                    </div>
                    @error('rating','review')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <x-frontend.field name="title" displayName="Title" errorBag="review"/>
                <x-frontend.textarea name="body" displayName="Content" errorBag="review" expectedHeight="10"></x-frontend.textarea>
                <button type="submit" class="round-black-btn">Submit Review</button>
              </form>
            </div>
            @endauth
            <div class="review-heading border-top pt-3">REVIEWS</div>
            <div id="review-container" class="overflow-auto card p-3" style="max-height: 500px;">
              @if($game->reviews()->count() < 1)
              <p class="mb-20">There are no reviews yet.</p>
              @else
              @foreach($game->reviews()->latest()->get() as $review)
              <div class="card mb-3">
                <div class="card-body">
                  <small class="text-muted">
                    <span class="hint-star star">
                      @for($i = $review->rating; $i > 0; $i--)
                      <i class="fa fa-star" aria-hidden="true"></i>
                      @endfor
                    </span>
                    <strong class="text-secondary"> from {{ App\Models\User::find($review->user_id)->username }}</strong> at 
                    <em>{{ date_create($review->created_at)->format('Y-m-d H:i:s') }}</em>
                  </small>
                  <h4 class="card-title">"{{ $review->title }}"</h4>
                  <p class="card-text">{{ $review->body }}</p>
                </div>
              </div>
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(session()->has('success'))
  <!-- Flexbox container for aligning the toasts -->
  <div aria-live="polite" aria-atomic="true" style="z-index: 9999" class="position-fixed p-3 start-50 bottom-0 translate-middle-x d-flex justify-content-center align-items-center" style="min-height: 200px;">
    <!-- Then put toasts within -->
    <div class="toast bg-light" id="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
      <strong class="me-auto text-dark">Review posted</strong>

      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ session('success') }}
      </div>
    </div>
  </div>
  @endif
  
  @push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script id="rendered-js">
    $(document).ready(function() {
      var slider = $("#slider");
      var thumb = $("#thumb");
      var slidesPerPage = 4; //globaly define number of elements per page
      var syncedSecondary = true;
      slider.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: false,
        autoplay: false,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200
      }).
      on('changed.owl.carousel', syncPosition);
      thumb.
      on('initialized.owl.carousel', function() {
        thumb.find(".owl-item").eq(0).addClass("current");
      }).
      owlCarousel({
        items: slidesPerPage,
        dots: false,
        nav: true,
        item: 4,
        smartSpeed: 200,
        slideSpeed: 500,
        slideBy: slidesPerPage,
        navText: ['<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
        responsiveRefreshRate: 100
      }).
      on('changed.owl.carousel', syncPosition2);

      function syncPosition(el) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - .5);
        if (current < 0) {
          current = count;
        }
        if (current > count) {
          current = 0;
        }
        thumb.
        find(".owl-item").
        removeClass("current").
        eq(current).
        addClass("current");
        var onscreen = thumb.find('.owl-item.active').length - 1;
        var start = thumb.find('.owl-item.active').first().index();
        var end = thumb.find('.owl-item.active').last().index();
        if (current > end) {
          thumb.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
          thumb.data('owl.carousel').to(current - onscreen, 100, true);
        }
      }

      function syncPosition2(el) {
        if (syncedSecondary) {
          var number = el.item.index;
          slider.data('owl.carousel').to(number, 100, true);
        }
      }
      thumb.on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = $(this).index();
        slider.data('owl.carousel').to(number, 300, true);
      });


      $(".qtyminus").on("click", function() {
        var now = $(".qty").val();
        if ($.isNumeric(now)) {
          if (parseInt(now) - 1 > 0) {
            now--;
          }
          $(".qty").val(now);
        }
      });
      $(".qtyplus").on("click", function() {
        var now = $(".qty").val();
        if ($.isNumeric(now)) {
          $(".qty").val(parseInt(now) + 1);
        }
      });
    });
    //# sourceURL=pen.js
  </script>
  @if(session()->has('success'))
  <script>
    new bootstrap.Toast(document.getElementById('toast')).show()
  </script>
  @endif
  @if($errors->hasBag('review'))
  <script>
    const review_btn = document.getElementById('reviews-tab');
    review_btn.click()
    review_btn.scrollIntoView({ behavior: 'smooth' })
  </script>
  @endif
  @endpush
</x-frontend-base>