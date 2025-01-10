@props(['title'=>'Basement Box'])
<!doctype html>
<html lang="en">

<head>
  <title>{{ $title }}</title>
  {{-- Required meta tags --}}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  {{-- STYLES --}}
  {{-- This is where you add stylesheet 'link' elements that should be imported by all pages --}}
  {{-- Bootstrap CSS v5.2.1 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" 
        crossorigin="anonymous">
  @stack('styles')
</head>

<body>
  <header>
    {{ $header }}
  </header>

  <main>
    {{ $slot }}
  </main>

  <footer>
    {{ $footer }}
  </footer>

  {{-- SCRIPTS --}}
  {{-- This is where you add javascript 'script' elements that should be loaded by all pages --}}
  {{-- Bootstrap JavaScript Libraries --}}
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
          integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" 
          crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
          integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" 
          crossorigin="anonymous">
  </script>
  @stack('scripts')
</body>

</html>