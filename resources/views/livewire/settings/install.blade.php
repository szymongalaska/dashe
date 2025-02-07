<div class="w-11/12 sm:max-w-5xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 sm:shadow-md overflow-hidden rounded-lg">
    <header>
        <p class="text-sm text-right font-medium text-gray-600 dark:text-gray-300">
            {{ __("Select modules to install")}}
</p>
    </header>
    <form wire:submit="configure" class="my-4">
        <div class="flex flex-col space-y-6">
            @foreach ($modules as $module)
                @include($module->name . '.install', ['id' => $module->id])
            @endforeach

            <div class="flex justify-center">
                <x-primary-button class="mt-4">
                    {{ __('Install') }}</x-primary-button>
            </div>
    </form>
    <x-input-error :messages="$errors->all()" />
</div>