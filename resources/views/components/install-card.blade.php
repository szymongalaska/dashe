<div>
    <input type="checkbox" id="{{ $id }}" value="{{ $id }}" wire:model="modulesToInstall" class="hidden peer">
    <label for="{{ $id }}"
        class="inline-flex items-center justify-between w-full sm:max-w-md p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-purple-800 dark:peer-checked:border-purple-800 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
        <div class="max-w-xl">
            {{ $slot }}
        </div>
    </label>
</div>