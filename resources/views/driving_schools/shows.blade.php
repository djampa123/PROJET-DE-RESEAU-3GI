<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $school->name }} - Auto-écoles Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e6f0fa 0%, #f5f7fa 100%);
            min-height: 100vh;
            color: #1a252f;
        }

        .navbar {
            background: #1a252f;
            padding: 15px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand img {
            height: 45px;
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.1);
        }

        .school-details {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin: 40px 0;
            transition: transform 0.3s ease;
        }

        .school-details:hover {
            transform: translateY(-5px);
        }

        .school-details img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .school-details img:hover {
            transform: scale(1.02);
        }

        .license-table {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        .license-table th, .license-table td {
            padding: 12px;
            text-align: left;
        }

        .license-table th {
            background: #f0c14b;
            color: #1a252f;
            font-weight: 600;
        }

        .license-table td {
            background: #f8f9fa;
        }

        .btn-primary {
            background: #f0c14b;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            color: #1a252f;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #e6b032;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .btn-outline-secondary {
            border-color: #ddd;
            color: #1a252f;
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: #f7f7f7;
            transform: translateY(-2px);
        }

        .rating {
            display: inline-flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .rating-count {
            font-size: 0.9rem;
            color: #007185;
            margin-left: 10px;
        }

        .admin-controls {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .admin-controls a {
            color: #007185;
            text-decoration: none;
            font-weight: 500;
        }

        .admin-controls a:hover {
            color: #c45500;
            text-decoration: underline;
        }

        .footer {
            background: #1a252f;
            color: #ddd;
            padding: 40px 20px;
            text-align: center;
            font-size: 0.9rem;
        }

        .footer a {
            color: #febd69;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 500;
        }

        .footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .school-details img {
                height: 200px;
            }

            .navbar-brand img {
                height: 35px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="https://via.placeholder.com/120x40?text=Auto-écoles+Connect" alt="Auto-écoles Connect">
            </a>
            <div class="ms-auto d-flex align-items-center gap-3">
                @if(auth()->check() && auth()->user()->is_admin)
                    <a href="{{ route('driving-schools.admin.show') }}" class="btn btn-outline-secondary text-white">Gérer mon auto-école</a>
                @endif
                <a href="{{ route('driving-schools.create') }}" class="btn btn-outline-secondary text-white">S'inscrire</a>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary text-white">Se connecter</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="school-details">
            <h2 class="mb-4">{{ $school->name }}</h2>
            <img src="{{ $school->image ? asset('storage/' . $school->image) : 'https://via.placeholder.com/600x300?text=Image+Auto-école' }}" alt="{{ $school->name }}">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Ville :</strong> {{ $school->city }}</p>
                    <p><strong>Email :</strong> {{ $school->email }}</p>
                    <p><strong>Téléphone :</strong> {{ $school->phone }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Note :</strong> 
                        <span class="rating">
                            {{ number_format($school->rating, 1) }}
                            <span class="rating-count">({{ $school->rating_count ?? 0 }} avis)</span>
                        </span>
                    </p>
                    <p><strong>Offre :</strong> {{ $school->offer ?? 'Non spécifiée' }}</p>
                    <p><strong>Statut :</strong> {{ $school->is_approved ? 'Approuvée' : 'En attente d\'approbation' }}</p>
                </div>
            </div>

            @if($school->licenseOffers->count() > 0)
                <h4 class="mt-4 mb-3">Permis proposés</h4>
                <table class="table license-table">
                    <thead>
                        <tr>
                            <th>Type de permis</th>
                            <th>Prix (FCFA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($school->licenseOffers as $offer)
                            <tr>
                                <td>Permis {{ $offer->license_type }}</td>
                                <td>{{ number_format($offer->price, 0, ',', ' ') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted mt-4">Aucun permis proposé pour le moment.</p>
            @endif

            @if(auth()->check() && auth()->user()->is_admin)
                <div class="admin-controls">
                    <h4 class="mb-3">Gestion de l'auto-école</h4>
                    <p><strong>Document soumis :</strong> 
                        <a href="{{ asset('storage/' . $school->document_path) }}" target="_blank">Voir le document</a>
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('driving-schools.edit', $school->id) }}" class="btn btn-primary">Modifier les informations</a>
                        @if(!$school->is_paid)
                            <a href="{{ route('driving-schools.simulate-payment', $school->id) }}" class="btn btn-primary">Simuler le paiement</a>
                        @else
                            <span class="text-success">Paiement effectué</span>
                        @endif
                    </div>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('driving-schools.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="d-flex justify-content-center flex-wrap mb-3">
                <a href="#">À propos</a>
                <a href="#">Conditions</a>
                <a href="#">Confidentialité</a>
                <a href="#">Contact</a>
                <a href="#">Aide</a>
            </div>
            <p>© 2025 Auto-écoles Connect. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>