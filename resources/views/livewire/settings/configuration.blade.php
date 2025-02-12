<div x-data="{step: 0, redirect: false, items: {{ count($modules) - 1 }}}" @form-saved="
    if(redirect)
    window.location = '{{route('dashboard')}}'"
    class="flex flex-col justify-between w-11/12 sm:max-w-xl sm:my-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg space-y-6">
    <header>
        <p class="text-sm text-right font-medium text-gray-600 dark:text-gray-300">
            {{ __("Configuration")}}
        </p>

        <ol class="flex justify-center items-center w-full px-6 mt-4">
            @foreach($modules as $index => $module)
            <li @class([
                "w-full after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-300 after:border-4 after:inline-block dark:after:border-gray-700" => !$loop->last,
                'flex items-center text-purple-800 dark:text-purple-500'])>
                <span
                    class="flex items-center justify-center bg-gray-300 w-10 h-10 bg-white rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                    <template x-if="step > {{ $index }}">
                        <x-mdi-check class="h-5 lg:h-6"/>
                    </template>
                    <template x-if="step <= {{ $index }}">
                        <x-dynamic-component :component="$modulesIcons['weather']" x-bind:class="step < {{ $index }} ? 'h-5 lg:h-6 text-purple-400' : 'h-6 lg:h-8'"/>
                    </template>
                </span>
            </li>
            @endforeach
        </ol>

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