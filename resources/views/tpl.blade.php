@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Settings: About Registro</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo route('admin.settings.index') ?>">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Setting List
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
                <form action="{{ route('admin.about_registro_srore') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="comment">About:</label>
                <textarea class="form-control rich_editor" rows="5" id="short_description" name="short_description"><?php echo (isset($aboutRegistro->values) && !empty($aboutRegistro->values) ? $aboutRegistro->values : ''); ?></textarea>
            </div>
            <input type="submit" class="form-control btn btn-primary btn-block" name="short_description_add" value="Save">
        </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
    $(document).ready(function() {
        $('#eventTable').DataTable();
    });
</script>
@endsection