<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Lien vers le fichier CSS de Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
        <h1 class="text-2xl font-semibold text-center mb-4 text-gray-800">Payer pour votre trajet</h1>

        @if(session('success_message'))
            <div class="mb-4 text-green-600 bg-green-100 p-3 rounded-md">
                {{ session('success_message') }}
            </div>
        @elseif(session('error_message'))
            <div class="mb-4 text-red-600 bg-red-100 p-3 rounded-md">
                {{ session('error_message') }}
            </div>
        @endif

        <form action="{{ route('passager.charge') }}" method="POST" id="payment-form">
            @csrf
            <div class="mb-4">
                <label for="card-element" class="block text-lg font-medium text-gray-700">Carte de crédit</label>
                <div id="card-element" class="mt-2 p-2 border border-gray-300 rounded-md"></div>
                <div id="card-errors" role="alert" class="mt-2 text-red-600"></div>
            </div>

            <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">Payer</button>
            @csrf
        </form>
    </div>

    <script>
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var elements = stripe.elements();
        var card = elements.create("card");
        card.mount("#card-element");

        var form = document.getElementById("payment-form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById("card-errors");
                    errorElement.textContent = result.error.message;
                } else {
                    var form = document.getElementById("payment-form");
                    var hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "stripeToken");
                    hiddenInput.setAttribute("value", result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
