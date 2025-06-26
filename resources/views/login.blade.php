<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - Auto-écoles Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e6f0fa 0%, #f5f7fa 100%);
            min-height: 100vh;
            color: #1a252f;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://via.placeholder.com/1920x1080?text=Background') no-repeat center/cover;
            opacity: 0.1;
            z-index: -1;
            animation: subtleMove 20s infinite linear;
        }

        @keyframes subtleMove {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-container h2 {
            font-weight: 600;
            color: #1a252f;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-label {
            font-size: 0.95rem;
            font-weight: 500;
            color: #2c3e50;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 0.9rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0,123,255,0.2);
        }

        .btn-primary {
            background: #f0c14b;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a252f;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #e6b032;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .integrer-link {
            color: #007185;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 15px;
            transition: color 0.3s ease;
        }

        .integrer-link:hover {
            color: #c45500;
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 20px;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-overlay"></div>
    <div class="login-container">
        <h2>Connexion</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
        <a href="{{ route('register') }}" class="integrer-link">Pas de compte ? Inscrivez-vous</a>
        <a href="{{ route('password.request') }}" class="integrer-link">Mot de passe oublié ?</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>