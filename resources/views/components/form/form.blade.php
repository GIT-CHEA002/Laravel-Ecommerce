@php
  $method = strtoupper($attributes->get('method', 'GET'));
  // check the methods send by attribute 
  $realMethod = in_array($method, ['GET', 'POST']) ? $method : 'POST';
@endphp

<form {{ $attributes->merge([
  'method' => $realMethod
]) }}>
  @if ($method != 'GET')
    @csrf
    @if ($method != 'POST')
      @method($method)
    @endif
  @endif
  {{ $slot }}
</form>