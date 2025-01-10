@props(['fields', 'entries', 'links'])
<x-admin-base title="BasementBox | Admin | Users">
  @push('styles')

  @endpush

  <x-slot:dashboardHeading>
    <div class="xp-breadcrumbbar text-center">
      <h4 class="page-title">Dashboard</h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">USERS</li>
      </ol>
    </div>
  </x-slot:dashboardHeading>

  <x-frontend.table :$fields :$entries :$links>
    <x-slot:additionalOptions>
      {!! build_sort_option('Username (A - Z)', 'username', 'asc') !!}
      {!! build_sort_option('Username (Z - A)', 'username', 'desc') !!}
      {!! build_sort_option('Email (A - Z)', 'email', 'asc') !!}
      {!! build_sort_option('Email (Z - A)', 'email', 'desc') !!}
    </x-slot:additionalOptions>
  </x-frontend.table>

  <x-slot:addModal>
    <form action="{{ url('/register') }}" method="post" id="userAdd">
      @csrf
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <x-frontend.field displayName="Username"
                          name="username"
                          required="true"
                          errorBag="add"/>

        <x-frontend.field displayName="Email"
                          name="email"
                          type="email"
                          required="true"
                          errorBag="add"/>

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
                          required="true"
                          errorBag="add"/>
        
        <div class="mb-3">
          <label for="level" class="form-label">User Level</label>
          <select class="form-select form-select-lg" name="level" id="level">
            <option value="0" selected>Buyer</option>
            <option value="1">Seller</option>
            <option value="2">Admin</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        <input type="submit" class="btn btn-success" value="Add">
      </div>
    </form>
  </x-slot:addModal>

  <x-slot:editModal>
    <form action="{{ url('/api/admin/users/edit') }}" method="post" id="userEdit">
      @csrf
      <div class="modal-header">
        <h4 class="modal-title">Edit User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="idField">
        <x-frontend.field displayName="Username"
                          name="username"
                          required="true"
                          errorBag="edit"/>

        <x-frontend.field displayName="Email"
                          name="email"
                          type="email"
                          required="true"
                          errorBag="edit"/>

        <x-frontend.field displayName="Password"
                          name="password"
                          type="password"
                          hasHelp="true"
                          required="true"
                          errorBag="edit"
                          helpText="Must be at least 12 alphanumeric characters with at least 1 uppercase character, at least 1 lowercase character, and at least 1 symbol."/>

        <x-frontend.field displayName="Confirm Password"
                          name="password_confirmation"
                          type="password"
                          required="true"
                          errorBag="edit"/>
        
        <div class="mb-3">
          <label for="level" class="form-label">User Level</label>
          <select class="form-select form-select-lg" name="level" id="levelField">
            <option value="0">Buyer</option>
            <option value="1">Seller</option>
            <option value="2">Admin</option>
          </select>
        </div>
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
        <h4 class="modal-title">Delete User</h4>
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
    <form id="deleteForm" action="{{ url('/admin/users/delete') }}" method="post">@csrf</form>
  </x-slot:forms>

  @push('scripts')
  <script>
    async function edit(id) {
      fetch(`{{ url("/api/admin/users") }}/${id}`, {method:"get"})
      .then((response) => response.json())
      .then((result) => {
        delete result.created_at
        delete result.updated_at
        for(const field in result)
        {
          try { 
            const elem = document.forms.userEdit.querySelector(`#${field}Field`)
            if(elem.tagName === 'SELECT')
              elem.selectedIndex = result[field]
            else
              elem.value = result[field]
          } catch(ex) {}
        }
      })
    }
  </script>
  @endpush
</x-admin-base>