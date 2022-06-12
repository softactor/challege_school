@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="card-title">User Type List</h4>
                    </div>
                    <div class="col-md-9 text-right">
                        <a href="{{route('importUserTypesCSV')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Import User Type
                            </button>
                        </a>
                        <a href="{{route('addUserType')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Add User Type
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="typeTable" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
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
                                <td>{{ (isset($type->event_id) && !empty($type->event_id) ? getEventName($type->event_id) : "") }}</td>
                                <td>{{$type->type_name}} (ID- {{$type->id}})</td>
                                <td>
                                    <div style="width: 25px; height: 25px; background-color: <?php echo $type->background_color; ?>"></div>
                                </td>
                                <td>
                                    <div style="width: 25px; height: 25px; background-color: <?php echo $type->text_clor; ?>"></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a title="Edit" href="{{route('editUserType',[$type['id']])}}" class="btn btn-primary shadow btn-xs sharp mr-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a title="Delete" href="{{route('deleteUserType',[$type['id']])}}" onclick="return confirm('Are you sure you want to delete this user type?');" class="btn btn-danger shadow btn-xs sharp mr-1">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @php $i++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script>
    $(document).ready(function() {
        $('#typeTable').DataTable({
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                }
            }
        });
    });
</script>
@endsection