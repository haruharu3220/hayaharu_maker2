<x-app-layout>
    <x-slot name="header">
        <!--<h2>-->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('イエツク！！') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Home 画面</h1>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                test
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}{{ date('Y-m-d H:i:s') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
