@props(['fields', 'entries', 'links'])
<x-admin-base title="BasementBox | Admin | Games">
  @push('styles')

  @endpush

  <x-slot:dashboardHeading>
    <div class="xp-breadcrumbbar text-center">
      <h4 class="page-title">Dashboard</h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">GAMES</li>
      </ol>
    </div>
  </x-slot:dashboardHeading>

  <x-frontend.table :$fields :$entries :$links>
    <x-slot:additionalOptions>
      {!! build_sort_option('Name (A - Z)', 'name', 'asc') !!}
      {!! build_sort_option('Name (Z - A)', 'name', 'desc') !!}
      {!! build_sort_option('Price (Low - High)', 'price', 'asc') !!}
      {!! build_sort_option('Price (High - Low)', 'price', 'desc') !!}
      {!! build_sort_option('Rating (Lowest)', 'rating', 'asc') !!}
      {!! build_sort_option('Rating (Highest)', 'rating', 'desc') !!}
    </x-slot:additionalOptions>
  </x-frontend.table>

  <x-slot:addModal>
    <form action="{{ url('/admin/games/publish')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h4 class="modal-title">Add Game</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>

      <div class="modal-body">
        <x-frontend.field name="name" 
                          displayName="Game Name" 
                          placeholder="Enter game name" 
                          required="true"
                          errorBag="add"/>
        <div class="row row-cols-2">
          <x-frontend.field name="publisher_id" 
                            displayName="Publisher ID" 
                            placeholder="Enter publisher ID" 
                            errorBag="add" 
                            required="true"
                            type="number"/>
          <x-frontend.field name="price" 
                            displayName="Price" 
                            placeholder="Enter game price" 
                            errorBag="add" 
                            required="true"
                            type="number"/>
        </div>
        <x-frontend.textarea name="excerpt" 
                             displayName="Excerpt" 
                             placeholder="Enter game excerpt" 
                             errorBag="add"/>
        <x-frontend.textarea name="description" 
                             displayName="Description" 
                             placeholder="Enter game description" 
                             errorBag="add"/>
        <x-frontend.textarea name="tags" 
                             displayName="Tags" 
                             placeholder="Enter game tags" 
                             required="true"
                             errorBag="add"/>
        <x-frontend.field name="logo" 
                          displayName="Game logo" 
                          type="file"
                          errorBag="add"/>
        @for($i = 1; $i <= 4; $i++)
        <x-frontend.field name="gamePic{{$i}}" 
                          displayName="Game Picture {{$i}}" 
                          type="file"
                          errorBag="add"/>
        @endfor
      </div>
      
      <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        <input type="submit" class="btn btn-success" value="Add">
      </div>
    </form>
  </x-slot:addModal>

  <x-slot:editModal>
    <form action="{{ url('/api/admin/games/edit')}}" method="post" id="gameEdit" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h4 class="modal-title">Edit Game</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="idField">
        <x-frontend.field name="name" 
                          displayName="Game Name" 
                          placeholder="Enter game name" 
                          required="true"
                          errorBag="add"/>
        <div class="row row-cols-2">
          <x-frontend.field name="publisher_id" 
                            displayName="Publisher ID" 
                            placeholder="Enter publisher ID" 
                            errorBag="add" 
                            required="true"
                            type="number"/>
          <x-frontend.field name="price" 
                            displayName="Price" 
                            placeholder="Enter game price" 
                            errorBag="add" 
                            required="true"
                            type="number"/>
        </div>
        <x-frontend.textarea name="excerpt" 
                             displayName="Excerpt" 
                             placeholder="Enter game excerpt" 
                             errorBag="add"/>
        <x-frontend.textarea name="description" 
                             displayName="Description" 
                             placeholder="Enter game description" 
                             errorBag="add"/>
        <x-frontend.textarea name="tags" 
                             displayName="Tags" 
                             placeholder="Enter game tags" 
                             required="true"
                             errorBag="add"/>
        <x-frontend.field name="logo" 
                          displayName="Game logo" 
                          type="file"
                          errorBag="add"/>
        @for($i = 1; $i <= 4; $i++)
        <x-frontend.field name="gamePic{{$i}}" 
                          displayName="Game Picture {{$i}}" 
                          type="file"
                          errorBag="add"/>
        @endfor
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        <input type="submit" class="btn btn-info" value="Save">
      </div>
    </form>
  </x-slot:editModal>

  <x-slot:deleteModal>
    <form>
      <div class="modal-header">
        <h4 class="modal-title">Delete Game</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete these Records?</p>
        <p class="text-warning"><small>This action cannot be undone.</small></p>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        <input type="submit" form="deleteForm" class="btn btn-danger" value="Delete">
      </div>
    </form>
  </x-slot:deleteModal>

  <x-slot:forms>
    <form id="deleteForm" action="{{ url('/admin/games/delete') }}" method="post">@csrf</form>
  </x-slot:forms>

  @push('scripts')
  <script>
    async function edit(id) {
      fetch(`{{ url("/api/admin/games") }}/${id}`, {method:"get"})
      .then((response) => response.json())
      .then((result) => {
        delete result.created_at
        delete result.updated_at
        delete result.logo
        delete result.gamePic1
        delete result.gamePic2
        delete result.gamePic3
        delete result.gamePic4

        for(const field in result)
        {
          try { 
            const elem = document.forms.gameEdit.querySelector(`#${field}Field`)
            elem.value = result[field]
          } catch(ex) {}
        }
      })
    }
  </script>
  @endpush
</x-admin-base>