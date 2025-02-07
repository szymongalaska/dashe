<div class="bg-white p-4 sm:p-8 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __("Install modules")}}
            </h2>
        </header>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{__('If you wish to add new modules click on the button below and follow the instructions.')}}
        </p>
        <div class="flex justify-center mt-6">
            <x-button-link href="{{ route('install') }}">
                {{ __("Install modules") }}
            </x-button-link>
        </div>
    </section>
</div>