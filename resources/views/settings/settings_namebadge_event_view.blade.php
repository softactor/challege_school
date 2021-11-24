@extends('layouts.app')
@section('css')
@endsection

@section('content')
<form method="post" action="{{ route('saveEventSettings') }}">
    {{  @csrf_field() }}
    @method('POST')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Event Settings</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Event <span class="field_required"></span></label>
                            <select class="form-control" name="event_id" onchange="get_event_settings_data(this.value);">
                                <option value=''>-- Select Event --</option>
                                <?php
                                foreach ($events as $event) {
                                    ?>
                                    <option value="<?php echo $event->id ?>" @if (old('event_id') == $event->id) {{ 'selected' }} @endif><?php echo $event->name ?></option>
                                <?php } ?>
                            </select>
                            @if ($errors->has('event_id')) 
                            <span class="help-block error">
                                <span>{{ $errors->first('event_id') }}</span>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Settings <span class="field_required"></span></label>
                            <div class="checkbox">
                                <label><input type="checkbox" id="enable_vcard" name="enable_vcard" value="1">&nbsp;Enable Vcard</label>
                             </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="enable_qrcode" name="enable_qrcode" value="1">&nbsp;Enable Qrcode</label>
                             </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="enable_barcode" name="enable_barcode" value="1">&nbsp;Enable Barcode</label>
                             </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="enable_sync_dashboard" name="enable_sync_dashboard" value="1">&nbsp;Enable SYNC Dashboard</label>
                             </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Qrcode Type <span class="field_required"></span></label>
                            <select class="form-control" id="qrcode_type" name="qrcode_type">
                                <option value=''>-- Select --</option>
                                <?php
                                
                                $qrcode_types   =   [
                                    (object)[
                                        'id'    =>  1,
                                        'name'  =>  'Generate From Namebadge'
                                    ],
                                    (object)[
                                        'id'    =>  2,
                                        'name'  =>  'Generate From Registro Dashboard'
                                    ],
                                    (object)[
                                        'id'    =>  3,
                                        'name'  =>  'From Client URL'
                                    ],
                                ];
                                
                                foreach ($qrcode_types as $event) {
                                    ?>
                                    <option value="<?php echo $event->id ?>"><?php echo $event->name ?></option>
                                <?php } ?>
                            </select>
                            @if ($errors->has('qrcode_type')) 
                            <span class="help-block error">
                                <span>{{ $errors->first('qrcode_type') }}</span>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <input type="submit" name="event_settings_submit" class="btn btn-success" value="Save">
                </div>
                
            </div>
        </div>
    </div>
</form>
@endsection