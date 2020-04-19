@extends('layouts.app')
@section('css')
<style>
.help-block span{
	color:#FF0000;
}
</style>
@endsection

@section('content')
	<form method="post" action="{{ route('updateUserType',[$row->id]) }}">
		{{  @csrf_field() }}
		@method('POST')
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Edit User Type</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Type Name</label>
						<input type="text" name="typename" value="{{ $row->type_name }}" class="form-control">
						@if ($errors->has('typename')) 
							<span class="help-block">
								<span>{{ $errors->first('typename') }}</span>
							</span>
						@endif
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Submit">
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('page-script')
<script>

</script>
@endsection

