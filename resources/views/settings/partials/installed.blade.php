<div class="bg-white p-4 sm:p-8 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("Installed modules")}}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Manage your installed modules.
        </p>
    </header>
    <div class="border rounded-md my-2">
            @foreach($modules as $module)
                <div class="flex items-center p-2 hover:bg-gray-100 cursor-pointer" @click="$event.target.querySelector('input').click();">
                    <input id="{{$module->name}}" type="checkbox" value=""
                        class="w-4 h-4 text-purple-900 bg-gray-100 border-gray-300 rounded-sm focus:ring-purple-700 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{$module->name}}"
                        class="flex items-center gap-2 py-2 ms-4 text-sm font-medium text-gray-900 dark:text-gray-300"><x-dynamic-component
                            :component="$module->icon" class="w-6" />{{ucfirst($module->name)}}</label>
                </div>
            @endforeach
    </div>
</div>