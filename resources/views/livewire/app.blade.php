<div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
    @persist('nav')
        <livewire:nav />
    @endpersist

    <main class="w-full mx-6 sm:ml-24 sm:mr-0" >
        {{ view($view) }}
    </main>
    <x-loader />
</div>