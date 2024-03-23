@props(['messages'])

@if ($messages)
<ul class="alert alert-danger list-unstyled m-0 " role="alert">
    @foreach ((array) $messages as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif
