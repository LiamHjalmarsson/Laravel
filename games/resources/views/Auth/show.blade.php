<x-layout>
    <div class="m-auto w-3/5">
        <x-card class="card">
            <h2 class="mb-4 text-center text-4xl font-medium text-red-400">
                {{ $user->username }}
            </h2>

            <div class="grid grid-cols-2 mb-4 gap-4 py-4">
                <div>
                    Email: {{ $user->email }}
                </div>
                <div>
                    Username: {{ $user->username }}
                </div>
                <div>
                    firstname: {{ $user->first_name }}
                </div>
                <div>
                    lastname: {{ $user->last_name }}
                </div>
            </div>

            <div class="flex justify-between">
                <div>
                    <x-link-button :href="route('auth.edit', $user)">
                        Edit Profile    
                    </x-link-button>
                </div>
                <div>
                    <form action="{{ route('auth.destroy', $user) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <x-button>
                            Logout   
                        </x-button>
                    </form>
                </div>
            </div>

        </x-card>
    </div>
</x-layout>