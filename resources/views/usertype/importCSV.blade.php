@extends('layouts.app')
@section('css')
<style>
.help-block span{
	color:#FF0000;
}
</style>
@endsection

@section('content')
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">Import User Type CSV</div>
		<div class="panel-body">
			<form method="post" action="{{ route('uploadUserTypesCSV') }}" enctype="multipart/form-data">
			{{  @csrf_field() }}
			@method('POST')
				<div class="form-group">
					<label>Upload CSV</label>
					<input type="file" name="user_type_csv" class="form-control">
					@if ($errors->has('user_type_csv')) 
						<span class="help-block">
							<span>{{ $errors->first('user_type_csv') }}</span>
						</span>
					@endif
				</div>
				
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('page-script')
<script>
$(document).ready( function () {
    $('#attendeeTable').DataTable( {
		responsive: true
	} );
} );
</script>
@endsection

