@if (isset($est_size))
    <p>Calibration result: {{ $est_size }}</p>
@else
    <p>No calibration result yet.</p>
@endif

<form method="POST" action="{{ route('calibrate') }}">
    @csrf
    <button class="btn btn-success" type="submit">Start Calibration</button>
</form>

<form method="POST" action="{{ route('toggle') }}" class="mt-1">
    @csrf
    <button class="btn btn-success" type="submit" name="port" value="EXTRA_1">Toggle Extra 1</button>
    <button class="btn btn-success" type="submit" name="port" value="EXTRA_2">Toggle Extra 2</button>
</form>
