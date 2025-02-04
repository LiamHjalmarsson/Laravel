<x-profile doctitle="{{ $username }}'s Followings" :username="$username" :avatar="$avatar" :currentlyFollowing="$currentlyFollowing" :postCount="$postCount" :followerCount="$followerCount" :followingCount="$followingCount" > 
{{-- <x-profile :sharedData="$sharedData" >  --}}
    <div class="list-group">
        @foreach ($followings as $following)
            <a href="/post/{{ $following->userBeingFollowed->id }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ $following->userBeingFollowed->avatar }}" />
                {{ $following->userBeingFollowed->username }}
            </a>
        @endforeach
    </div>
</x-profile>