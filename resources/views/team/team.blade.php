<x-app-layout> 
    <x-slot name="header">
        <!--<h2>-->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('イエツク！！') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('team.create') }}">
        @csrf

        <!-- familyName -->
        <div>
            <x-input-label for="familyName" :value="__('FamilyName')" />
            <x-text-input id="familyName" class="block mt-1 w-full" type="text" name="familyName" :value="old('familyName')" required autofocus autocomplete="familyName" />
            <x-input-error :messages="$errors->get('familyName')" class="mt-2" />
        </div>

        <!-- familyName -->
        <div class="mt-4">
            <x-input-label for="familyID" :value="__('familyName')" />
            <x-text-input id="familyID" class="block mt-1 w-full" type="text" name="familyID" :value="old('familyID')" required autocomplete="familyID" />
            <x-input-error :messages="$errors->get('familyID')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('登録') }}
            </x-primary-button>
        </div>
    </form>
    
</x-app-layout>