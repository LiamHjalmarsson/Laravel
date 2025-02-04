<x-layout>
    <div class="m-auto w-3/5">
        <x-card class="card py-10 px-10">
            <form action="{{ route('auth.store') }}" method="POST">
                @csrf
    
                <div class="mb-5">
                    <x-label for="username">
                        Username
                    </x-label>
                    <x-input type="text" name="username"/>
                </div>
    
                <div class="mb-5">
                    <x-label for="password">
                        Password
                    </x-label>
                    <x-input type="password" name="password"/>
                </div>
    
                <div class="mb-5 flex justify-between">
                    <div>
                        <a href="#"> Create Account! </a>
                    </div>
                    <div>
                        <x-label for="remember">
                            Remember Me
                        </x-label>
                        <x-input type="checkbox" name="remember"/>
                    </div>
                </div>

                <div class="text-center underline mb-5">
                    <a href="#"> Forgout Password! </a>
                </div>

                <div>
                    <x-button class="w-full mb-5">
                        Login
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>