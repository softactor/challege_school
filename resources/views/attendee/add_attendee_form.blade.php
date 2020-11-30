@extends('layouts.app')
@section('css')
@endsection

@section('content')
<form method="post" action="{{ route('saveAttendee') }}">
    {{  @csrf_field() }}
    @method('POST')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Add Attendee</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Event</label>
                            <select class="form-control" name="event_id">
                                <option value=''>-- Select Event --</option>
                                <?php
                                foreach ($events as $event) {
                                    ?>
                                    <option value="<?php echo $event->id ?>"><?php echo $event->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>User Type</label>
                            <select class="form-control" name="type_id">
                                <option value=''>-- Select Type --</option>
                                <?php
                                foreach ($usertypes as $usertype) {
                                    ?>
                                    <option value="<?php echo $usertype->id ?>"><?php echo $usertype->type_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" name="country">
                                <option value=''>-- Select Country --</option>
                                <?php
                                foreach ($countries as $country) {
                                    ?>
                                    <option value="<?php echo $country->country_name ?>"><?php echo $country->country_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Salutation</label>
                            <select class="form-control" name="salutation">
                                <option value=''>-- Select Salutation --</option>
                                <?php
                                foreach ($salutations as $salutation) {
                                    ?>
                                    <option value="<?php echo $salutation->name ?>"><?php echo $salutation->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" name="company" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" name="designation" value="{{ old('designation') }}" class="form-control">
                            @if ($errors->has('designation')) 
                            <span class="help-block">
                                <span>{{ $errors->first('designation') }}</span>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control">
                            @if ($errors->has('mobile')) 
                            <span class="help-block">
                                <span>{{ $errors->first('mobile') }}</span>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Office Number</label>
                            <input type="text" name="office_number" value="{{ old('office_number') }}" class="form-control">
                            @if ($errors->has('office_number')) 
                            <span class="help-block">
                                <span>{{ $errors->first('office_number') }}</span>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control">
                            @if ($errors->has('postal_code')) 
                            <span class="help-block">
                                <span>{{ $errors->first('postal_code') }}</span>
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
                                foreach ($zones as $row) {
                                    ?>
                                    <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
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
                                foreach ($tables as $row) {
                                    ?>
                                    <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
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
                                foreach ($seats as $row) {
                                    ?>
                                    <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="serial_number" value="<?php echo $serial_number ?>">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection