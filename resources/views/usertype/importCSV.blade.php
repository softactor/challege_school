@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header d-block">
				<div class="row">
					<div class="col-md-3">
						<h4 class="card-title">User Type Upload</h4>
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
					<form method="post" action="{{ route('uploadUserTypesCSV') }}" enctype="multipart/form-data">
						{{ @csrf_field() }}
						@method('POST')
						<div class="col-lg-12">

							<div class="alert alert-danger print-error-msg" style="display:none">
								<ul></ul>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Upload CSV</label>
										<input type="file" name="user_type_csv" class="form-control">
										@if ($errors->has('user_type_csv'))
										<span class="help-block">
											<span>{{ $errors->first('user_type_csv') }}</span>
										</span>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
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