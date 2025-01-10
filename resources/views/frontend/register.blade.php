<x-frontend-base title="BasementBox | Register" :includeNavbar="true" :includeFooter="true">
  @push('styles')

  @endpush
  
  <div class="container p-5">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">Register Here</h4><br>
                            <form action="{{ url('/register')}}" id="signup" method="post">
                              @csrf

                              <x-frontend.field displayName="Username"
                                              name="username"
                                              hasHelp="true"
                                              required="true"
                                              errorBag="add"
                                              helpText="Enter your desired username."/>

                              <x-frontend.field displayName="Email"
                                              name="email"
                                              type="email"
                                              hasHelp="true"
                                              required="true"
                                              errorBag="add"
                                              helpText="Enter your email."/>

                              <x-frontend.field displayName="Password"
                                              name="password"
                                              type="password"
                                              hasHelp="true"
                                              required="true"
                                              errorBag="add"
                                              helpText="Must be at least 12 alphanumeric characters with at least 1 uppercase character, at least 1 lowercase character, and at least 1 symbol."/>

                              <x-frontend.field displayName="Confirm Password"
                                              name="password_confirmation"
                                              type="password"
                                              hasHelp="true"
                                              required="true"
                                              errorBag="add"
                                              helpText="Enter your password again."/>

                              <div class="text-center">
                                  <button type="submit" class="btn btn-dark d-block mb-3 mx-auto">Register</button>
                                  <a href="{{ url('/login') }}">Already have an Account?</a>
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