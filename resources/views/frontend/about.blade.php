<x-frontend-base title="BasementBox | About Us" :includeNavbar="true" :includeFooter="true">
  @push('styles')
  <link rel="stylesheet" href="{{ asset('css/about.css') }}">
  @endpush
  
  <br>
  <div class="container px-5">
        <img class="pic" src="{{ asset('photos/logo.png') }}" alt="Photo of me" style="width:200px;height:200px;"><br>
        <center><h3>About Basement Box</h3>
        <p>A haven for gamers seeking a unique experience. 
            Immerse yourself in the nostalgia and charm of classic gaming while exploring our curated collection of retro-inspired games. 
            With a blend of modern and retro titles, our platform offers something for everyone. 
            Browse, purchase, and rate games through our retro-themed interface, designed to evoke the magic of gaming's golden age.
        </p>
        <hr/>
    </div>
    <div class="container-fluid px-5">
        <center><h2>Developers</h2>
        <br>
        <div class="row mb-3">
            <div class="col-md-4">
                <img class="pic" src="{{ asset('photos/aaliyah.jpg') }}" alt="Photo of me" style="width:200px;height:200px;"><br>
                <center><h3>Aaliyah Santos</h3>
                <p>Aaliyah is a third-year university student at the University of Santo Tomas.</p>
            </div>
            <div class="col-md-4">
                <img class="pic" src="{{ asset('photos/hans.jpg') }}" alt="Photo of me" style="width:200px;height:200px;"><br>
                <center><h3>Hans Ramos</h3>
                <p>Hans is a second-year university student at the University of Santo Tomas.</p>
            </div>
            <div class="col-md-4">
                <img class="pic" src="{{ asset('photos/allen.jpg') }}" alt="Photo of me" style="width:200px;height:200px;"><br>
                <center><h3>Jon Allen Yanga</h3>
                <p>Allen is a second-year university student at the University of Santo Tomas.</p>
            </div>
    </div>
    </div>

  @push('scripts')

  @endpush
</x-frontend-base>