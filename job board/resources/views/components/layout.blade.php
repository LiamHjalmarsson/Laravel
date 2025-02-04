<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>{{ $title ?? "Job Board" }}</title>
        
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

    </head>
    <body class="bg-slate-700">
        {{-- 
            adding the output of a slot special variable inside the component 
            in the other normal blade files for every individual root the component can be used using <x-layout 
            and then inbettwen the to layouts opening and closing adding all the content will fill the slot 
        --}}

        <nav class="mb-8 py-5 px-5 w-full text-teal-100 flex justify-between text-lg font-medium">
            <p class="font-medium text-xl font-serif">
                BenchWorkers
            </p>
            <ul class="flex grow space-x-10 justify-center">
                <li>
                    <a href="{{ route('jobs.index') }}">
                        Jobs
                    </a>
                </li>
                @auth 
                    <li>
                        <a href="{{ route('my-jobs.index') }}">
                            My jobs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my-job-applications.index') }}">
                            Applications
                        </a>
                    </li>
                @endauth
            </ul>
            <ul class="text-slate-100 space-x-5 flex">
                @auth
                    <li>
                        <a href="{{ route('auth.edit', auth()->user()) }}" class=" text-teal-100">
                            Settings
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('auth.destroy') }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="text-teal-100">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('auth.create') }}" class="text-teal-100">
                            Sign in
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>

        <div class="mx-auto max-w-2xl"> 

            @if(session("success"))
                <div role="alert" class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
                    <p>
                        Success
                    </p>
                    <p>
                        {{ session('success') }}
                    </p>
                </div>
            @endif
            @if(session("error"))
                <div role="alert" class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
                    <p>
                        Error
                    </p>
                    <p>
                        {{ session('error') }}
                    </p>
                </div>
            @endif
            
            {{ $slot }}
        </div>

    </body>
</html>
