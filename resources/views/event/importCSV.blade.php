@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header d-block">
				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Event List</h4>
					</div>
					<div class="col-md-6 text-right">
						<a href="{{route('importEventCSV')}}">
							<button type="button" class="btn btn-rounded btn-info">
								<span class="btn-icon-left text-info">
									<i class="fa fa-list color-info"></i>
								</span>Import Events
							</button>
						</a>
						<a href="{{route('add_event')}}">
							<button type="button" class="btn btn-rounded btn-info">
								<span class="btn-icon-left text-info">
									<i class="fa fa-list color-info"></i>
								</span>Add Event
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
					<formmethod="post" action="{{ route('uploadEventCSV') }}" enctype="multipart/form-data">
						{{ @csrf_field() }}
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Upload CSV</label>
							<div class="col-sm-9">
								<input type="file" name="event_csv" class="form-control">
								@if ($errors->has('event_csv'))
								<span class="help-block">
									<span>{{ $errors->first('event_csv') }}</span>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-10">
								<input type="submit" class="btn btn-success" value="Upload">
							</div>
						</div>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection