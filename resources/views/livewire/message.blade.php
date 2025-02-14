<div x-data="{ show: false }" x-cloak x-on:show-message.window="show = true; setTimeout(() => show = false, 3000)" x-show="show"
    x-transition class="fixed top-0 right-0 m-4 p-4 messages-container rounded-lg bg-slate-600 text-sm text-gray-200 dark:bg-slate-400 dark:text-gray-800">
    {{ $message }}
</div>