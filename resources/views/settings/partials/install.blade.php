<div class="bg-white p-4 sm:p-8 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("Install modules")}}
        </h2>
    </header>
    <div class="text-center text-gray-900 dark:text-gray-100">
        If you wish to add new modules click on the button below and follow the instructions.
    </div>
    <div class="flex justify-center mt-4">
        <x-button-link href="{{ route('install') }}">
            {{ __("Install modules") }}
        </x-buttonb-link>
    </div>
</div>