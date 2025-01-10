<x-frontend-base title="BasementBox | Login" :includeNavbar="true" :includeFooter="true">
  @push('styles')

  @endpush
  
  <div class="container p-5">
            <div class="row mt-2">
                <div class="col-md-4 offset-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">Login</h4>
                            <form action="{{ url('/login')}}" id="login" method="post">
                                @csrf
                                <x-frontend.field name="usernameOrEmail" displayName="Username or Email" placeholder="Enter username or email" required="true"/>
                                <x-frontend.field name="password" displayName="Password" placeholder="Password" required="true" type="password"/>
                                <div class="text-center">
                                    @error('result')
                                    <p class="text-danger mb-3"> {{ $message }} </p>
                                    @enderror
                                    <button type="submit" class="btn btn-dark mb-3 d-block mx-auto">Login</button>
                                    <a href="{{ url('/register') }}">Don't have an Account yet?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
  @push('scripts')

  @endpush
</x-frontend-base>