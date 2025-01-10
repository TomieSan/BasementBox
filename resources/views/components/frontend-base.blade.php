<x-site-base :$title>
  @prepend('styles')
  {{-- STYLES --}}
  {{-- This is where you add stylesheet 'link' elements that should be imported by all FRONTEND pages --}}
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @endprepend

  <x-slot:header>
  @if($includeNavbar)
    <x-frontend.navbar/>
  @endif
  </x-slot:header>
  
  {{ $slot }}
  
  <x-slot:footer>
  @if($includeFooter)  
    <x-frontend.footer/>
  @endif
  </x-slot:footer>

  @prepend('scripts')
  {{-- SCRIPTS --}}
  {{-- This is where you add javascript 'script' elements that should be loaded by all FRONTEND pages --}}
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  @endprepend
</x-site-base>