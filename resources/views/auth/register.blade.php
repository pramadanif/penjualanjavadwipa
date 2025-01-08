<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="./favicon.png" />
    <title>Register</title>

    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssku.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Style dasar card */
        .wrap {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .login-wrap {
            padding: 40px;
            flex-basis: 50%;
            background-color: #ffffff; /* Warna putih bersih */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .img {
            flex-basis: 50%;
            min-height: 500px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 0 10px 10px 0;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .wrap {
                flex-direction: column;
                align-items: center;
            }
            .img {
                border-radius: 10px 10px 0 0;
                flex-basis: 100%;
                min-height: 300px;
            }
            .login-wrap {
                flex-basis: 100%;
                padding: 30px 20px;
                border-radius: 0 0 10px 10px;
            }
        }
    </style>
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
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Register</h3>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="signin-form">
                                @csrf

                                <div class="form-group mb-3">
                                    <label class="label" for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="label" for="email">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="label" for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="label" for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn-block btn btn-success rounded px-3">{{ __('Register') }}</button>
                                </div>

                                <div class="form-group text-center">
                                    <p>Already have an account? <a href="{{ route('login') }}" style="color: #0055ff">{{ __('Login') }}</a></p>
                                </div>
                            </form>
                        </div>
                        <div class="img" style="background-image: url('https://images.unsplash.com/photo-1736306919941-81b51e0592f2?q=80&w=1792&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); ">
                        </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
