@extends('dashboard')

@section('content')
    <form method="POST" action="{{ route('generator') }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <input id="reportrangefilter" type="hidden" name="reportrangefilter" value="" />
                <small class="text-muted input-group-prepend mb-1" id="dateLabel">Generate Report</small>
                <div id="reportrange" class="form-control" style="cursor: pointer;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success btn-block">Generate</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
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
                opens: 'left',
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
        });
    </script>
@endpush
