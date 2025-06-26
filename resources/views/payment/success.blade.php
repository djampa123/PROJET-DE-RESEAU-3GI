<!-- resources/views/payment/success.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement Réussi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4 text-center">
        <h1 class="text-success mb-4">✅ Paiement réussi !</h1>

        <p class="fs-5">Merci <strong>{{ $school->name }}</strong> 🙏</p>
        <p>Votre test abonnement annuel de <strong>200 000 FCFA</strong> a bien été enregistré.</p>
        <p>Vous êtes desormais membre de notre plateforme et cous pouvez jouir de nos differents service d'accompagnement</p>

        <hr class="my-4">

        <a href="{{ url('/') }}" class="btn btn-outline-primary">Retour à l’accueil</a>
    </div>
</div>

</body>
</html>
