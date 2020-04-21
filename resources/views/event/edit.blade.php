@extends('layouts.app')
@section('css')
<style>
    .help-block span{
        color:#FF0000;
    }
</style>
@endsection

@section('content')
<form method="post" action="{{ route('updateEvent',[$row->id]) }}">
    {{  @csrf_field() }}
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Edit Event</div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $row->name) }}">
                    @if ($errors->has('name')) 
                    <span class="help-block">
                        <span>{{ $errors->first('name') }}</span>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Event Date</label>
                    <input type="text" autocomplete="off" id="evet_start_date" name="event_date" class="form-control" value="{{ old('event_date', date('Y/m/d H:i', strtotime($row->event_date))) }}">
                    @if ($errors->has('event_date')) 
                    <span class="help-block">
                        <span>{{ $errors->first('event_date') }}</span>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page-script')
<script>

</script>
@endsection

