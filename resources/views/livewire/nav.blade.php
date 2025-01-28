<div>
    <div class="flex sm:hidden items-center bg-slate-900 w-12 h-5 my-auto rounded-xl inset-0 py-4 ml-2 px-2 fixed -left-4"
        onclick="$('nav').show('slow');">
        <x-hugeicons-arrow-right-03 class="text-gray-200" />
    </div>
    <nav x-data="{ open: false }" class="hidden sm:flex bg-slate-900 min-h-max fixed w-10/12 sm:max-w-24">
        <!-- Primary Navigation Menu -->
        <div class="w-full sm:max-w-24 mx-auto px-4 sm:px-2 lg:px-4 min-h-screen">
            <div class="absolute flex justify-end sm:hidden text-gray-500 p-4 w-11/12" onclick="$('nav').hide('slow');">
                <x-hugeicons-cancel-01 />
            </div>
            <div class="flex justify-between h-16 flex-col min-h-screen">
                <!-- Logo -->
                <div class="flex justify-center pt-8 pb-4 border-gray-300 border-b">
                    <x-heroicon-s-home class="block h-9 w-auto fill-current text-gray-200" />
                </div>

                <!-- Navigation Links -->
                <div class="space-y-8 sm:-my-px flex flex-col">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <x-heroicon-s-home class="block h-9 w-auto fill-current dark:text-gray-200" />
                    </x-nav-link>

                    <x-nav-link :href="route('weather.index')" :active="request()->routeIs('weather.index')">
                        <x-fluentui-weather-cloudy-48 class="block h-9 w-auto fill-current dark:text-gray-200" />
                    </x-nav-link>
                </div>

                <!-- Settings Dropdown -->
                <div class="flex justify-center mb-4">
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        <x-hugeicons-user />
                    </x-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="inline-flex justify-center px-1 pt-1 text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 dark:text-gray-100 focus:outline-none transition duration-150 ease-in-out">
                            <x-hugeicons-logout-01 />
                        </button>
                    </form>
                </div>
            </div>
    </nav>

</div>