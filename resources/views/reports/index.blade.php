@extends("dashboard")

@section("content")
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown Button
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="daterange" class="form-control" name="daterange" value="01/01/2018 - 01/15/2018" />
                <button class="btn btn-outline-secondary" type="button" id="daterangeBtn">
                    <i class="fas fa-calendar-alt"></i>
                </button>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <button class="btn btn-success btn-block">Submit</button>
        </div>
    </div>
</div>
@endsection

@push("scripts")
<script>
    $(function() {
        $('#daterange').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>   
@endpush
