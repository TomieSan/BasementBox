<x-site-base :$title>
  @prepend('styles')
  {{-- STYLES --}}
  {{-- This is where you add stylesheet 'link' elements that should be imported by all ADMIN pages --}}
  <!----CSS3---->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <!--google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <!--google material icon-->
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">
  @endprepend

  <x-slot:header></x-slot:header>

  <div class="wrapper">
    <div class="body-overlay"></div>
    <nav id="sidebar">
      <div class="sidebar-header">
        <h3><img src="{{ asset('photos/logo.png') }}" class="img-fluid" /><span>BASEMENT BOX</span></h3>
      </div>
      <ul class="list-unstyled components">
        <li class="">
          <a href="{{ url('/admin/users') }}" class="dashboard"><i class="material-icons">person</i>
            <span>USERS</span></a>
        </li>
        <li class="">
          <a href="{{ url('/admin/games') }}"><i class="material-icons">sports_esports</i><span>GAMES</span></a>
        </li>
      </ul>
      <div class="sidebar-profile">
        <ul class="profile">
          <li class="">
            <a href="{{ url('admin/logout') }}"><i class="material-icons">logout</i><span>Logout
              </span></a>
          </li>
        </ul>
      </div>
    </nav>
    <!--------page-content---------------->

    <div id="content">
      <!--top--navbar----design--------->
      <div class="top-navbar">
        <div class="xp-topbar">
          <!-- Start XP Row -->
          <div class="row">
            <!-- Start XP Col -->
            <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
              <div class="xp-menubar">
                <span class="material-icons text-white">signal_cellular_alt
                </span>
              </div>
            </div>
          </div>
          <!-- End XP Row -->
        </div>

      </div>
      {{ $dashboardHeading }}

      <!--------main-content------------->

      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            {{ $slot }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Modal HTML -->
  <div id="addModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        {{ $addModal }}
      </div>
    </div>
  </div>

  <!-- Edit Modal HTML -->
  <div id="editModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        {{ $editModal }}
      </div>
    </div>
  </div>

  <!-- Delete Modal HTML -->
  <div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        {{ $deleteModal }}
      </div>
    </div>
  </div>

  {{ $forms }}

  <x-slot:footer>
    <x-frontend.footer/>
  </x-slot:footer>

  @prepend('scripts')
  {{-- SCRIPTS --}}
  {{-- This is where you add javascript 'script' elements that should be loaded by all ADMIN pages --}}
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function () {
        $(".xp-menubar").on('click', function () {
            $('#sidebar').toggleClass('active');
            $('#content').toggleClass('active');
        });

        $(".xp-menubar,.body-overlay").on('click', function () {
            $('#sidebar,.body-overlay').toggleClass('show-nav');
        });

    });

    function selectAllCheckboxes() {
      var mainCheckbox = document.getElementById('selectAll');
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = mainCheckbox.checked;
      }
    }
  </script>

  <script>
    function selectEntry(id)
    {
      document.getElementById(`checkbox${id}`).checked = true;
    }
  </script>

  @if($errors->hasBag('add'))
  <script type="text/javascript">
    document.getElementById('addModalBtn').click();
  </script>
  @endif

  @if($errors->hasBag('edit'))
  <script type="text/javascript">
    document.getElementById('editModalBtn').click();
  </script>
  @endif
  @endprepend
</x-site-base>