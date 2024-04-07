<?php
$sorting_enabled = App\Models\Configuration::all()->where('key', 'sorting_enabled')->first()->value ?? -1;
$is_enabled = $sorting_enabled == 1;

$data = App\Models\Configuration::all()->where('key', 'sleep_time')->first()->value ?? -1;
$parts = explode(' - ', $data);
$startDate = date('m/d h:m A', (int) $parts[0]);
$endDate = date('m/d h:m A', (int) $parts[1]);
?>
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
                                    <option value="1" {{ $is_enabled ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ !$is_enabled ? 'selected' : '' }}>No</option>
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
                            <button class="btn btn-primary btn-block mt-1" name="action_id"
                                value="schedule_power_off">Save</button>
                            <!-- Button for date range -->
                        </td>
                    </tr>
                    <tr>
                        <td>Minimum Fish Size</td>
                        <td>
                            <div class="form-floating">
                                <input type="number" class="form-control" id="size" name="min_fish_size"
                                    min="1"
                                    value="{{ App\Models\Configuration::all()->where('key', 'min_fish_size')->first()->value ?? 'Key not found' }}" />
                            </div>
                            <button class="btn btn-primary btn-block mt-1" name="action_id"
                                value="update_min_fish_size">Save</button>
                            <!-- Button for area size -->
                        </td>
                    </tr>
                    <tr>
                        <td>Calibration Factor</td>
                        <td>
                            <div class="form-floating">
                                <input type="text" inputmode="decimal" class="form-control" id="cf"
                                    name="calibration_factor" min="1" pattern="[0-9]*[.,]?[0-9]*"
                                    value="{{ App\Models\Configuration::all()->where('key', 'calibration_factor')->first()->value ?? 'Key not found' }}" />
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
                startDate: '<?php echo $startDate; ?>',
                endDate: '<?php echo $endDate; ?>',
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });
        });
    </script>
@endpush
