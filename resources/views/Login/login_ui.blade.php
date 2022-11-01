@extends('Login.template.Layout_Login')
@section('title')
    <title>Login Page</title>
	<link rel="icon" href="{{ asset('assets/images/KB_SymbolMark.png') }}">

@endsection
@section('page-css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css_1/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css_1/main.css') }}">
@endsection
@section('login_content')
<div class="limiter">		
	<div class="container-login100">
		<div class="wrap-login100">
			<form class="login100-form validate-form" method="post" action="">
				@csrf
					<img src="{{ asset('assets/images/kb_insurance_logo.png') }}" style="width:auto;height:30%;margin-left:20px">
					<span style="font-size:30px" class="login100-form-title p-b-25">
						Online Working Attendance Website
					</span>
					@include('Login.template.flash-message')			
					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<input class="input100" @error('username') is-invalid @enderror type="text" name="username" value="{{ old('username') }}" >
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>	
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name='action' value='submit'>
							Login
						</button>
					</div>
			</form>
			<div class="login100-more" style="background-image: url('./assets/images/logo_login.jpg');">
			</div>
		</div>
	</div>
</div>
@endsection