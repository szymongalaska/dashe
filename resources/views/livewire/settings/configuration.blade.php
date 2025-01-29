<div x-data="{step: 0, items: {{ count($modules) - 1 }}}"
    class="flex flex-col justify-between w-11/12 sm:max-w-xl sm:my-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg space-y-6">
    <header>
        <p class="text-sm text-right font-medium text-gray-900 dark:text-gray-100">
            {{ __("Configuration")}}
        </p>
    </header>
    @foreach($modules as $index => $module)
        <div x-show="step === {{ $index }}" x-trainsition class="flex flex-col justify-center">
            @include($module . '.configuration')
        </div>
    @endforeach
    <x-input-error :messages="$errors->all()" />

    <div class="mt-4 flex justify-center gap-4">
        <x-secondary-button @click="step--" x-cloak x-show="step > 0">{{ __('Previous') }}</x-secondary-button>
        <x-secondary-button @click="step++" x-cloak x-show="step < items">{{ __('Next') }}</x-secondary-button>
        <x-primary-button x-show="step === items">{{ __('Finish') }}</x-primary-button>
    </div>
</div>