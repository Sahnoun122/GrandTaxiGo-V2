<!-- resources/views/chauffeur/trajets.blade.php -->
{{-- @extends('layouts.app') --}}

{{-- @section('content')
    <div class="container">
        <h1>Tableau de bord du Chauffeur</h1>
    </div>
@endsection --}}


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
                <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded mb-2">Transactions</a>
                <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded mb-2">Évaluations</a>
            </nav>  
        </div>
    </aside>

    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-30 hidden lg:hidden"></div>

    <main class="lg:ml-64 p-8">
        <header method="post" class="bg-white shadow rounded-lg p-4 mb-6">
            <form class="max-w-md mx-auto" action="{{ route('chauffeur.index') }}" >  
                @csrf 
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="default-search" name="search"  class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher par titre, lieu ou catégorie..." required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Recherchers</button>
                </div>
            </form>

{{-- @section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Mes trajets</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-6">
            {{ session('error') }}
        </div>
    @endif
    @endsection --}}


    
    <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
        <thead>
            <tr>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Date</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Lieu de départ</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Destination</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Passager</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Statut</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Actions</th>
            </tr>
        </thead>

        
        <tbody>
            @foreach($trajets as $trajet)
                <tr>
                    <td class="px-6 py-4">{{ $trajet->date }}</td>
                    <td class="px-6 py-4">{{ $trajet->lieu }}</td>
                    <td class="px-6 py-4">{{ $trajet->destination }}</td>
                    <td class="px-6 py-4">{{ $trajet->passager->nom ?? 'Passager indisponible' }}</td>
                    <td class="px-6 py-4">{{ ucfirst($trajet->statut) }}</td>
                    <td class="px-6 py-4">
                        @if($trajet->statut == 'en attente')
                            <form action="{{ route('trajet.accept', $trajet->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Accepter
                                </button>
                            </form>
        
                            <form action="{{ route('trajet.refuse', $trajet->id) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Refuser
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500">{{ ucfirst($trajet->statut) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
