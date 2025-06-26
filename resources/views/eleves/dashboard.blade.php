<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord élève</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="container max-w-lg mx-auto bg-white rounded-2xl shadow-xl p-8 fade-in">
        <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">Bienvenue, {{ Auth::guard('eleve')->user()->prenom }} !</h2>
        
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg fade-in" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <p class="text-center text-gray-600 mb-6">Vous êtes connecté à votre tableau de bord élève.</p>
        <form method="POST" action="{{ route('eleves.logout') }}">
            @csrf
            <button type="submit" class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold btn-hover transition duration-300 transform">
                Se déconnecter
            </button>
        </form>
    </div>
</body>
</html>