@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Historique de mes trajets</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
        <thead>
            <tr>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Date</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Lieu de départ</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Destination</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Chauffeur</th>
                <th class="px-6 py-4 border-b text-left text-sm font-medium text-gray-900">Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trajets as $trajet)
                <tr>
                    <td class="px-6 py-4">{{ $trajet->date }}</td>
                    <td class="px-6 py-4">{{ $trajet->lieu }}</td>
                    <td class="px-6 py-4">{{ $trajet->destination }}</td>
                    <td class="px-6 py-4">{{ $trajet->disponibilite->chauffeur->nom ?? 'Chauffeur indisponible' }}</td>
                    <td class="px-6 py-4">{{ ucfirst($trajet->statut) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
