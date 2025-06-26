<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Auto-école - Auto-écoles Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Réinitialisation et styles globaux */
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
        }

        /* En-tête */
        .navbar {
            background: #1a252f;
            padding: 15px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand img {
            height: 40px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #febd69;
        }

        /* Conteneur principal */
        .main-content {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        h2 {
            font-weight: 600;
            color: #1a252f;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Champs de formulaire */
        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0,123,255,0.2);
        }

        .form-label {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        /* Checkbox et prix */
        .license-group {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #2c3e50;
        }

        .license-price-input {
            max-width: 150px;
            border-radius: 8px;
        }

        .license-price-input:disabled {
            background: #f8f9fa;
            cursor: not-allowed;
        }

        /* Prévisualisation d'image */
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
            display: none;
        }

        /* Bouton de soumission */
        .btn-success {
            background: #28a745;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .btn-success.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 3px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Messages d'erreur */
        .invalid-feedback {
            font-size: 0.85rem;
            color: #dc3545;
        }

        /* Footer */
        .footer {
            background: #1a252f;
            color: #ddd;
            padding: 20px;
            text-align: center;
            font-size: 0.85rem;
            margin-top: 40px;
        }

        .footer a {
            color: #febd69;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .main-content {
                padding: 20px;
                margin: 20px;
            }

            .license-group {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .license-price-input {
                max-width: 100%;
            }

            .navbar-brand img {
                height: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="https://via.placeholder.com/120x40?text=Auto-écoles+Connect" alt="Auto-écoles Connect">
            </a>
            <div class="ms-auto d-flex align-items-center gap-3">
               
                <a href="{{ route('driving-schools.index') }}">Retour à la liste</a>
            </div>
        </div>
    </nav>

    <!-- Formulaire -->
    <div class="main-content">
        <h2>Inscription d'une auto-école</h2>
        <form method="POST" action="{{ route('driving-schools.store') }}" enctype="multipart/form-data" id="schoolForm">
            @csrf

            <!-- Nom de l'auto-école -->
            <div class="mb-4">
                <label for="name" class="form-label">Nom de l'auto-école</label>
                <input type="text" class="form-control" id="name" name="name" required
                       pattern="[A-Za-z0-9\s\-']{3,100}"
                       title="Le nom doit contenir entre 3 et 100 caractères (lettres, chiffres, espaces, tirets, apostrophes).">
                <div class="invalid-feedback">Veuillez entrer un nom valide (3-100 caractères).</div>
            </div>

            <!-- Ville -->
            <div class="mb-4">
                <label for="city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city" required
                       pattern="[A-Za-z\s\-]{2,50}"
                       title="La ville doit contenir entre 2 et 50 caractères (lettres, espaces, tirets).">
                <div class="invalid-feedback">Veuillez entrer une ville valide.</div>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Veuillez entrer un email valide.</div>
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required
                       pattern="\+?[0-9\s\-]{8,15}"
                       title="Le numéro doit contenir entre 8 et 15 chiffres (peut inclure +, espaces, tirets).">
                <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide.</div>
            </div>

            <!-- Types de permis -->
            <div class="mb-4">
                <label class="form-label">Types de permis proposés avec prix (en FCFA)</label>
                @php
                    $permis = ['A', 'B', 'C', 'D', 'E'];
                @endphp
                @foreach($permis as $type)
                    <div class="license-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="license_types[]" value="{{ $type }}"
                                   id="license{{ $type }}" onchange="togglePriceInput(this, 'price{{ $type }}')">
                            <label class="form-check-label" for="license{{ $type }}">Permis {{ $type }}</label>
                        </div>
                        <input type="number" class="form-control license-price-input" name="license_prices[{{ $type }}]"
                               id="price{{ $type }}" placeholder="Prix permis {{ $type }}" disabled min="0" step="100">
                    </div>
                @endforeach
                <div class="invalid-feedback d-none" id="licenseError">Veuillez sélectionner au moins un type de permis.</div>
            </div>

            <!-- Document justificatif -->
            <div class="mb-4">
                <label for="document" class="form-label">Document justificatif (PDF, JPG, PNG)
                    <span class="text-muted" data-bs-toggle="tooltip"
                          title="Formats acceptés : PDF, JPG, JPEG, PNG. Taille max : 5 Mo">ℹ️</span>
                </label>
                <input type="file" class="form-control" id="document" name="document" accept=".pdf,.jpg,.jpeg,.png" required>
                <div class="invalid-feedback">Veuillez sélectionner un fichier valide (PDF, JPG, PNG).</div>
            </div>

            <!-- Image de l'auto-école -->
            <div class="mb-4">
                <label for="image" class="form-label">Image de l'auto-école (facultatif)
                    <span class="text-muted" data-bs-toggle="tooltip"
                          title="Formats acceptés : JPG, JPEG, PNG. Taille max : 2 Mo">ℹ️</span>
                </label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <img id="imagePreview" class="image-preview" alt="Prévisualisation">
            </div>

            <!-- Bouton de soumission -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Soumettre l'inscription</button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <a href="#">À propos</a>
            <a href="#">Conditions d'utilisation</a>
            <a href="#">Confidentialité</a>
            <a href="#">Contact</a>
            <p>© 2025 Auto-écoles Connect. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Activer/désactiver les champs de prix
        function togglePriceInput(checkbox, priceInputId) {
            const priceInput = document.getElementById(priceInputId);
            priceInput.disabled = !checkbox.checked;
            if (!checkbox.checked) {
                priceInput.value = '';
            }
        }

        // Prévisualisation de l'image
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('imagePreview');
            if (file && file.type.startsWith('image/')) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });

        // Validation du formulaire
        document.getElementById('schoolForm').addEventListener('submit', function(e) {
            const form = this;
            let isValid = true;

            // Vérifier qu'au moins un permis est sélectionné
            const licenseCheckboxes = form.querySelectorAll('input[name="license_types[]"]:checked');
            const licenseError = document.getElementById('licenseError');
            if (licenseCheckboxes.length === 0) {
                licenseError.classList.remove('d-none');
                isValid = false;
            } else {
                licenseError.classList.add('d-none');
            }

            // Vérifier les champs de prix pour les permis sélectionnés
            licenseCheckboxes.forEach(checkbox => {
                const type = checkbox.value;
                const priceInput = document.getElementById(`price${type}`);
                if (!priceInput.value || priceInput.value <= 0) {
                    priceInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    priceInput.classList.remove('is-invalid');
                }
            });

            // Validation des autres champs
            ['name', 'city', 'email', 'phone', 'document'].forEach(id => {
                const input = document.getElementById(id);
                if (!input.checkValidity()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Animation de chargement
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Envoi en cours...';
        });

        // Activer les tooltips Bootstrap
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(tooltipTriggerEl => {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>