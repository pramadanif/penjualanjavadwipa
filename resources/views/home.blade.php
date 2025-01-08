<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Pram') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .welcome-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 3rem;
            text-align: center;
            max-width: 500px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 1.5rem;
            animation: bounce 1.5s infinite;
        }
        .btn-custom {
            margin: 10px;
            padding: 12px 25px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-5px);
        }
        .marquee {
            background-color: #f1f3f5;
            padding: 10px;
            border-radius: 10px;
            overflow: hidden;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <img src="{{ URL::to('/assets/javadwipa.png') }}" alt="Logo" class="logo">

        <div class="marquee">
            <marquee behavior="scroll" direction="left">
                Selamat Datang di Sistem Manajemen Penjualan - Solusi Terbaik untuk Bisnis Anda
            </marquee>
        </div>

        <div class="mt-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/customers') }}" class="btn btn-primary btn-custom">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success btn-custom">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-info btn-custom">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</body>
</html>
