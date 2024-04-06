@extends('dashboard')
@section('content')
  <div class="container-fluid mt-4">
    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <div class="mb-4">
      <h2 class="text-center">Configure Settings</h2>
    </div>

    <table class="table">
      <form method="POST" action="{{ route('configurations.store') }}">
        @csrf
        <tbody>
          <tr>
            <td>Enable Sorting</td>
            <td>
              <div class="form-floating">
                <select class="form-control" name="enabled" id="sort">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
              <button class="btn btn-primary btn-block mt-1" name="action_id" value="sorting_toggle"
                type="submit">Save</button> <!-- Button for the switch -->
            </td>
          </tr>
          <tr>
            <td>Date Range</td>
            <td>
              <div class="form-floating">
                <input type="text" class="form-control" name="daterange" />
              </div>
              <button class="btn btn-primary btn-block mt-1" name="action_id" value="schedule_power_off">Save</button>
              <!-- Button for date range -->
            </td>
          </tr>
          <tr>
            <td>Minimum Fish Size</td>
            <td>
              <div class="form-floating">
                <input type="number" class="form-control" id="size" name="min_fish_size" min="1" />
              </div>
              <button class="btn btn-primary btn-block mt-1" name="action_id" value="update_min_fish_size">Save</button>
              <!-- Button for area size -->
            </td>
          </tr>
          <tr>
            <td>Calibration Factor</td>
            <td>
              <div class="form-floating">
                <input type="text" inputmode="decimal" class="form-control" id="cf" name="calibration_factor" min="1" pattern="[0-9]*[.,]?[0-9]*"/>
              </div>
              <button class="btn btn-primary btn-block mt-1" name="action_id"
                value="update_calibration_factor">Save</button> <!-- Button for area size -->
            </td>
          </tr>
        </tbody>
      </form>
    </table>

  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      $('input[name="daterange"]').daterangepicker({
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
