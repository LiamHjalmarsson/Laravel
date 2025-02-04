<x-layout title="Edit {{ auth()->user()->name }}">
    <x-card>
    
    <div class="flex justify-center gap-4">
        <h1 class="my-4 text-center text-4xl font-medium">
            {{ auth()->user()->name }}
        </h1>

        <div class="flex justify-center align-middle">
            <div class="bg-black w-1/4 h-10 rounded-full"></div>
        </div>
    </div>

        <form 
            action="{{ route('auth.update', auth()->user()) }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @method("PUT")
            @csrf

            <div class="mb-4">
                {{-- <div>
                    <button 
                        id="loginSettings-btn" 
                        type="button" 
                        class="bg-slate-400 p-4 rounded-md mb-4"
                    >
                        Login details
                    </button>
                </div> --}}

                <div id="loginSettings">
                    <div class="mb-4">
                        <x-label>
                            Current password
                        </x-label>
                
                        <x-text-input 
                            type="password"
                            name="password"
                        />
                    </div>
            
                    <div class="mb-4">
                        <x-label>
                            New password
                        </x-label>
                
                        <x-text-input 
                            type="new_password"
                            name="new_password"
                        />
                    </div>
                </div>
            </div>

            <div>
                {{-- <button onclick="" type="button" id="otherSettings-btn">
                    Other details
                </button> --}}

                <div id="otherSettings" class="hidden">
                    <div class="mb-4">
                        <x-label>
                            Name
                        </x-label>
                        <x-text-input 
                            type="name"
                            name="name"
                            value="{{ auth()->user()->name }}"
                        />
                    </div>
            
                    <div class="mb-4">
                        <x-label>
                            City
                        </x-label>
                        <x-text-input 
                            type="text"
                            name="city"
                        />
                    </div>
            
                    <div class="mb-4">
                        <x-label>
                            Avatar
                        </x-label>
                        <x-text-input 
                            type="file"
                            name="avatar"
                        />
                    </div>
                </div>
                
                <div class="mb-4 flex gap-4">
                    <x-button class="w-1/2">
                        Canel
                    </x-button>
                    <x-button class="w-1/2">
                        Update changes
                    </x-button>
                </div>
            </div>

        </form>
    </x-card>
</x-layout>