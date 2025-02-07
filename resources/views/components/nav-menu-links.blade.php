<div class="flex justify-between h-16 flex-col min-h-screen">
    <div class="flex justify-center pt-8 pb-4 border-gray-300 border-b">
        <x-mdi-monitor-dashboard class="block h-9 w-auto fill-current text-gray-300" />
    </div>

    <div class="space-y-8 sm:-my-px flex flex-col">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <x-mdi-home class="block h-9 w-auto fill-current" />
        </x-nav-link>

        @foreach($modules as $module)
            <x-nav-link :href='route("{$module->name}.index")' :active='request()->routeIs("{$module->name}.index")'>
                <x-dynamic-component :component="$module->icon" class="block h-9 w-auto fill-current" />
            </x-nav-link>
        @endforeach

        <x-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.index')">
            <x-mdi-cogs class="block h-9 w-auto fill-current" />
        </x-nav-link>
    </div>

    <div class="flex justify-center items-center mb-4">
        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
            <x-mdi-account class="w-6" />
        </x-nav-link>
        <form class="flex" method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="inline-flex justify-center px-1 pt-1 text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 dark:text-gray-100 dark:hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out">
                <x-mdi-logout class="w-6" />
            </button>
        </form>
    </div>
</div>