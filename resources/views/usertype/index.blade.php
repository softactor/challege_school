@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="float-left">User Type List</h5>
            <div class="float-right">
                <a href="{{route('importUserTypesCSV')}}"  class="btn btn-sm btn-success">Import User Type</a>
                <a href="{{route('addUserType')}}"  class="btn btn-sm btn-success text-right">Add User Type</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered list-table-custom-style" id="typeTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type Name</th>
                        <th>Background Color</th>
                        <th>Text Color</th>
                        <th>Action</th>
                    </tr>					
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($types as $type)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$type->type_name}} (ID- {{$type->id}})</td>
                        <td>
                            <div style="width: 25px; height: 25px; background-color: <?php echo $type->background_color; ?>"></div>
                        </td>
                        <td>
                            <div style="width: 25px; height: 25px; background-color: <?php echo $type->text_clor; ?>"></div>
                        </td>
                        <td>
                            <a title="Edit" href="{{route('editUserType',[$type['id']])}}"  class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a title="Delete" href="{{route('deleteUserType',[$type['id']])}}" onclick="return confirm('Are you sure you want to delete this user type?');" class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script>
    $(document).ready(function () {
        $('#typeTable').DataTable();
    });
</script>
@endsection

