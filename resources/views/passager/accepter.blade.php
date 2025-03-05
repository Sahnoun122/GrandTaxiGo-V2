<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
    <!-- Lien vers Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Entête de l'email -->
        <div class="bg-teal-600 text-white text-center py-6">
            <h1 class="text-3xl font-semibold">Confirmation de votre réservation</h1>
        </div>

        <!-- Contenu de l'email -->
        <div class="p-6 space-y-4">
            <p class="text-lg">Bonjour {{ $trajet->passager }},</p>
            <p class="text-base">Nous avons le plaisir de vous informer que votre réservation a été acceptée avec succès.</p>
            <p class="text-base">Veuillez trouver ci-dessous le QR Code de votre réservation pour l'accès à vos services :</p>

            <!-- QR Code -->
            <div class="flex justify-center">
                <img class="w-40 h-40 border border-gray-300 rounded-lg" src="{{ $message->embed(public_path('storage/' . $qrCodePath)) }}" alt="QR Code">
            </div>

            <p class="text-base">Merci pour votre confiance et votre réservation !</p>

            <!-- Bouton d'action -->
            <div class="text-center mt-6">
                <a href="#" class="inline-block px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">Voir votre réservation</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 text-center py-4 text-sm text-gray-500">
            <p>Si vous avez des questions, n'hésitez pas à <a href="mailto:support@example.com" class="text-teal-600">nous contacter</a>.</p>
            <p>&copy; {{ date('Y') }} Votre Entreprise. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
