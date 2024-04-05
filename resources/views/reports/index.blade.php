@extends("dashboard")

@section("content")
<form method="POST" action="{{ route('generator') }}">
    @csrf
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <input id="reportrangefilter" type="hidden" name="reportrangefilter" value=""/>
                <small class="text-muted" id="dateLabel">Default Dates</small>
                <div id="reportrange" class="form-control" style="cursor: pointer;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <small class="text-muted" id="dateLabel">Default Dates</small>
                <div class="input-group">
                    <input type="text" id="daterange" class="form-control" name="daterange" value="01/01/2018 - 01/15/2018" />
                    <button class="btn btn-outline-secondary" type="button" id="daterangeBtn">
                        <i class="fas fa-calendar-alt"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-success btn-block">Submit</button>
            </div>
        </div>
    </div>
</form>
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

    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrangefilter').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>
@endpush
