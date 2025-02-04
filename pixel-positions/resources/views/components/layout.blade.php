<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel postions</title>
    @vite(['resources/js/app.js'])

</head>

<body class="text-slate-50 bg-slate-800">

    <header class="px-8 py-6 border-b border-slate-700">
        <nav class="flex justify-between items-center">
            <div>
                Logo
                <img src="{{ Vite::asset('recources/images/logo.png') }}" alt="" />
            </div>

            <ul class="flex space-x-6 font-bold">
                <li>
                    <a href="">Jobs</a>
                </li>
                <li>
                    <a href="">Careers</a>
                </li>
                <li>
                    <a href="">Salary</a>
                </li>
                <li>
                    <a href="">Companies</a>
                </li>
            </ul>

            @auth
                <div class="flex gap-x-6">
                    <a href="jobs/create">Post a job</a>
                    <form method="POST" action="/logout">
                        @csrf
                        @method("DELETE")
                        <button>Log out</button>
                    </form>
                </div>
            @endauth

            @guest
                <ul class="flex space-x-6 ">
                    <li>
                        <a href="/register">Register</a>
                    </li>
                    <li>
                        <a href="/login">Log in</a>
                    </li>
                </ul>
            @endguest
        </nav>
    </header>

    <main class="mt-10 px-10 max-w-5xl mx-auto">
        {{ $slot }}
    </main>
</body>

</html>
