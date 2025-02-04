<x-layout title="{{ $job->title }}">
    <x-breadcrumbs class="mb-10" 
        :links="['Jobs' => route('jobs.index'), $job->title => '#']"
    />

    <x-job-card :$job>
        <p class="text-sm text-slate-500 mb-4">
            {{ $job->description }}
        </p>

        <div class="flex justify-between">
            <p class="text-slate-500 text-sm text-right">
                Contact: {{ $job->employer->user->email }}
            </p>
    
            @can("apply", $job)
                <x-link-button :href="route('job.application.create', $job)">
                    Apply
                </x-link-button>
            @else 
                
            <div class="text-sm font-medium text-slate-500">
                @auth
                        Already applied to this job
                    @else 
                        Sign in to Apply
                @endauth
            </div>    
            @endcan
        </div>
    </x-job-card> 
    
    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More jobs from {{ $job->employer->company_name }}
        </h2>
        <div class="text-sm text-slate-500">
            @foreach ($job->employer->jobs as $job)
                <div class="mb-4 flex justify-between">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{ route('jobs.show', $job)}}">
                                {{ $job->title }}
                            </a>
                        </div>
                        <div class="text-xs">
                            {{ $job->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div>
                        ${{ number_format($job->salary) }}
                    </div>
                </div>                
            @endforeach
        </div>
    </x-card>
</x-layout>