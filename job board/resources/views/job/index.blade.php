<x-layout>
    <x-breadcrumbs class="mb-4" 
        :links="['Jobs' => route('jobs.index')]"
    />

    {{-- x-data will inndicate that its a apline component --}}
    <x-card class="mb-4 text-sm" x-data=""> 

        <div class="mb-4">
            <x-button id="openFilters">
                Close Filter
            </x-button>
        </div>

        <form 
            {{-- x-ref="filters"  --}}
            id="filtering-form" 
            action="{{ route('jobs.index') }}" 
            method="GET"
        >
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">
                        Search
                    </div>
                    <x-text-input 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search for any text" 
                        {{-- form-ref="filters"  --}}
                        form-id="filtering-form" 
                    />
                </div>
                <div>
                    <div class="mb-1 font-semibold">
                        Salary
                    </div>
                    <div class="flex space-x-4">
                        <x-text-input 
                            name="min_salary" 
                            value="{{ request('min_salary') }}" 
                            placeholder="From" 
                            {{-- form-ref="filters"  --}}
                            form-id="filtering-form" 
                        />
                        <x-text-input 
                            name="max_salary" 
                            value="{{ request('max_salary') }}" 
                            placeholder="To" 
                            {{-- form-ref="filters"  --}}
                            form-id="filtering-form" 
                        />
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">
                        <x-radio-group 
                            name="experience" 
                            :options="array_combine(
                                array_map('ucfirst', \App\Models\Job::$experience),
                                \App\Models\Job::$experience,
                            )" 
                        />
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">
                        <x-radio-group 
                            name="category" 
                            :options="\App\Models\Job::$category" 
                        />
                    </div>
                </div>
            </div>

            <x-button class="w-full">
                Filter
            </x-button>
        </form>
    </x-card>

    @foreach ($jobs as $job)
        <x-job-card class="mb-4" :job="$job">
            <div class="flex justify-between text-center">
                <x-link-button :href="route('jobs.show', $job)">
                    Show More 
                </x-link-button>
            </div>
        </x-job-card>
    @endforeach

    {{-- <div>
        {{ $jobs }}
    </div> --}}
    
</x-layout>
