@extends("layouts.app")

@section("title", "Edit Task")

@section("content")
    <form method="POST" action="{{ route("tasks.update", ['id' => $task->id]) }}">
        {{-- Directire method will add another data to bed sent, data, property or filed with the form --}}
        {{--  Called method spoofing --}}
        @method("PUT")
        @csrf
        <div class="mb-4">
            <label for="title">
                Title
            </label>
            <input text="text" name="title" id="title" value="{{ $task->title }}"/>
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
            <textarea text="text" name="description" id="description" rows="5">
                {{ $task->description }}
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
            <textarea text="text" name="long_description" id="long_description" rows="10">
                {{ $task->long_description }}
            </textarea>
            @error('long_description')
                <p class="error">
                    {{ 
                        $message 
                    }}
                </p>
            @enderror
        </div>

        <button type="submit" class="btn"> Edit task </button>
    </form>
@endsection