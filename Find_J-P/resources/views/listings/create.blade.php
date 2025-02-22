<x-layout>

    {{-- Create Form Jobs  projects  --}}
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create a offer
            </h2>
            <p class="mb-4">Post deatils to find a empoliee</p>
        </header>

        <form action="/listings" method="POST" enctype="multipart/form-data">
            {{-- prevents cross-site scripting attacks stops ppl from being able 
            to have a form on theri website to submit to your endpoint  --}}
            @csrf 

            <div class="mb-6">
                <label for="company" class="inline-block text-lg mb-2">Company Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company" value="{{ old('company') }}"/>
                @error("company")
                    <p> 
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                    placeholder="Example: Senior Laravel Developer" value="{{ old('title') }}"/>
                @error("title")
                    <p> 
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="location" class="inline-block text-lg mb-2">Job Location</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                    placeholder="Example: Remote, Boston MA, etc" value="{{ old('location') }}"/>
                @error("location")
                    <p> 
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{ old('email') }}"/>
                @error("email")
                    <p> 
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">
                    Website/Application URL
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website" value="{{ old('website') }}"/>
                @error("website")
                    <p> 
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated)
                </label>

                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                    placeholder="Example: Laravel, Backend, Postgres, etc" value="{{ old('tags') }}"/>
                @error("tags")
                    <p> 
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>

                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />
        
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Job Description
                </label>

                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                    placeholder="Include tasks, requirements, salary, etc">
                    {{ old("title") }}
                </textarea>

                @error("description")
                    <p> 
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Create
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
