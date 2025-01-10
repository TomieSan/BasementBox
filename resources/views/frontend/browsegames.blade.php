<x-frontend-base title="BasementBox | Browse" :includeNavbar="true" :includeFooter="true">
  @push('styles')

  @endpush

  <br><br>

  <div class="container-fluid">
    <div class="row mb-5">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-4">
                <div class="input-group">
                  <div class="input-group-text">Sort By:</div>
                  <select class="form-control" onchange="redirect(this)" onfocus="this.selectedIndex = -1;">
                    {!! build_sort_option('Name (A - Z)', 'name', 'asc', true) !!}
                    {!! build_sort_option('Name (Z - A)', 'name', 'desc') !!}
                    {!! build_sort_option('Price (Low - High)', 'price', 'asc') !!}
                    {!! build_sort_option('Price (High - Low)', 'price', 'desc') !!}
                    {!! build_sort_option('Rating (Lowest)', 'rating', 'asc') !!}
                    {!! build_sort_option('Rating (Highest)', 'rating', 'desc') !!}
                    {!! build_sort_option('Oldest first', 'created_at', 'asc') !!}
                    {!! build_sort_option('Newest first', 'created_at', 'desc') !!}
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <form action="{{ url('/browse').'?'.http_build_query(request()->except('page', 'search')) }}">
                  <div class="input-group">
                    <input type="search" class="form-control" name="search" id="search" @if(request()->has('search')) value="{{ request('search') }}" @endif>
                    <button class="btn btn-secondary" type="submit">Search</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row justify-content-center">
              @if(count($games) > 0)
              @foreach ($games as $game)
              <x-frontend.product-card style="width:280px" :game="$game"/>
              @endforeach
              @else
              <p class="mb-1">There are no games that fit that criteria.</p>
              @endif
            </div>
          </div>

        <div class="card-footer p-3">
          <div class="row">
            <div class="col-md-6">
              {!! $games->links() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  @push('scripts')
  <script>
    function redirect(selector)
    {
      window.location.href = selector.value
    }
  </script>
  @endpush
</x-frontend-base>