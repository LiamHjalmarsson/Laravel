<x-layout title="My Jobs">
    <x-breadcrumbs 
        :links="['My Jobs' => '#']" 
        class="mb-4"     
    />

    <div class="mb-8 text-right">
        <x-link-button href="{{ route('my-jobs.create') }}">
            Add new
        </x-link-button>
    </div>

    <div class="bg-slate-200">
        @forelse ($jobs as $job)
            <x-job-card :$job>
                <div class="text-sm text-slate-500">
                    @forelse ($job->jobApplications as $application)
                        <div class="mb-4 flex items-cemter justify-between">
                            <div>
                                <div>
                                    {{ $application->user->name }}
                                </div>
                                <div>
                                    Applied {{ $application->created_at->diffForHumans() }}
                                </div>
                                <div>
                                    Download CV
                                </div>
                            </div>
                            <div>
                                ${{ number_format($application->expected_salary)  }}
                            </div>
                        </div>
                    @empty
                        <div>
                            No applications  
                        </div>
                    @endforelse
                    <div class="flex space-x-2">
                        <x-link-button href="{{ route('my-jobs.edit', $job) }}">
                            Edit
                        </x-link-button>

                        @if (!$job->deleted_at) 
                            <form 
                                action="{{ route('my-jobs.destroy', $job) }}" 
                                method="POST"
                            >
                                @csrf
                                @method("DELETE")
                                <x-button>
                                    Delete
                                </x-button>
                            </form>

                        @else
                            <x-button>
                                Reopen
                            </x-button>
                        @endif
                    </div>
                </div>
            </x-job-card>
        @empty
            <div class="p-8">
                <div class="text-center font-medium">
                    No Jobs Created 
                </div>
                <div class="text-center">
                    Post your job 
                    <a 
                        href="{{ route('my-jobs.create') }}" 
                        class="text-indigo-400 underline"
                    > 
                        here 
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</x-layout>