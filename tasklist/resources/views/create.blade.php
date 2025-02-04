@extends("layouts.app")

@section("title", "Add Task")

@section("styles")
    <style>
        .errorMsg {
            color: red;
            font-size: 0, 8rem;
        }
    </style>
@endsection

@section("content")
    <form method="POST" action="{{ route("tasks.store") }}">
        @csrf
        <div class="mb-4">
            <label for="title">
                Title
            </label>
            <input text="text" name="title" id="title" value="{{ old("title") }}" 
                @class(['border-red-500' => $errors->has("title")])
                {{-- class="@error('title') border-red-500 @enderror border" --}}
            />
            @error('title')
                <p class="error">
                    {{ 
                        $message 
                    }}
                </p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description">
                description
            </label>
            <textarea text="text" name="description" id="description" rows="5" @class(['border-red-500' => $errors->has("description")])>
                {{ old("description") }}
            </textarea>
            @error('description')
                <p class="error">
                    {{ 
                        $message 
                    }}
                </p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description">
                long description
            </label>
            <textarea text="text" name="long_description" id="long_description" rows="10" @class(['border-red-500' => $errors->has("long_description")])>
                {{ old("long_description") }}
            </textarea>
            @error('long_description')
                <p class="error">
                    {{ 
                        $message 
                    }}
                </p>
            @enderror
        </div>

        <div class="flex gap-3 items-center justify-content-center">
            <button type="submit" class="btn"> Add task </button>
            <a href="{{ route('tasks.index') }}" class=".btn"> Cancel </a>
        </div>
    </form>
@endsection