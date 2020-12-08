
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
@endsection

@section('content')
<div class="splash-container">
	<div class="card">
		<div class="card-header text-center">
			 <a href="/">
				 <img class="logo-img" src="{{ asset('img/logo.png') }}" alt="logo"  style="width: 40%; margin-bottom: 30px;">
			    <h1>Login</h1>
			 </a>
			<span class="splash-description">Upišite vaše login informacije.</span>
		</div>
		<div class="card-body">
			<form method="POST" action="{{ route('login') }}">
				@csrf

				<div class="form-group">
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="form-group">
				    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} checked>
                        <span class="custom-control-label">Zapamti me</span>
                    </label>
				</div>

				<button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
			</form>
		</div>
	</div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
@endsection
