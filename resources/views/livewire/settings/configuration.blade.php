<div x-data="{step: 0, redirect: false, items: {{ count($modules) - 1 }}}" @form-saved="
    if(redirect)
    window.location = '{{route('dashboard')}}'"
    class="flex flex-col justify-between w-11/12 sm:max-w-xl sm:my-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg space-y-6">
    <header>
        <p class="text-sm text-right font-medium text-gray-900 dark:text-gray-100">
            {{ __("Configuration")}}
        </p>
    </header>
    @foreach($modules as $index => $module)
        <div x-bind:class="step === {{ $index }} ? 'active' : ''" x-show="step === {{ $index }}" x-trainsition
            class="flex flex-col justify-center">
            @include($module . '.configuration')
        </div>
    @endforeach

    <div class="mt-4 flex justify-center gap-4">
        <x-secondary-button @click="submitForm(); step++" x-cloak
            x-show="step < items">{{ __('Next') }}</x-secondary-button>
        <x-primary-button @click="submitForm(); redirect = true;"
            x-show="step === items">{{ __('Install') }}</x-primary-button>
    </div>
</div>

<script>
    function submitForm() {
        document.querySelector('div.active form button').click();
    }
</script>