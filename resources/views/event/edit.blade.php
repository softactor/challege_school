@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header d-block">
				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Event Edit</h4>
					</div>
					<div class="col-md-6 text-right">
						<a href="{{route('importEventCSV')}}">
							<button type="button" class="btn btn-rounded btn-info">
								<span class="btn-icon-left text-info">
									<i class="fa fa-list color-info"></i>
								</span>Import Events
							</button>
						</a>
						<a href="{{route('eventList')}}">
							<button type="button" class="btn btn-rounded btn-info">
								<span class="btn-icon-left text-info">
									<i class="fa fa-list color-info"></i>
								</span>Event List
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
					<form method="post" action="{{ route('updateEvent',[$row->id]) }}">
						{{ @csrf_field() }}
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="{{ old('name', $row->name) }}">
                    @if ($errors->has('name')) 
                    <span class="help-block">
                        <span>{{ $errors->first('name') }}</span>
                    </span>
                    @endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Event Date</label>
							<div class="col-sm-9">
                            <input type="text" autocomplete="off" id="evet_start_date" name="event_date" class="form-control" value="{{ old('event_date', date('Y/m/d H:i', strtotime($row->event_date))) }}">
                    @if ($errors->has('event_date')) 
                    <span class="help-block">
                        <span>{{ $errors->first('event_date') }}</span>
                    </span>
                    @endif
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-10">
								<input type="submit" class="btn btn-success" value="Update">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection