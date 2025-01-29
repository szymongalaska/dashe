@props(['messages'])

@if ($messages)
    <div x-init="messages = {{ count($messages) > 0 }}">
        @teleport('.messages-container')
        <ul {{ $attributes->merge(['class' => 'text-sm text-right text-red-600 dark:text-red-400 space-y-1']) }}>
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endteleport
    </div>
@endif