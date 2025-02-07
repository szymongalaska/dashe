<x-guest-layout >
<div class="flex flex-row gap-2 justify-center">
    <a class="px-4 py-2 w-36 text-center bg-purple-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('login') }}">
        {{__('Login')}}
    </a>
    <a class="px-4 py-2 w-36 text-center bg-purple-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('register') }}">
        {{__('Register')}}
    </a>
</div>
</x-guest-layout>