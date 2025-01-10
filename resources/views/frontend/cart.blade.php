<x-frontend-base title="BasementBox | Cart" :includeNavbar="true" :includeFooter="false">
  @push('styles')
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
  @endpush

  <section class="h-100 h-custom">
    <br><br>
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                      <h6 class="mb-0 text-muted">Items: {{ $items->count() }}</h6>
                    </div>

                    @if(count($items) > 0)
                    <form action="cart/modify" method="post">
                      @csrf
                      @foreach($items as $item)
                      <hr class="my-4">
                      <div class="row mb-4 d-flex justify-content-between align-items-center">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                          <img src="{{ asset('photos/placeholder.png') }}" class="img-fluid rounded-3" alt="Cotton T-shirt">
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <h6 class="text-black mb-0">{{ $item->game()->first()->name }}</h6>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                          <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                            <i class="fas fa-minus"></i>
                          </button>

                          <input id="form1" min="1" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}" type="number" class="form-control form-control-sm" />

                          <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                          <h6 class="mb-0">P{{ $item->game()->first()->price }}</h6>
                        </div>
                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                          <!-- Button trigger modal -->
                          <button type="button" 
                                  class="btn text-muted" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#removeModal" 
                                  onclick="document.getElementById('item-id').value='{{ $item->id }}'">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                    @endforeach
                    <hr class="my-4">
                    <div class="row align-items-center">
                      <div class="col">Don't forget to click apply after changing the quantities in your wishlist!</div>
                      <button type="submit" class="btn btn-primary col-auto">Apply changes</button>
                    </div>
                    </form>
                    @else
                    <hr class="my-4">
                    <div class="text-center">
                      There are no items in the cart.
                    </div>
                    @endif

                    <hr class="my-4">

                    <div class="pt-5">
                      <h6 class="mb-0"><a href="{{ url('/browse') }}" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="p-5">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                      <span class="text-muted">Summary</span>
                      <span class="badge text-bg-secondary rounded-pill">{{ count($items) }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                      @php $subtotal = $total = 0.0; @endphp
                      @foreach($items as $item)
                      <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div class="container-fluid px-0">
                          <div class="row">
                            <div class="col">
                              <h6 class="my-0">{{ $item->game()->first()->name }}</h6>
                            </div>
                            <div class="col text-end"><span class="text-muted">P{{ $item->game()->first()->price }} x {{ $item->quantity }}</span></div>
                          </div>
                          <div class="row">
                            <div class="col"><strong class="my-0 text-dark">Subtotal: </strong></div>
                            @php
                            $subtotal = $item->game()->first()->price * $item->quantity;
                            $total += $subtotal;
                            @endphp
                            <div class="col text-end"><span class="text-muted">P{{ $subtotal }}</span></div>
                          </div>
                        </div>
                      </li>
                      @endforeach
                      <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong class="text-dark">P{{$total}}</strong>
                      </li>
                    </ul>

                    @if(count($items) > 0)
                    <a class="btn btn-dark btn-block btn-lg" href="{{ url('/checkout') }}">Checkout</a>
                    @else
                    <a class="btn btn-secondary btn-block btn-lg">Checkout</a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Modal -->
  <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="removeModalTitle">Remove item?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
          <div class="container-fluid">
            Are you sure you want to remove this item?
            <p class="text-danger">You cannot undo this action.</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ url('/cart/delete') }}" method="post">
            @csrf
            <input id="item-id" type="hidden" name="id">
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script src="https://kit.fontawesome.com/332a215f17.js" crossorigin="anonymous"></script>
  @endpush
</x-frontend-base>