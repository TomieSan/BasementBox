<x-frontend-base title="BasementBox | Checkout" :includeNavbar="true" :includeFooter="true">
  @push('styles')

  @endpush
  
  <div class="container">
    <div class="py-5 text-center">
      <h2>Checkout form</h2>
      <a href="{{ url('/cart') }}">Cancel</a>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
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
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>
        <form action="{{ url('/checkout') }}" method="post">
          @csrf
          <div class="row row-cols-2">
            <x-frontend.field name="firstName" displayName="First Name" />
            <x-frontend.field name="lastName" displayName="Last Name" />
          </div>

          <x-frontend.textarea name="address1" displayName="Address 1" placeholder="1234 Main St" />
          <x-frontend.textarea name="address2" displayName="Address 2 (Optional)" placeholder="Apartment or Suite"/>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="province">Province</label>
              <select class="form-select d-block w-100 @error('province') is-invalid @enderror" id="province" name="province" value="Choose..." >
                <option value="Abra">Abra</option>
                <option value="Agusan del Norte">Agusan del Norte</option>
                <option value="Agusan del Sur">Agusan del Sur</option>
                <option value="Aklan">Aklan</option>
                <option value="Albay">Albay</option>
                <option value="Antique">Antique</option>
                <option value="Apayao">Apayao</option>
                <option value="Aurora">Aurora</option>
                <option value="Basilan">Basilan</option>
                <option value="Bataan">Bataan</option>
                <option value="Batanes">Batanes</option>
                <option value="Batangas">Batangas</option>
                <option value="Benguet">Benguet</option>
                <option value="Biliran">Biliran</option>
                <option value="Bohol">Bohol</option>
                <option value="Bukidnon">Bukidnon</option>
                <option value="Bulacan">Bulacan</option>
                <option value="Cagayan">Cagayan</option>
                <option value="Camarines Norte">Camarines Norte</option>
                <option value="Camarines Sur">Camarines Sur</option>
                <option value="Camiguin">Camiguin</option>
                <option value="Capiz">Capiz</option>
                <option value="Catanduanes">Catanduanes</option>
                <option value="Cavite">Cavite</option>
                <option value="Cebu">Cebu</option>
                <option value="Cotabato">Cotabato</option>
                <option value="Davao de Oro (Compostela Valley)">Davao de Oro (Compostela Valley)</option>
                <option value="Davao del Norte">Davao del Norte</option>
                <option value="Davao del Sur">Davao del Sur</option>
                <option value="Davao Occidental">Davao Occidental</option>
                <option value="Davao Oriental">Davao Oriental</option>
                <option value="Dinagat Islands">Dinagat Islands</option>
                <option value="Eastern Samar">Eastern Samar</option>
                <option value="Guimaras">Guimaras</option>
                <option value="Ifugao">Ifugao</option>
                <option value="Ilocos Norte">Ilocos Norte</option>
                <option value="Ilocos Sur">Ilocos Sur</option>
                <option value="Iloilo">Iloilo</option>
                <option value="Isabela">Isabela</option>
                <option value="Kalinga">Kalinga</option>
                <option value="La Union">La Union</option>
                <option value="Laguna">Laguna</option>
                <option value="Lanao del Norte">Lanao del Norte</option>
                <option value="Lanao del Sur">Lanao del Sur</option>
                <option value="Leyte">Leyte</option>
                <option value="Maguindanao del Norte">Maguindanao del Norte</option>
                <option value="Maguindanao del Sur">Maguindanao del Sur</option>
                <option value="Marinduque">Marinduque</option>
                <option value="Masbate">Masbate</option>
                <option value="Misamis Occidental">Misamis Occidental</option>
                <option value="Misamis Oriental">Misamis Oriental</option>
                <option value="Mountain Province">Mountain Province</option>
                <option value="Negros Occidental">Negros Occidental</option>
                <option value="Negros Oriental">Negros Oriental</option>
                <option value="Northern Samar">Northern Samar</option>
                <option value="Nueva Ecija">Nueva Ecija</option>
                <option value="Nueva Vizcaya">Nueva Vizcaya</option>
                <option value="Occidental Mindoro">Occidental Mindoro</option>
                <option value="Oriental Mindoro">Oriental Mindoro</option>
                <option value="Palawan">Palawan</option>
                <option value="Pampanga">Pampanga</option>
                <option value="Pangasinan">Pangasinan</option>
                <option value="Quezon">Quezon</option>
                <option value="Quirino">Quirino</option>
                <option value="Rizal">Rizal</option>
                <option value="Romblon">Romblon</option>
                <option value="Samar">Samar</option>
                <option value="Sarangani">Sarangani</option>
                <option value="Siquijor">Siquijor</option>
                <option value="Sorsogon">Sorsogon</option>
                <option value="South Cotabato">South Cotabato</option>
                <option value="Southern Leyte">Southern Leyte</option>
                <option value="Sultan Kudarat">Sultan Kudarat</option>
                <option value="Sulu">Sulu</option>
                <option value="Surigao del Norte">Surigao del Norte</option>
                <option value="Surigao del Sur">Surigao del Sur</option>
                <option value="Tarlac">Tarlac</option>
                <option value="Tawi-Tawi">Tawi-Tawi</option>
                <option value="Zambales">Zambales</option>
                <option value="Zamboanga del Norte">Zamboanga del Norte</option>
                <option value="Zamboanga del Sur">Zamboanga del Sur</option>
                <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
              </select>
              @error('province')
              <div class="invalid-feedback">
                Please provide a valid province.
              </div>
              @enderror
            </div>

            <div class="col-md-3 mb-3">
              <label for="zip">Zip</label>
              <input type="text" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" placeholder="" >
              @error('zip')
              <div class="invalid-feedback">
                Zip code required.
              </div>
              @enderror
            </div>
          </div>
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="sameAddress" id="same-address">
            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>
          <hr class="mb-4">

          <h4 class="mb-3">Payment</h4>

          <div class="d-block my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" value="credit" type="radio" class="form-check-input @error('paymentMethod') is-invalid @enderror" checked >
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" value="debit" type="radio" class="form-check-input @error('paymentMethod') is-invalid @enderror" >
              <label class="form-check-label" for="debit">Debit card</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" value="paypal" type="radio" class="form-check-input @error('paymentMethod') is-invalid @enderror" >
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cc-name">Name on card</label>
              <input type="text" class="form-control @error('nameOnCard') is-invalid @enderror" id="cc-name" name="nameOnCard" placeholder="" >
              <small class="text-muted">Full name as displayed on card</small>
              @error('nameOnCard')
              <div class="invalid-feedback">
                Name on card is required
              </div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="cc-number">Credit card number</label>
              <input type="text" class="form-control @error('ccNumber') is-invalid @enderror" id="cc-number" name="ccNumber" placeholder="" >
              @error('ccNumber')
              <div class="invalid-feedback">
                Credit card number is required
              </div>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Expiration</label>
              <input type="text" class="form-control @error('ccExpiration') is-invalid @enderror" id="cc-expiration" name="ccExpiration" placeholder="" >
              @error('ccExpiration')
              <div class="invalid-feedback">
                Expiration date required
              </div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV</label>
              <input type="text" class="form-control @error('ccCvv') is-invalid @enderror" id="cc-cvv" name="ccCvv" placeholder="" >
              @error('ccCvv')
              <div class="invalid-feedback">
                Security code required
              </div>
              @enderror
            </div>
          </div>
          <hr class="mb-4">
          <div class="d-grid">
            <button class="btn btn-secondary btn-lg" type="submit">Continue to checkout</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  @push('scripts')

  @endpush
</x-frontend-base>