<x-frontend-base title="Basement Box | Publish Game" :includeNavbar="true" :includeFooter="true">
  @push('styles') @endpush
  
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="text-center">Publish game</h1>
        <form action="{{ url('games/publish') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="publisher_id" value="{{ Auth::id() }}">
          <div class="row row-cols-2">
            <x-frontend.field name="name" displayName="Game Name" errorBag="add"/>
            <x-frontend.field name="price" displayName="Price" type="number" errorBag="add"/>
          </div>
          <x-frontend.textarea name="excerpt" 
                               displayName="Excerpt" 
                               hasHelp="true" 
                               helpText="Enter an excerpt for your game. Keep it up to 3 sentences at most!" 
                               expectedHeight="2"
                               errorBag="add"/>
          <x-frontend.textarea name="description" 
                               displayName="Description" 
                               hasHelp="true" 
                               helpText="Enter a description for your game. Make sure to emphasize the games features!"
                               errorBag="add"/>
          <x-frontend.textarea name="tags" 
                               displayName="Tags"
                               hasHelp="true" 
                               helpText="Enter tags to help your games reach players. Separate the tags with commas ( , )"
                               errorBag="add"/>
    
          <hr>
    
          <h3>Upload game logo</h3>
          <p>Upload your game logo here to help users identify it</p>
          <x-frontend.field name="logo" 
                            displayName="Upload game logo" 
                            type="file"
                            hasHelp="true"
                            helpText="We recommend that the logo has a square aspect ratio."
                            errorBag="add"/>
    
          <hr>
    
          <h3>Upload game pictures</h3>
          <p>Upload pictures of your game to entice users to buy it!</p>
          @for($i = 1; $i <= 4; $i++)
          <x-frontend.field name="gamePic{{$i}}" 
                            displayName="Upload game picture {{$i}}" 
                            type="file"
                            errorBag="add"/>
          @endfor
    
          <button type="submit" class="btn btn-dark d-block mx-auto">Publish game!</button>
        </form>
      </div>
    </div>
  </div>
  
  @push('scripts')

  @endpush
</x-frontend-base>