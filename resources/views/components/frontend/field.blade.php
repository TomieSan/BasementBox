@props([
  'displayName' => 'displayName',
  'name' => 'name',
  'type' => 'text',
  'form' => '',
  'placeholder' => '',
  'hasHelp' => false,
  'helpText' => 'Help text',
  'value' => '',
  'required' => false,
  'errorBag' => 'default'
])
<div class="form-group mb-3">
  <label for="{{ $name }}Field" class="form-label">{{ $displayName }}</label>
  <input type="{{ $type }}"
          {{ trim($form) ? "form=$form" : '' }}
          class="form-control @error($name, $errorBag) is-invalid @enderror" 
          name="{{ $name }}" 
          id="{{ $name }}Field" 
          value="{{ trim($value) ? trim($value) : old($name) }}"
          aria-describedby="{{ $name }}Help" 
          placeholder="{{ trim($placeholder) ? trim($placeholder) : $displayName }}"
          @if(strtoupper(trim($required)) === 'TRUE') {{ "required" }} @endif>
  @if(strtoupper(trim($hasHelp)) === 'TRUE')
  <small id="{{ $name }}Help" class="form-text text-muted">{{ $helpText }}</small>
  @endif
  @error($name, $errorBag)
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror
</div>