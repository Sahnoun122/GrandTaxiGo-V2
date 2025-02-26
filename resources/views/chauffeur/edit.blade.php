


<form method="POST" action="{{ route('chauffeur.update', $disponibilite->id) }}">
    @csrf
    @method('PATCH')

    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="col-span-2 sm:col-span-1">
            <label for="dateDebut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de début</label>
            <input type="date" name="dateDebut" id="dateDebut" value="{{ old('dateDebut', $disponibilite->dateDebut) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="dateFin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de fin</label>
            <input type="date" name="dateFin" id="dateFin" value="{{ old('dateFin', $disponibilite->dateFin) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="destination" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination</label>
            <input type="text" name="destination" id="destination" value="{{ old('destination', $disponibilite->destination) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Entrez la destination" required>
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="statut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
            <select name="statut" id="statut" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                <option value="active" {{ old('statut', $disponibilite->statut) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="desactive" {{ old('statut', $disponibilite->statut) == 'desactive' ? 'selected' : '' }}>Désactivé</option>
            </select>
        </div>
    </div>

    <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Modifier
    </button>
</form>
