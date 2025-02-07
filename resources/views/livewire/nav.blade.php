<div x-data="{ open: false }">
    <div class="md:hidden fixed w-8 m-4 z-40" @click="open = !open">
        <x-mdi-menu class="text-slate-800 dark:text-slate-200" />
    </div>
    <nav x-show="open" @click.away="open = false" x-transition x-cloak
        class="fixed z-50 flex bg-slate-900 h-full w-1/3 min-h-max">
        <div class="w-full mx-auto px-4">
            <div class="absolute flex justify-end md:hidden text-gray-500 p-4 w-11/12">
                <x-mdi-window-close class="w-6" @click="open = !open" />
            </div>
            @include('components.nav-menu-links')
        </div>
    </nav>
    <nav class="fixed z-50 hidden md:flex bg-slate-900 h-full w-1/3 max-w-24 min-h-max">
        <div class="w-full max-w-24 mx-auto px-4 px-2 lg:px-4 ">
            @include('components.nav-menu-links')
        </div>
    </nav>
</div>