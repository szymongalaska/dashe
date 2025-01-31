@if(session()->get('message'))
    <div x-init="setTimeout(() => { $el.remove(); }, 3500)" class="fixed top-0 right-0 m-4 p-4 messages-container rounded-lg bg-slate-600 text-sm text-gray-400">
        {{ session()->get('message') }}
    </div>
@endif