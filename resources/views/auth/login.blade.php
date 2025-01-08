<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" type="image/x-icon" href="./favicon.png" />
    <title>Login</title>

    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssku.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center my-4">
					{{-- <h2 class="heading-section">Login #04</h2> --}}
          			<a href="/"><img class="img-fluid" src="{{ URL::to('/assets/javadwipa.png') }}" style="width: 125px"></a>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-12">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url('https://images.unsplash.com/photo-1736306919941-81b51e0592f2?q=80&w=1792&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); ">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
			      	</div>
						<form method="POST" action="{{ route('login') }}" class="signin-form">
							@csrf
			      		<div class="form-group mb-3">
			      			<label class="label" for="email">{{ __('Email Address') }}</label>
			      			<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

							  @error('email')
							  <span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
							  </span>
						  @enderror
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">{{ __('Password') }}</label>
		              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>

					  @error('password')
					  <span class="invalid-feedback" role="alert">
						  <strong>{{ $message }}</strong>
					  </span>
				  	  @enderror
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="btn-block btn btn-success rounded px-3">{{ __('Login') }}</button>
		            </div>
					{{-- <div class="centering">
						@if (Route::has('password.request'))
						<a class="btn btn-link" style="color: black;" href="{{ route('password.request') }}">
							{{ __('Forgot Your Password?') }}
						</a>
						@endif
					</div> --}}
		            <div class="form-group d-md-flex">
						<div class="form-check w-50 text-left my-3">
							<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

							<label class="form-check-label text-md-right" for="remember">
								{{ __('Remember Me') }}
							</label>
						</div>
		            	{{-- <div class="w-50 text-left">
			            	<label class="checkbox-wrap">Remember Me
									  <input type="checkbox" {{ old('remember') ? 'checked' : '' }} checked >
									  <span class="checkmark"></span>
							</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div> --}}
		            </div>
		          </form>
				  @if (Route::has('register'))
		          <p class="text-center">Not a member? <a data-toggle="tab" href="{{ route('register') }}" style="color: #0055ff">{{ __('Register') }}</a></p>

				  {{-- <li class="nav-item">
					  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
				  </li> --}}

			  	  @endif
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

    {{-- <div class="container-fluid centering">
        <div class="card p-3" style="width: 18rem; ">
            <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div> --}}
	<script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
