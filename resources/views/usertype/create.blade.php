@extends('layouts.app')
@section('css')
<style>
.help-block span{
	color:#FF0000;
}
</style>
@endsection

@section('content')
	<form method="post" action="{{ route('saveUserType') }}">
		{{  @csrf_field() }}
		@method('POST')
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Add User Type</div>
				<div class="panel-body">
                                        <div class="form-group">
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
					<div class="form-group">
						<label>Type Name</label>
						<input type="text" name="typename" class="form-control">
						@if ($errors->has('typename')) 
							<span class="help-block">
								<span>{{ $errors->first('typename') }}</span>
							</span>
						@endif
					</div>
                                        <div class="form-group">
                                            <label for="usr">Text Color:</label>
                                            <input type="color" class="form-control" id="text_clor" name="text_clor">
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">BG Color:</label>
                                            <input type="color" class="form-control" id="background_color" name="background_color">
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

