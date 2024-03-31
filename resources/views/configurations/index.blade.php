@extends("dashboard")
@section("content")
<div class="container-fluid mt-4">

  <div class="mb-4">
    <h2 class="text-center">Configure Settings</h2>
  </div>

  <div class="mb-4">
    <div class="custom-control custom-switch">
      <label class="custom-control-label" for="enableautoupdate">Enable Automatic Updates</label>
      <input type="checkbox" class="custom-control-input" id="enableautoupdate">
    </div>
  </div>

  <div class="mb-4">
    <div class="form-floating">
      <label for="daterange">Date Range</label>
      <input type="text" class="form-control" id="daterange" name="daterange" value="01/01/2018 - 01/15/2018" />
    </div>
  </div>

  <div class="mb-4">
    <div class="form-floating">
      <label for="size">Area Size</label>
      <input type="number" class="form-control" id="size" placeholder=" " />
    </div>
  </div>

  <div class="mb-4">
    <div class="form-floating">
      <label for="cf">Calibration Factor</label>
      <input type="number" class="form-control" id="cf" placeholder=" " />
    </div>
  </div>

  <div class="mb-4">
    <button class="btn btn-success btn-block">Submit</button>
  </div>

</div>
@endsection

@push("scripts")
<script>
    $(function() {
        $('#daterange').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("a new date selection was made: " + start.format('yyyy-mm-dd') + ' to ' + end.format('yyyy-mm-dd'));
        });
    });
</script>
@endpush
