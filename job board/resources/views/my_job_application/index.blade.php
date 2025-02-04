<x-layout title="My Applications">
    <x-breadcrumbs 
        class="mb-4"
        :links="['My Job Applications' => '#']" 
    />

    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-sm text-slate-500">
                <div>
                    <div>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </div>
                    <div>
                        Applications : {{ Str::plural("applicant", $application->job->job_job_applications_count - 1) }}
                        {{ $application->job->job_applications_count - 1 }}
                    </div>
                    <div>
                        Asking salary : ${{ number_format($application->expected_salary) }}
                    </div>
                    <div>
                        Average salary : ${{ number_format($application->job->job_applications_avg_expected_salary) }}
                    </div>
                </div>
                <div>
                    <form 
                        action="{{ route('my-job-applications.destroy', $application) }}" 
                        method="POST"
                    >
                        @csrf
                        @method("DELETE")

                        <x-button>
                            Cancel
                        </x-button>

                    </form>
                </div>
            </div>
        </x-job-card>

    @empty
        <div class="rounded-md border border-slate-300 p-8 bg-slate-300">
            <div class="text-center font-medium">   
                You got no job applications
            </div>
            <div class="text-center">
                Find your future 
                <a 
                    href="{{ route('jobs.index') }}" 
                    class="text-medium text-indigo-500"> 
                        job 
                </a>
            </div>
        </div>
    @endforelse
</x-layout>