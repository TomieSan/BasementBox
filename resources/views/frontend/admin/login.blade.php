<x-site-base title="BasementBox | Admin | Login">
  @push('styles')

  @endpush

  <x-slot:header></x-slot:header>

  <div class="container p-5">
    <div class="row mt-2">
      <div class="col-md-4 offset-md-4">
        <div class="card">
          <div class="card-body">
            <h4 class="text-center">Admin Login</h4>
            <form action="{{ url('/admin/login')}}" id="login" method="post">
              @csrf
              <x-frontend.field name="usernameOrEmail" displayName="Username or Email" placeholder="Enter username or email" required="true" />
              <x-frontend.field name="password" displayName="Password" placeholder="Password" required="true" type="password" />
              <div class="text-center">
                @error('result')
                <p class="text-danger mb-3"> {{ $message }} </p>
                @enderror
                <button type="submit" class="btn btn-dark mb-3 d-block mx-auto">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-slot:footer></x-slot:footer>

  @push('scripts')

  @endpush
</x-site-base>