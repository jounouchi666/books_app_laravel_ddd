@props([
    'params' => [],
    'except' => []
])

@foreach ($params as $key => $value)
    @if ( !in_array($key, $except) && !is_null($value) )
    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endif
@endforeach