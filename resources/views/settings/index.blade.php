<x-app-layout>
    <div class="py-16 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('settings.partials.install')

            @if($installedModules->isNotEmpty())
                @include('settings.partials.installed', ['modules' => $installedModules])
            @endif
        </div>
    </div>
</x-app-layout>