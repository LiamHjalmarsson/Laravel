<label
    class="mb-2 block text-sm font-medium text-slate-500"
    for="{{ $for }}"
>
    {{ $slot }}
    @if ($required)
        <span>
            *
        </span>
    @endif
</label>