@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="card-title">Attendee List</h4>
                    </div>
                    <div class="col-md-9 text-right">

                        <a href="{{route('importCSV')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Import CSV
                            </button>
                        </a>
                        <a href="{{route('sampleCSV')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Sample CSV
                            </button>
                        </a>
                        <a href="{{route('attendeeList')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Attendee List
                            </button>
                        </a>
                        <a href="javascript:void(0)" onclick="delete_all_attendee();">
                            <button type="button" class="btn btn-rounded btn-danger">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Delete All
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
                    <form method="post" action="{{ route('updateAttendee', [$row->id]) }}" enctype="multipart/form-data">
                        {{ @csrf_field() }}

                        <div class='row'>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="hidden" name="event_id" value="{{$row->event_id}}">
                                    <select class="form-control" disabled>
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
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Serial Number</label>
                                    <input type="text" name="serial_number" value="{{ $row->serial_number }}" readonly="true" class="form-control">
                                    @if ($errors->has('serial_number'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('serial_number') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>Salutation</label>
                                    <select class="form-control" name="salutation">
                                        <option value=''>-- Select Salutation --</option>
                                        @if ($salutations->count())
                                        @foreach($salutations as $salutation)
                                        <option value="{{ $salutation->name }}" <?php
                                                                                if (isset($row->salutation) && $row->salutation == $salutation->name) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>{{ $salutation->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('salutation'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('salutation') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" value={{ $row->first_name }} class="form-control">
                                    @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('first_name') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" value="{{ $row->last_name }}" class="form-control">
                                    @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('last_name') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" name="type_id">
                                        <option value=''>-- Select Type --</option>
                                        @if ($userTypes->count())
                                        @foreach($userTypes as $key=>$value)
                                        <option value="{{ $key }}" {{ $row->type_id == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
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
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value={{ $row->email }} class="form-control">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('email') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" name="country">
                                        <option value=''>-- Select Country --</option>
                                        @if ($events->count())
                                        @foreach($countries as $country)
                                        <option value="{{ $country->country_name }}" <?php
                                                                                        if (isset($row->country) && strtolower($row->country) == strtolower($country->country_name)) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                        ?>>{{ $country->country_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('country'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('country') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>Company</label>
                                    <input type="text" name="company" value="{{ $row->company }}" class="form-control">
                                    @if ($errors->has('company'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('company') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" value="{{ old('designation', $row->designation) }}" class="form-control">
                                    @if ($errors->has('designation'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('designation') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" name="mobile" value="{{ old('mobile', $row->mobile) }}" class="form-control">
                                    @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('mobile') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Office Number</label>
                                    <input type="text" name="office_number" value="{{ old('office_number', $row->office_number) }}" class="form-control">
                                    @if ($errors->has('office_number'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('office_number') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $row->postal_code) }}" class="form-control">
                                    @if ($errors->has('postal_code'))
                                    <span class="help-block">
                                        <span>{{ $errors->first('postal_code') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>National ID / Passport Number<span class="field_required"></span></label>
                                    <input type="text" name="fax" value="{{ old('fax', $row->fax) }}" class="form-control">
                                    @if ($errors->has('fax'))
                                    <span class="help-block error">
                                        <span>{{ $errors->first('fax') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Zone</label>
                                    <select class="form-control" name="zone">
                                        <option value=''>Select Zone</option>
                                        <?php
                                        $param      =   [];
                                        $param['table']      =   'event_seat_arrangements';
                                        $param['where']      =   [
                                            'type'           => 1
                                        ];
                                        $zones      =   get_table_data_by_clause($param);
                                        foreach ($zones as $rowss) {
                                        ?>
                                            <option value="<?php echo $rowss->name ?>" <?php if (isset($row->zone) && $row->zone == $rowss->name) {
                                                                                            echo 'selected';
                                                                                        } ?>><?php echo $rowss->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Table</label>
                                    <select class="form-control" name="table_name">
                                        <option value=''>Select Table</option>
                                        <?php
                                        $param      =   [];
                                        $param['table']      =   'event_seat_arrangements';
                                        $param['where']      =   [
                                            'type'           => 2
                                        ];
                                        $tables      =   get_table_data_by_clause($param);
                                        foreach ($tables as $rowss) {
                                        ?>
                                            <option value="<?php echo $rowss->name ?>" <?php if (isset($row->table_name) && $row->table_name == $rowss->name) {
                                                                                            echo 'selected';
                                                                                        } ?>><?php echo $rowss->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Seat</label>
                                    <select class="form-control" name="seat">
                                        <option value=''>Select Seat</option>
                                        <?php
                                        $param      =   [];
                                        $param['table']      =   'event_seat_arrangements';
                                        $param['where']      =   [
                                            'type'           => 3
                                        ];
                                        $seats      =   get_table_data_by_clause($param);
                                        foreach ($seats as $rowss) {
                                        ?>
                                            <option value="<?php echo $rowss->name ?>" <?php if (isset($row->seat) && $row->seat == $rowss->name) {
                                                                                            echo 'selected';
                                                                                        } ?>><?php echo $rowss->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Photo</label>
                                    <input type="file" name="attendee_photo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php

                                if (isset($row->attendee_photo) && !empty($row->attendee_photo)) {
                                    echo '<img src="' . asset('public/uploads/' . $row->attendee_photo) . '" style="width:100px;">';
                                }

                                ?>
                                <input type="hidden" name="attendee_photo" value="<?php echo $row->attendee_photo; ?>">
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