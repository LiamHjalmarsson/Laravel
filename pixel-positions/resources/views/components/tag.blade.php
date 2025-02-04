@props(["tag", 'size' => 'base'])


@php
    $classes = "bg-slate-100/10 rounded-xl transition-colors font-bold duration-300 hover:bg-slate-300/5 mx-0.5";

    if ($size == 'base') {
        $classes .= " px-5 py-1 text-sm";
    }

    if ($size == 'small') {
        $classes .= " px-3 py-1 text-2x";
    }
@endphp

<a href="" class="{{ $classes }}">
    {{ $tag->name }}
</a>