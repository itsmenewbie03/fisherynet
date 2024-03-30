@if (isset($deeznuts))
  <p>The value of "deeznuts" is: {{ $deeznuts }}</p>
@else
  <p>The "deeznuts" variable is not available.</p>
@endif
<form method="POST" action="{{ route('calibrate') }}">
    @csrf
    <button type="submit">Set Deez Nuts</button>
</form>
