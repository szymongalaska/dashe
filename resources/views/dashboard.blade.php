<x-app-layout>
    <div class="py-16 md:py-12">
        <div class="flex flex-col lg:grid grid-cols-3 xl:grid-cols-4 lg:mx-8 auto-rows-auto gap-4 grid-flow-dense">
            @foreach($widgets->get() as $widget)
                    @livewire($widget->moduleName().'.widget', ['size' => $widget->size, 'configuration' => $widget->configuration])
            @endforeach
        </div>
    </div>
</x-app-layout>