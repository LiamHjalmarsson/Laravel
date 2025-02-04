<div>
    <input 
        id="{{ $name }}"
        type="{{ $type }}" 
        name="{{ $name }}" 
        value="{{ old($name) }}"
        @class([
            "w-full rounded-md border-0 py-1.5 px-2.4 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2",
        ])
    />
    
    @error($name)
        <div class="mt-4 text-red-500 text-xs">
            {{ $message }}
        </div>
    @enderror
</div>