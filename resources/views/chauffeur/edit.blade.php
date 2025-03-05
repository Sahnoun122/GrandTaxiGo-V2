

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
                <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded mb-2">Transactions</a>
                <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded mb-2">Évaluations</a>
            </nav> 
        </div>
    </aside>

    <!-- Overlay pour mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-30 hidden lg:hidden"></div>

    <!-- Main Content avec ajustement responsive -->
    <main class="lg:ml-64 p-8">
        <!-- Header -->
        <header method="post" class="bg-white shadow rounded-lg p-4 mb-6">
      
            <form method="POST" action="{{ route('chauffeur.update', $disponibilite->id) }}">
                @csrf
                @method('PATCH')
            
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <!-- Date de début -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="date_debut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de début</label>
                        <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $disponibilite->date_debut) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
            
                    <!-- Date de fin -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="date_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de fin</label>
                        <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $disponibilite->date_fin) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
            
                    <!-- Heure -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="heure" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heure</label>
                        <input type="time" name="heure" id="heure" value="{{ old('heure', \Carbon\Carbon::parse($disponibilite->heure)->format('H:i')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
            
                    <!-- Destination -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="destination" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination</label>
                        <input type="text" name="destination" id="destination" value="{{ old('destination', $disponibilite->destination) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez la destination" required>
                    </div>
            
                    <!-- Statut -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="statut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
                        <select name="statut" id="statut" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="active" {{ old('statut', $disponibilite->statut) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="desactive" {{ old('statut', $disponibilite->statut) == 'desactive' ? 'selected' : '' }}>Désactivé</option>
                        </select>
                    </div>
                </div>
            
                <!-- Bouton de soumission -->
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Modifier
                </button>
            </form>