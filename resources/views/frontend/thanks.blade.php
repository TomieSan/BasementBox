<x-frontend-base title="BasementBox | Thank you!"  :includeNavbar="true" :includeFooter="true">
  @push('styles')@endpush
  
  <div class="container mt-4">
    <div class="row justify-content-center text-center">
      <h1>Thank you!</h1>
      <p>Your purchase will be processed. Why not go back to the main page some more?</p>
      <a href="{{ url('/') }}">Go to Homepage</a>
    </div>
  </div>
  
  @push('scripts')@endpush
</x-frontend-base>