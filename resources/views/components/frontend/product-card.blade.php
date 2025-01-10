@props(['game'])
<div class="card m-2 p-0" {{ $attributes }}>
  <img class="card-img-top" src="{{ ($game['logo'] ?? false) ? asset($game['logo']) : asset('photos/nologo.png') }}" alt="Logo for {{$game->name}}" />
  <div class="card-body">
    <p class="m-0 hint-star star text-warning">
      @for($j = floor($game->rating); $j > 0; $j--)<i class="fa fa-star"></i>@endfor
      <span class="text-dark">({{$game->reviews()->count()}})</span>
    </p>
    <p class="h6">{{ $game->name }}</p>
    <a href="{{ url('/games/'.$game->id) }}"><small class="text-muted">View Product Details</small></a>
  </div>
  <div class="card-footer p-0 text-center" style="background-color: #212529;">
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-dark">
        <i class="fas fa-shopping-cart"></i>
        <span>P{{ $game->price }}</span>
      </button>
    </div>
  </div>
</div>