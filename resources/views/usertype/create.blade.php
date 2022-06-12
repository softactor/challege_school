@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="card-title">User Type Add</h4>
                    </div>
                    <div class="col-md-9 text-right">
                        <a href="{{route('importUserTypesCSV')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Import User Type
                            </button>
                        </a>
                        <a href="{{route('userTypes')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>User Type List
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

                <div class="basic-form">
                    <form method="post" action="{{ route('saveAttendee') }}" enctype="multipart/form-data" id="attendee_add_form">
                        {{ @csrf_field() }}
                        @method('POST')
                        <div class="col-lg-12">

                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Event</label>
                                        <select class="form-control" name="event_id">
                                            <option value=''>-- Select Event --</option>
                                            @if ($events->count())
                                            @foreach($events as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('event_id'))
                                        <span class="help-block">
                                            <span>{{ $errors->first('event_id') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Type Name</label>
                                        <input type="text" name="typename" class="form-control">
                                        @if ($errors->has('typename'))
                                        <span class="help-block">
                                            <span>{{ $errors->first('typename') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="usr">Text Color:</label>
                                        <input type="color" class="form-control" id="text_clor" name="text_clor">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="usr">BG Color:</label>
                                        <input type="color" class="form-control" id="background_color" name="background_color">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Create">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection