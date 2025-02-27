<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nom" :value="__('nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="prenom" :value="__('prenom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="photos" :value="__('Photo')" />
            <x-text-input type="file" id="photos" class="block mt-1 w-full" name="photos" />
            <x-input-error :messages="$errors->get('photos')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full" required>
                <option value="passager" {{ old('role') == 'passager' ? 'selected' : '' }}>Passager</option>
                <option value="chauffeur" {{ old('role') == 'chauffeur' ? 'selected' : '' }}>Chauffeur</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>