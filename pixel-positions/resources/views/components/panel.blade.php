@php
    $classes = 'p-4 bg-slate-300/10 rounded-xl border border-transparent hover:border-blue-600 group transition-colors duration-300';
@endphp

<div {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</div>
