<div class="relative">

    @if ("textarea" !== $type)
        
        @if ($formId)
        {{-- @if ($formRef) --}}
            <button 
                type="button"
                class="absolute top-0 right-0 flex h-full items-center pr-2" 
                {{-- onclick="document.getElementById('{{ $name }}').value = ''; document.getElementById('{{ $formId }}').submit();" --}}
                {{-- @click="$refs['input-{{ $name }}'].value = ''; $refs['{{ $formRef }}'].submit();" --}}
                data-input-name="{{ $name }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-slate-500">
                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                </svg>
            </button>
        @endif

        <input 
            {{-- x-ref="input-{{ $name }}" --}}
            type="{{ $type }}" 
            placeholder="{{ $placeholder }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"    
            id="{{ $name }}"
            @class([
                "w-full rounded-md border-0 py-1.5 px-2.4 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2",
                "pr-8" => $formId, 
                'ring-slate-300' => !$errors->has($name),
                'ring-red-300' => $errors->has($name),
            ])
        />
    @else
        <textarea 
            id="{{ $name }}" 
            name="{{ $name }}" 
            @class([
                'w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2',
                'pr-8' => $formId,
                'ring-slate-300' => !$errors->has($name),
                'ring-red-300' => $errors->has($name),
            ])
        >
            {{ old($name, $value) }}
        </textarea>
    @endif

    @error($name)
        <div class="mt-4 text-red-500 text-xs">
            {{ $message }}
        </div>
    @enderror
</div>
