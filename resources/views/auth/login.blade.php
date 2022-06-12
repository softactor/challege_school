@extends('layouts.loginLayout')

@section('content')
<div class="row justify-content-center h-100 align-items-center">
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        <div class="text-center mb-3">
                            <img src="<?php echo asset('public/theme/images/registro_Logo-PNG.png') ?>" alt="">
                        </div>
                        <h4 class="text-center mb-4">Sign in your account</h4>
                        <form action="{{ route('login') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="mb-1"><strong>Email</strong>
                                <div class="error text-danger">
                                    {{ $errors->first('email') }}
                                </div>
                                </label>
                                <input name="email" type="email" id="email" class="form-control" value="{{ old('email')}}">
                            </div>
                            <div class="form-group">
                                <label class="mb-1"><strong>Password</strong>
                                <div class="error text-danger">{{ $errors->first('password') }}</div>
                            </label>
                                <input name="password" type="password" id="password" class="form-control">
                            </div>
                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                <div class="form-group">
                                    <a href="page-forgot-password.php">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary btn-block" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection