<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte élève</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            border-color: #3b82f6;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="container max-w-lg mx-auto bg-white rounded-2xl shadow-xl p-8 fade-in">
        <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">Créer un compte élève</h2>
        
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg fade-in" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg fade-in" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('eleves.store') }}" class="space-y-6">
            @csrf
            <div class="form-group">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="nom" id="nom" class="w-full px-4 py-2 border border-gray-300 rounded-lg input-focus transition duration-300" value="{{ old('nom') }}" required>
            </div>
            <div class="form-group">
                <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="w-full px-4 py-2 border border-gray-300 rounded-lg input-focus transition duration-300" value="{{ old('prenom') }}" required>
            </div>
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg input-focus transition duration-300" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="date_naissance" class="block text-sm font-medium text-gray-700 mb-1">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" class="w-full px-4 py-2 border border-gray-300 rounded-lg input-focus transition duration-300" value="{{ old('date_naissance') }}">
            </div>
            <div class="form-group">
                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                <input type="text" name="telephone" id="telephone" class="w-full px-4 py-2 border border-gray-300 rounded-lg input-focus transition duration-300" value="{{ old('telephone') }}">
            </div>
            <div class="form-group">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg input-focus transition duration-300" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg input-focus transition duration-300" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-semibold btn-hover transition duration-300 transform">
                Créer le compte
            </button>
        </form>
        <p class="text-center mt-4 text-gray-600">Déjà un compte ? <a href="{{ route('eleves.login') }}" class="text-indigo-600 hover:underline">Se connecter</a></p>
    </div>
</body>
</html>