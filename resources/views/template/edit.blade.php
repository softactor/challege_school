@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="card-title">Template Update</h4>
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
                    <form method="post" action="{{ route('updateTemplate',[$row->id]) }}" enctype="multipart/form-data">
                        {{ @csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <select class="form-control" name="event_id">
                                        <option value=''>-- Select Event --</option>
                                        @if ($events->count())
                                        @foreach($events as $key=>$value)
                                        <option value="{{ $key }}" {{ $row->event_id == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Template Name</label>
                                    <input type="text" name="template_name" value="{{$row->template_name}}" class="form-control">
                                    @if ($errors->has('template_name'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('template_name') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" name="type_id">
                                        <option value=''>-- Select Type --</option>
                                        @if ($userTypes->count())
                                        @foreach($userTypes as $value)
                                        <option value="{{ $value->id }}" {{ $row->type_id == $value->id ? 'selected="selected"' : '' }}><?php echo $value->type_name . (isset($value->event_id) && !empty($value->event_id) ? "(" . getEventName($value->event_id) . ")" : ""); ?></option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('type_id'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('type_id') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Page Height (MM)</label>
                                    <input type="text" name="page_height" value="{{$row->page_height}}" class="form-control">
                                    @if ($errors->has('page_height'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('page_height') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Page Width (MM)</label>
                                    <input type="text" name="page_width" value="{{$row->page_width}}" class="form-control">
                                    @if ($errors->has('page_width'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('page_width') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="header_image" class="form-control">
                                    @if ($errors->has('header_image'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('header_image') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php if (isset($row->header_image) && !empty($row->header_image)) { ?>
                                    <img src="<?php echo asset('public/header_image/' . $row->header_image) ?>" class="img-fluid" />
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection