<div class="bg-white p-4 sm:p-8 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("Installed modules")}}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Manage your installed modules.
        </p>
    </header>
    <form method="post" action="{{ route('settings.uninstall') }}" x-data="{ checkedItems: [] }" class="space-y-2">
        @csrf
        @method('delete')
        <div class="border rounded-md my-2">
            @foreach($modules as $module)
                <div x-data="" class="flex items-center p-2 hover:bg-gray-100 cursor-pointer"
                    @click="$el.querySelector('input').click()">
                    <input id="{{$module->name}}" type="checkbox" name="modules[]" value="{{$module->id}}" x-model="checkedItems"
                        class="w-4 h-4 text-purple-900 bg-gray-100 border-gray-300 rounded-sm focus:ring-purple-700 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{$module->name}}"
                        class="flex items-center gap-2 py-2 ms-4 text-sm font-medium text-gray-900 dark:text-gray-300"><x-dynamic-component
                            :component="$module->icon" class="w-6" />{{ucfirst($module->name)}}</label>
                </div>
            @endforeach
        </div>
        <x-input-error :messages="$errors->all()" />
        <x-danger-button x-data="" x-bind:disabled="checkedItems.length === 0"
            x-on:click.prevent="$dispatch('open-modal', 'modules-uninstall')">{{ __('Uninstall') }}</x-danger-button>

        <x-modal name="modules-uninstall" focusable>
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to remove those modules?') }}
                </h2>
                <div class="flex items-center">
                    <input id="modules-data" type="checkbox" name="modules-data" value="delete"
                        class="w-4 h-4 text-purple-900 bg-gray-100 border-gray-300 rounded-sm focus:ring-purple-700 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="modules-data"
                        class="flex items-center gap-2 py-2 ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Delete all data stored by modules?') }}</label>
                </div>
                <div class="mt-6 flex justify-end">
                    <x-secondary-button @click="$dispatch('close')">{{ __('Close') }}</x-secondary-button>
                    <x-danger-button class="ms-3">
                        {{ __('Uninstall') }}
                    </x-danger-button>
                </div>
            </div>
        </x-modal>

    </form>
</div>