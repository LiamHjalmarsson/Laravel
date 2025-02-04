<x-layout :doctitle="$post->title">
    <div class="container py-md-5 container--narrow">
        <div class="d-flex justify-content-between">
            <h2>
                {{ $post->title }}
            </h2>

            {{-- wrapp this in som conditinol check with the policy Only display this if you have premission --}}
            {{-- 
                We saying if current user can update the post -> go to postPolicy file
                this will call the update function in the post policy and it recieves everything it nee to make that decision
                It recives the current blog post and question it also recivning the current user 

                and it will run the comperision andreturn either true or false 


                The policy can be used from all angels the blade template or from the controller or from the router middelware angel

            --}}
            @can("update", $post)
                <span class="pt-2">
                    <a href="/post/{{ $post->id }}/edit" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i
                            class="fas fa-edit"></i></a>
                    <form class="delete-post-form d-inline" action="/post/{{ $post->id }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top"
                            title="Delete"><i class="fas fa-trash"></i></button>
                    </form>
                </span>
            @endcan 
        </div>

        <p class="text-muted small mb-4">
            <a href="/profile/{{ $post->user->username }}"><img class="avatar-tiny" src="{{ auth()->user()->avatar }}"/></a>
            Posted by <a href="/profile/{{ $post->user->username }}">
                {{--  
                    Becuase we returned a relationsip in the funcion laravel is going to give us that instance of a user 
                    Like a oject that metaphorically represnets the correct user 
                    Can look inside that for whatever prperty we want
                --}}
                {{ $post->user->username }}
            </a> {{ $post->created_at->format('n/j/y') }}
        </p>

        <div class="body-content">
            {{ $post->body }}
        </div>
    </div>
</x-layout>
