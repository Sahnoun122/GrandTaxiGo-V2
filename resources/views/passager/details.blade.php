<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Trajet - EasyMatch Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Informations du trajet -->
            <h1 class="text-2xl font-bold mb-4">Détails du Trajet</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    {{-- <p class="text-gray-700"><strong>Chauffeur:</strong> {{ $disponibilite->chauffeur->nom }} {{ $disponibilite->chauffeur->prenom }}</p> --}}
                    <p class="text-gray-700"><strong>Destination:</strong> {{ $disponibilite->destination }}</p>
                    <p class="text-gray-700"><strong>Date de début:</strong> {{ $disponibilite->dateDebut }}</p>
                    <p class="text-gray-700"><strong>Date de fin:</strong> {{ $disponibilite->dateFin }}</p>
                    <p class="text-gray-700"><strong>Statut:</strong> {{ $disponibilite->statut }}</p>
                </div>
                <div class="flex justify-center">
                    {{-- <img src="{{ asset('storage/app/public/photos' . $disponibilite->chauffeur->photos) }}" alt="Photo du chauffeur" class="rounded-full w-32 h-32 object-cover"> --}}
                </div>
            </div>

            <!-- Section des commentaires et avis -->
            <div class="mt-8">
                <h2 class="text-xl font-bold mb-4">Commentaires et Avis</h2>
                <div class="space-y-4">
                    @foreach($disponibilite->comments as $comment)
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center mb-2">
                                {{-- <img src="{{ asset('storage/app/public/photos' . $comment->user->photo) }}" alt="Photo de l'utilisateur" class="w-8 h-8 rounded-full mr-3"> --}}
                                <div>
                                    <p class="font-semibold">{{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700">{{ $comment->comment }}</p>
                            <div class="flex items-center mt-2">
                                <!-- Affichage des étoiles -->
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $comment->rating)
                                        <span class="text-yellow-500">★</span> <!-- Étoile pleine -->
                                    @else
                                        <span class="text-gray-300">★</span> <!-- Étoile vide -->
                                    @endif
                                @endfor
                                <span class="ml-2 text-gray-700">{{ $comment->rating }}/5</span>
                            </div>

                                 <!-- Bouton de suppression -->
                @if(auth()->id() === $comment->user_id)
                <form action="{{ route('passager.destroy', $comment->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Supprimer
                    </button>
                </form>
            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <form action="{{ route('passager.ajouterComment', $disponibilite->id) }}" method="POST" class="mb-8">
                @csrf
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">Votre commentaire</label>
                    <textarea id="comment" name="comment" rows="3" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ajoutez un commentaire..." required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Note (sur 5)</label>
                    <div class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" onclick="setRating({{ $i }})" class="text-gray-300 hover:text-yellow-500 focus:outline-none">
                                ★
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" id="rating" name="rating" required>
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Soumettre
                </button>
            </form>
            
         


        </div>


        {{-- <div class="space-y-4">
            @if($passager->chauffeurComments->isNotEmpty())
                @foreach($passager->chauffeurComments as $comment)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('storage/app/public/photos' . $comment->chauffeur->photos) }}" alt="Photo du chauffeur" class="w-8 h-8 rounded-full mr-3">
                            <div>
                                <p class="font-semibold">{{ $comment->chauffeur->nom }} {{ $comment->chauffeur->prenom }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <p class="text-gray-700">{{ $comment->comment }}</p>
                        <div class="flex items-center mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $comment->rating)
                                    <span class="text-yellow-500">★</span> <!-- Étoile pleine -->
                                @else
                                    <span class="text-gray-300">★</span> <!-- Étoile vide -->
                                @endif
                            @endfor
                            <span class="ml-2 text-gray-700">{{ $comment->rating }}/5</span>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-700">Aucun commentaire pour le moment.</p>
            @endif
        </div> --}}
    </div>
</body>

<script>
    function setRating(rating) {
        document.getElementById('rating').value = rating;
        const stars = document.querySelectorAll('[onclick^="setRating"]');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-500');
            } else {
                star.classList.remove('text-yellow-500');
                star.classList.add('text-gray-300');
            }
        });
    }
</script>
</html>