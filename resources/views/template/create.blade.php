@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="card-title">Template Create</h4>
                    </div>
                    <div class="col-md-9 text-right">

                        <a href="{{route('templateList')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Template List
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
                    <form method="post" action="{{ route('saveTemplate') }}" enctype="multipart/form-data">
                        {{ @csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-6">
                                <label>Template Name</label>
                                <input type="text" name="template_name" class="form-control">
                                @if ($errors->has('template_name'))
                                <span class="help-block">
                                    <span>{{ $errors->first('template_name') }}</span>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>User Type</label>
                                <select class="form-control" name="type_id">
                                    <option value=''>-- Select Type --</option>
                                    @if ($userTypes->count())
                                    @foreach($userTypes as $value)
                                    <option value="{{ $value->id }}"><?php echo $value->type_name . (isset($value->event_id) && !empty($value->event_id) ? "(" . getEventName($value->event_id) . ")" : ""); ?></option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('type_id'))
                                <span class="help-block">
                                    <span>{{ $errors->first('type_id') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label>Page Width (MM)</label>
                                <input type="text" name="page_width" class="form-control">
                                @if ($errors->has('page_width'))
                                <span class="help-block">
                                    <span>{{ $errors->first('page_width') }}</span>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label>Page Height (MM)</label>
                                <input type="text" name="page_height" class="form-control">
                                @if ($errors->has('page_height'))
                                <span class="help-block">
                                    <span>{{ $errors->first('page_height') }}</span>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Image</label>
                                <input type="file" name="header_image" class="form-control">
                                @if ($errors->has('header_image'))
                                <span class="help-block">
                                    <span>{{ $errors->first('header_image') }}</span>
                                </span>
                                @endif
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" value="Create">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection