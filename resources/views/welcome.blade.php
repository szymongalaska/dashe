<x-configuration-layout>
    <div
        class="flex flex-col justify-between items-center w-11/12 sm:max-w-xl sm:my-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg space-y-6">
        <p class="text-sm">Before you can use Dashe you have to configure your dashboard. First pick which modules you
            want to use and then configure them.</p>
        <a class="w-2/12 flex justify-center" href="{{ route('install') }}"><x-primary-button>{{ __('Begin') }}</x-primary-button></a>
    </div>
</x-configuration-layout>