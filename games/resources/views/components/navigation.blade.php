<nav id="navigation">

    <div>
        GameOfWorld
    </div>

    <div>
        <ul>
            <li>
                <a href="{{ route('game.index') }}">
                    Games
                </a>
            </li>
        </ul>
    </div>

    <div>
        @auth
            <div class="flex justify-center gap-1">
                <a href="{{ route('auth.show', auth()->user()) }}" class="m-auto">
                    {{ auth()->user()->username }}
                </a>
                <div class="avatar">
                </div>
            </div>
        @else
            <div>
                <x-link-button :href="route('auth.create')">
                    Login
                </x-link-button>
            </div>
        @endauth
    </div>
    
</nav>