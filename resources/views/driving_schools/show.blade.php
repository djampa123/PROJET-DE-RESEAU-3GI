<!-- resources/views/payment/show.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement de l’abonnement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">💳 Paiement de l'abonnement annuel</h2>

    <div class="card p-4 shadow">
        <p><strong>Nom de l’auto-école :</strong> {{ $school->name }}</p>
        <p><strong>Montant à payer :</strong> <span class="text-success fw-bold">200 000 FCFA</span></p>

        <form method="POST" action="{{ route('payment.process', $school->id) }}">
            @csrf

            <div class="mb-3">
                <label for="card_number" class="form-label">Numéro de carte</label>
                <input type="text" name="card_number" class="form-control" id="card_number" placeholder="1234 5678 9012 3456" required>
            </div>

            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="expiration" class="form-label">Date d’expiration</label>
                    <input type="text" name="expiration" class="form-control" id="expiration" placeholder="MM/AA" required>
                </div>
                <div class="col-md-6">
                    <label for="cvc" class="form-label">CVC</label>
                    <input type="text" name="cvc" class="form-control" id="cvc" placeholder="123" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">💰 Payer maintenant</button>
        </form>
    </div>
</div>
</body>
</html>
