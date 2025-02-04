<x-layout title="Create user account">
    <h1 class="my-16 text-center text-4xl font-medium text-red-400">
        Create User Account
    </h1>

    <x-card class="py-8 px-16">
        <form 
            action="{{ route('user.store') }}" 
            method="POST"
        >
            @csrf

            <div class="mb-8">
                <x-label 
                    for="email" 
                    :required="true"
                >
                    Email
                </x-label>
                <x-text-input 
                    name="email" 
                    type="email"
                />
            </div>

            <div class="mb-8">
                <x-label 
                    for="name" 
                    :required="true"
                >
                    Name
                </x-label>
                <x-text-input 
                    name="name" 
                    type="name"
                />
            </div>

            <div class="mb-8">
                <x-label 
                    for="password" 
                    :required="true"
                >
                    Confirmed password
                </x-label>
                <x-text-input 
                    name="password" 
                    type="password"
                />
            </div>

            <x-button class="w-full bg-green-100">
                Create Account
            </x-button>
        </form>
    </x-card>
</x-layout>