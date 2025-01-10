@props([
  'displayName' => 'displayName',
  'name' => 'name',
  'form' => '',
  'placeholder' => '',
  'hasHelp' => false,
  'helpText' => 'Help text',
  'value' => '',
  'expectedHeight' => '3',
  'required' => false,
  'errorBag' => 'default'
])
<div class="mb-3">
  <label for="{{ $name }}Field" class="form-label">{{ $displayName }}</label><br>
  @if(strtoupper(trim($hasHelp)) === 'TRUE')
  <small id="{{ $name }}Help" class="form-text text-muted">{{ $helpText }}</small>
  @endif
  <textarea class="form-control @error($name, $errorBag) is-invalid @enderror" 
            {{ trim($form) ? "form=$form" : '' }}
            name="{{ $name }}" 
            id="{{ $name }}Field" 
            value="{{ trim($value) ? trim($value) : old($name) }}"
            placeholder="{{ trim($placeholder) ? trim($placeholder) : $displayName }}"
            style="height: calc({{ $expectedHeight }}em + 2em);"
            aria-describedby="{{ $name }}Help"
            @if(strtoupper(trim($required)) === 'TRUE') {{ "required" }} @endif></textarea>
  @error($name, $errorBag)
  <div class="invalid-feedback">
    {{ $message }}
  </div>
  @enderror
</div>