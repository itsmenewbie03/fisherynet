@extends("dashboard")
@section("brand")
Configurations
@endsection
@section("content")

<div class="modal fade" tabindex="-1" role="dialog" id="addSubjectModal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                @include('components.forms.configurations.add')
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#addSubjectModal">Add</button>
<table id="myTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Key</th>
            <th>Value</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($configs as $config)
        <tr>
            <td>{{$subject->id}}</td>
            <td>{{$subject->key}}</td>
            <td>{{$subject->value}}</td>
            <td>
                <div class="d-flex">
                    <form method="POST" action={{route("subject.destroy",$subject->id)}}>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete Subject">
                            <i class="fas fa-user-times"></i>
                        </button>
                    </form>
                    <a href="{{route('subject.edit',$subject->id)}}" class="ml-1 btn btn-primary" data-toggle="tooltip" title="Edit Subject">
                        <i class="fas fa-user-edit"></i>
                    </a>


                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@push("scripts")
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endpush
