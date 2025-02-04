@extends('layouts.app')


@section("title", "The list of tasks")

@section('content')

    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}" class="link">
            Add Task!
        </a>
    </nav>
    @foreach ($tasks as $task)
        <div>
            {{-- Class diretive --}}
            <a href="{{ route("tasks.show", ["id" => $task->id]) }}" @class(['line-through' => $task->completed])> 
            {{ $task->title }}
            </a>
        </div>
    @endforeach

    @if($tasks->count()) 
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection