@extends("dashboard")
@section("content")
<div class="container-fluid mt-4">

  <div class="mb-4">
    <h2 class="text-center">Configure Settings</h2>
  </div>

  <table class="table">
    <tbody>
      <tr>
        <td>On/Off</td>
        <td>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="enableautoupdate">
            <label class="custom-control-label" for="enableautoupdate"></label>
          </div>
          <button class="btn btn-primary">Toggle</button> <!-- Button for the switch -->
        </td>
      </tr>
      <tr>
        <td>Date Range</td>
        <td>
          <div class="form-floating">
            <input type="text" class="form-control" name="datetimes" />
            <label for="datetimes">Time</label>
          </div>
          <button class="btn btn-primary">Select Date</button> <!-- Button for date range -->
        </td>
      </tr>
      <tr>
        <td>Area Size</td>
        <td>
          <div class="form-floating">
            <input type="number" class="form-control" id="size" />
            <label for="size">Area Size</label>
          </div>
          <button class="btn btn-primary">Update Size</button> <!-- Button for area size -->
        </td>
      </tr>
      <tr>
        <td>Calibration Factor</td>
        <td>
          <div class="form-floating">
            <input type="number" class="form-control" id="cf" />
            <label for="cf">Calibration Factor</label>
          </div>
          <button class="btn btn-primary">Calibrate</button> <!-- Button for calibration factor -->
        </td>
      </tr>
    </tbody>
  </table>

</div>
@endsection

@push("scripts")
<script>
  $(function() {
    $('input[name="datetimes"]').daterangepicker({
      timePicker: true,
      startDate: moment().startOf('hour'),
      endDate: moment().startOf('hour').add(32, 'hour'),
      locale: {
        format: 'M/DD hh:mm A'
      }
    });
  });
</script>
@endpush
