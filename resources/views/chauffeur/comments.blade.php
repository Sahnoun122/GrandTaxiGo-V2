{{-- @extends('Annonce')
@section('main') --}}



{{-- @extends('layouts.app') --}}

@section('content')
    <div class="container">
        <h1>Tableau de bord du Chauffeur</h1>
    </div>
@endsection


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyMatch Transport </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.7.0/chart.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Menu Burger pour mobile -->
    <button id="menuButton" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-800 text-white rounded">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path id="menuIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path id="closeIcon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Sidebar avec classe pour mobile -->
    <aside id="sidebar" class="fixed left-0 top-0 h-screen w-64 bg-gray-800 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
        <div class="p-4">
            <h2 class="text-2xl font-bold mb-6">lost and found</h2>
            <nav>
                <a href="{{ route('chauffeur.index') }}" class="block py-2 px-4 bg-gray-700 rounded mb-2">Tableau de bord</a>
                <a href=" {{ route('chauffeur.create') }} " class="block py-2 px-4 hover:bg-gray-700 rounded mb-2">create</a>
                <a href="{{ route('chauffeur.trajet') }}" class="block py-2 px-4 hover:bg-gray-700 rounded mb-2">trajets</a>
                <a href="{{route('chauffeur.comments')}}" class="block py-2 px-4 hover:bg-gray-700 rounded mb-2">comments</a>
                <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded mb-2">Évaluations</a>
            </nav>  
        </div>
    </aside>

    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-30 hidden lg:hidden"></div>

    <main class="lg:ml-64 p-8">
        <header method="post" class="bg-white shadow rounded-lg p-4 mb-6">
           

            @foreach($comments as $comment)
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-4">
                <div class="flex items-center mb-2">
                    {{-- <img src="{{ asset('storage/app/public/photos' . $comment->passager->photo) }}" alt="Photo du passager" class="w-8 h-8 rounded-full mr-3"> --}}
                    <div>
                        {{-- <p class="font-semibold">{{ $comment->passager->name }}</p> --}}
                        {{-- <p class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</p> --}}
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
        
                <!-- Formulaire de réponse -->
                <form action="{{ route('chauffeur.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <div class="mb-4">
                        <label for="reply" class="block text-sm font-medium text-gray-700">Votre réponse</label>
                        <textarea id="reply" name="reply" rows="2" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Répondre au commentaire..." required></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Répondre
                    </button>
                </form>
        
                <!-- Afficher les réponses -->
                @if($comment->replies->isNotEmpty())
                    <div class="mt-4 pl-6 border-l-2 border-gray-200">
                        @foreach($comment->replies as $reply)
                            <div class="bg-gray-100 p-3 rounded-lg mb-2">
                                <div class="flex items-center mb-2">
                                    <img src="{{ asset('storage/app/public/photos' . $reply->chauffeur->photos) }}" alt="Photo du chauffeur" class="w-6 h-6 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold">{{ $reply->chauffeur->nom }} {{ $reply->chauffeur->prenom }}</p>
                                        <p class="text-sm text-gray-500">{{ $reply->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $reply->reply }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
       