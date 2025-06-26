<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Auto-écoles Connect - Trouvez votre auto-école idéale</title>
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

        .search-bar {
            flex-grow: 1;
            max-width: 700px;
            position: relative;
        }

        .search-bar input {
            border-radius: 25px 0 0 25px;
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .search-bar input:focus {
            box-shadow: 0 0 10px rgba(0,123,255,0.3);
        }

        .search-bar button {
            border-radius: 0 25px 25px 0;
            background: #febd69;
            border: none;
            padding: 12px 20px;
            color: #1a252f;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .search-bar button:hover {
            background: #f3a847;
        }

        .main-content {
            padding: 40px 20px;
        }

        .sidebar {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .sidebar:hover {
            transform: translateY(-5px);
        }

        .sidebar h5 {
            font-weight: 600;
            color: #1a252f;
            margin-bottom: 20px;
        }

        .sidebar .form-label {
            font-size: 0.95rem;
            font-weight: 500;
            color: #2c3e50;
        }

        .sidebar .form-control, .sidebar .form-select {
            border-radius: 10px;
            padding: 10px;
            font-size: 0.9rem;
            transition: border-color 0.3s ease;
        }

        .sidebar .form-control:focus, .sidebar .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0,123,255,0.2);
        }

        .sidebar .form-check-label {
            font-size: 0.85rem;
            color: #2c3e50;
        }

        .school-card {
            background: white;
            border: none;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .school-card:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .school-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .school-card:hover img {
            transform: scale(1.05);
        }

        .school-card h6 {
            font-weight: 600;
            font-size: 1.1rem;
            color: #1a252f;
            margin-bottom: 10px;
        }

        .rating {
            display: inline-flex;
            flex-direction: row-reverse;
            margin-bottom: 10px;
            position: relative;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 1.1rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.2s ease;
            margin: 0 2px;
        }

        .rating label:hover,
        .rating label:hover ~ label,
        .rating input:checked ~ label {
            color: #f0c14b;
            transform: scale(1.2);
        }

        .rating.disabled label {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .rating-count {
            font-size: 0.9rem;
            color: #007185;
            margin-left: 10px;
        }

        .license-price {
            font-size: 0.95rem;
            color: #2c3e50;
            margin: 5px 0;
        }

        .integrer-link {
            color: #007185;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 10px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        .integrer-link:hover {
            color: #c45500;
            text-decoration: underline;
        }

        .btn-primary {
            background: #f0c14b;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a252f;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #e6b032;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .btn-outline-secondary {
            border-color: #ddd;
            color:blue;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: #f7f7f7;
            transform: translateY(-2px);
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

        .comments-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-top: 40px;
        }

        .comments-section h5 {
            font-weight: 600;
            color: #1a252f;
            margin-bottom: 20px;
        }

        .comment {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .comment-author {
            font-weight: 500;
            color: #2c3e50;
        }

        .comment-text {
            font-size: 0.9rem;
            color: #2c3e50;
        }

        @media (max-width: 992px) {
            .search-bar {
                max-width: 100%;
            }

            .sidebar {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 768px) {
            .school-card img {
                height: 140px;
            }

            .navbar-brand img {
                height: 35px;
            }

            .search-bar input {
                font-size: 0.9rem;
                padding: 10px;
            }

            .search-bar button {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-overlay"></div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="https://via.placeholder.com/120x40?text=Auto-écoles+Connect" alt="Auto-écoles Connect">
            </a>
            <div class="search-bar d-flex">
                <input type="text" id="searchInput" placeholder="Rechercher par nom, ville ou permis">
                <button type="button">🔍</button>
            </div>
            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="{{ route('driving-schools.create') }}" class="btn btn-outline-secondary">Inscrire Autoecole</a>
                <a href="{{ route('eleves.create') }}" class="btn btn-outline-secondary">Inscrire Etudiant</a>
                <a href="{{ route('eleves.login') }}" class="btn btn-outline-secondary">se connecter</a>
            </div>
        </div>
    </nav>

    <div class="main-content container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar">
                    <h5>Filtres de recherche</h5>
                    <form method="GET" action="{{ route('driving-schools.index') }}">
                        <div class="mb-4">
                            <label class="form-label">Ville</label>
                            <input type="text" class="form-control" name="city" value="{{ request('city') }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Type de permis</label>
                            <select class="form-select" name="license_type">
                                <option value="">Tous</option>
                                @foreach(['A','B','C','D','E'] as $type)
                                    <option value="{{ $type }}" @selected(request('license_type') == $type)>Permis {{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Prix maximum (FCFA)</label>
                            <input type="number" class="form-control" name="max_price" value="{{ request('max_price') }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Note minimale</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="4" name="rating[]" id="rating4">
                                <label class="form-check-label" for="rating4">4 étoiles et plus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="3" name="rating[]" id="rating3">
                                <label class="form-check-label" for="rating3">3 étoiles et plus</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Appliquer</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-9">
                <h4 class="mb-4">Auto-écoles partenaires</h4>
                @if($schools->isEmpty())
                    <div class="text-center text-muted">
                        <p>Aucune auto-école disponible pour le moment.</p>
                        <a href="/main" class="integrer-link">Intégrer auto-école</a>
                    </div>
                @else
                    <div class="row">
                        @foreach($schools as $school)
                            <div class="col-md-4">
                                <div class="school-card" data-school-id="{{ $school->id }}">
                                    <a href="/main" class="integrer-link">Intégrer auto-école</a>
                                    <img src="{{ $school->image ? asset('storage/' . $school->image) : 'https://via.placeholder.com/300x180' }}" alt="{{ $school->name }}">
                                    <h6>{{ $school->name }}</h6>
                                    <h6>{{ $school->city }}</h6>
                                    <div class="rating @if(!Auth::check()) disabled @endif" data-bs-toggle="tooltip" title="@if(!Auth::check()) Connectez-vous pour noter @endif">
                                        <input type="radio" id="star5-{{ $school->id }}" name="rating-{{ $school->id }}" value="5" @if(!Auth::check()) disabled @endif>
                                        <label for="star5-{{ $school->id }}">★</label>
                                        <input type="radio" id="star4-{{ $school->id }}" name="rating-{{ $school->id }}" value="4" @if(!Auth::check()) disabled @endif>
                                        <label for="star4-{{ $school->id }}">★</label>
                                        <input type="radio" id="star3-{{ $school->id }}" name="rating-{{ $school->id }}" value="3" @if(!Auth::check()) disabled @endif>
                                        <label for="star3-{{ $school->id }}">★</label>
                                        <input type="radio" id="star2-{{ $school->id }}" name="rating-{{ $school->id }}" value="2" @if(!Auth::check()) disabled @endif>
                                        <label for="star2-{{ $school->id }}">★</label>
                                        <input type="radio" id="star1-{{ $school->id }}" name="rating-{{ $school->id }}" value="1" @if(!Auth::check()) disabled @endif>
                                        <label for="star1-{{ $school->id }}">★</label>
                                        <span class="rating-count">({{ number_format($school->rating, 1) }} - {{ $school->rating_count ?? rand(10, 100) }} avis)</span>
                                    </div>
                                    <p class="mb-2 small">{{ Str::limit($school->offer ?? 'Offre non spécifiée', 60) }}</p>
                                    @if($school->licenseOffers && $school->licenseOffers->count() > 0)
                                        @foreach($school->licenseOffers as $offer)
                                            <div class="license-price">
                                                <strong>Permis {{ $offer->license_type }} :</strong> {{ number_format($offer->price, 0, ',', ' ') }} FCFA
                                            </div>
                                        @endforeach
                                    @else
                                        <small class="text-muted">Aucun permis disponible</small>
                                    @endif
                                    <div class="mt-3 d-flex gap-2 flex-wrap">
                                        <a href="/main" class="btn btn-primary btn-sm">voir autoecole</a>
                                       
                                        <button class="btn btn-outline-secondary btn-sm compare-btn" data-school-id="{{ $school->id }}">Comparer</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <h4 class="mt-5 mb-4">Recommandées pour vous</h4>
                <div class="row">
                    @for($i = 1; $i <= 3; $i++)
                        <div class="col-md-4">
                            <div class="school-card">
                                <a href="/main" class="integrer-link">Intégrer auto-école</a>
                                <img src="https://via.placeholder.com/300x180?text=Recommandé+{{ $i }}" alt="Auto-école recommandée">
                                <h6>Auto-école Excellence {{ $i }}</h6>
                                <div class="rating">
                                    <span class="rating-count">(4.{{ rand(0,9) }} - {{ rand(50,200) }} avis)</span>
                                </div>
                                <div class="license-price">
                                    <strong>Permis B :</strong> {{ number_format(rand(300000, 500000), 0, ',', ' ') }} FCFA
                                </div>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary btn-sm">Voir détails</a>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="comments-section">
                    <h5>Commentaires</h5>
                    <form id="commentForm" class="mb-4">
                        <div class="mb-3">
                            <label for="commentInput" class="form-label">Votre commentaire</label>
                            <textarea class="form-control" id="commentInput" rows="4" placeholder="Écrivez votre commentaire ici..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Publier</button>
                    </form>
                    <div id="commentsContainer">
                        <!-- Comments will be dynamically populated here -->
                    </div>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Recherche dynamique
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.school-card').forEach(card => {
                const name = card.querySelector('h6').textContent.toLowerCase();
                const city = card.dataset.city ? card.dataset.city.toLowerCase() : '';
                const licenses = card.dataset.licenses ? card.dataset.licenses.toLowerCase() : '';
                card.style.display = name.includes(searchTerm) || city.includes(searchTerm) || licenses.includes(searchTerm) ? '' : 'none';
            });
        });

        // Notation interactive
        document.querySelectorAll('.rating:not(.disabled) input').forEach(input => {
            input.addEventListener('change', function() {
                const schoolId = this.closest('.school-card').dataset.schoolId;
                const rating = this.value;

                fetch('/api/rate-school/' + schoolId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ rating: rating })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Erreur réseau : ' + response.status);
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const ratingSpan = this.closest('.rating').querySelector('.rating-count');
                        ratingSpan.textContent = `(${data.newRating} - ${data.ratingCount} avis)`;
                        alert('Note enregistrée avec succès !');
                    } else {
                        alert('Erreur : impossible d\'enregistrer la note.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur : la note n\'a pas pu être enregistrée. Veuillez réessayer.');
                });
            });
        });

        // Comparaison
        document.querySelectorAll('.compare-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const schoolId = this.dataset.schoolId;
                alert(`Auto-école ${schoolId} ajoutée à la comparaison !`);
            });
        });

        // Tooltips Bootstrap
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        // Gestion des commentaires
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour afficher les commentaires
            function renderComments(comments) {
                console.log('Rendu des commentaires:', comments);
                const commentsContainer = document.getElementById('commentsContainer');
                commentsContainer.innerHTML = '';
                if (comments.length > 0) {
                    comments.forEach(comment => {
                        const commentElement = document.createElement('div');
                        commentElement.className = 'comment';
                        commentElement.innerHTML = `
                            <div class="comment-author">${comment.author}</div>
                            <div class="comment-text">${comment.text}</div>
                        `;
                        commentsContainer.appendChild(commentElement);
                    });
                } else {
                    commentsContainer.innerHTML = '<p class="text-muted">Aucun commentaire pour le moment.</p>';
                }
            }

            // Charger les commentaires depuis le serveur
            function loadComments() {
                console.log('Chargement des commentaires...');
                fetch('/api/comments')
                    .then(response => {
                        console.log('Réponse GET /api/comments:', response.status);
                        if (!response.ok) throw new Error('Erreur réseau : ' + response.status);
                        return response.json();
                    })
                    .then(data => {
                        renderComments(data);
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des commentaires:', error);
                        renderComments([]);
                    });
            }

            // Sauvegarder un nouveau commentaire
            function saveComment(author, text) {
                console.log('Envoi du commentaire au serveur:', { author, text });
                fetch('/api/comments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ author, text })
                })
                .then(response => {
                    console.log('Réponse POST /api/comments:', response.status);
                    if (!response.ok) throw new Error('Erreur réseau : ' + response.status);
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log('Commentaire enregistré avec succès');
                        loadComments();
                        alert('Commentaire publié avec succès !');
                    } else {
                        console.error('Erreur serveur:', data.error);
                        alert('Erreur : impossible d\'enregistrer le commentaire.');
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de l\'envoi du commentaire:', error);
                    alert('Erreur : le commentaire n\'a pas pu être enregistré. Veuillez réessayer.');
                });
            }

            // Charger les commentaires au démarrage
            loadComments();

            // Gérer la soumission du formulaire
            const commentForm = document.getElementById('commentForm');
            if (commentForm) {
                commentForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    console.log('Formulaire soumis');
                    const commentInput = document.getElementById('commentInput');
                    const commentText = commentInput.value.trim();

                    if (commentText) {
                        const isAuthenticated = @json(Auth::check());
                        const author = isAuthenticated ? '{{ Auth::user()->name ?? "Utilisateur Connecté" }}' : 'Anonyme';
                        saveComment(author, commentText);
                        commentInput.value = '';
                    } else {
                        alert('Veuillez entrer un commentaire valide.');
                    }
                });
            } else {
                console.error('Formulaire #commentForm non trouvé');
            }
        });
    </script>
</body>
</html>