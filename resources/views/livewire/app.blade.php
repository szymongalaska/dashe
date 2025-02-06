<div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
    @persist('nav')
        <livewire:nav />
    @endpersist

    <main class="w-full mx-6 md:ml-24 md:mr-0" >
        {{ view($view) }}
    </main>
    <x-loader />
</div>