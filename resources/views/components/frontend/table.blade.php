@props(['fields', 'entries', 'links'])
<div class="table-wrapper">
  <div class="col-md-5 col-lg-3 order-3 order-md-2 mb-3">
    <div class="xp-searchbar">
      <form action="{{ url()->current().'?'.http_build_query(request()->except('page')) }}">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search" @if(request()->has('search')) value="{{ request('search') }}" @endif>
          <button class="btn" type="submit" id="button-addon2">GO</button>
        </div>
      </form>
    </div>
  </div>

  <div class="row-1 mb-3">
    <div class="col-md-4">
      <div class="input-group">
        <div class="input-group-text">Sort By:</div>
        <select class="form-control" onchange="window.location.href = this.value" onfocus="this.selectedIndex = -1;">
          {!! build_sort_option('ID (Lowest - Highest)', 'id', 'asc', true) !!}
          {!! build_sort_option('ID (Highest - Lowest)', 'id', 'desc') !!}
          @if($additionalOptions ?? false) {!! $additionalOptions !!} @endif
          {!! build_sort_option('Oldest first', 'created_at', 'asc') !!}
          {!! build_sort_option('Newest first', 'created_at', 'desc') !!}
          {!! build_sort_option('Updates (Old - New)', 'updated_at', 'asc') !!}
          {!! build_sort_option('Updates (New - Old)', 'updated_at', 'desc') !!}
        </select>
      </div>
    </div>
  </div>

  <div class="table-title">
    <div class="row">
      <div class="col p-0 d-flex justify-content-sm-end justify-content-center">
        <a href="#deleteModal" id="deleteModalBtn" class="btn btn-danger" data-toggle="modal">
          <i class="material-icons">&#xE15C;</i><span> Delete selected</span></a>
        <a href="#addModal" id="addModalBtn" class="btn btn-success" data-toggle="modal">
          <i class="material-icons">&#xE147;</i> <span>Add New</span></a>
      </div>
    </div>
  </div>

  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>
          <span class="custom-checkbox">
            <input type="checkbox" id="selectAll" onclick="selectAllCheckboxes()">
            <label for="selectAll"></label>
          </span>
        </th>
        @foreach($fields as $field)
          <th>{{ $field }}</th>
        @endforeach
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($entries as $entry)
      <tr>
        <td>
          <span class="custom-checkbox">
            <input type="checkbox" id="checkbox{{$entry['id']}}" name="entries[]" form="deleteForm" value="{{$entry['id']}}">
            <label for="checkbox{{$entry['id']}}"></label>
          </span>
        </td>
        @foreach($entry as $key => $value)
          <td>
            @switch($key)
              @case('created_at')
              @case('updated_at')
                {{ date_create($value)->format('Y-m-d H:i:s') }}
                @break
              @default
                {{ $value }}
            @endswitch
          </td>
        @endforeach
        <td>
          <a href="#editModal" id="editModalBtn" class="edit" data-toggle="modal">
            <i class="material-icons" data-toggle="tooltip" title="Edit" onclick="edit({{$entry['id']}})">&#xE254;</i></a>
          <a href="#deleteModal" id="deleteModalBtn" class="delete" data-toggle="modal" onclick="selectEntry({{$entry['id']}})">
            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {!! $links !!}
</div>