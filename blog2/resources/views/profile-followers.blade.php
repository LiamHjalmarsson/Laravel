<x-profile doctitle="{{ $username }}'s Followers" :username="$username" :avatar="$avatar" :currentlyFollowing="$currentlyFollowing" :postCount="$postCount" :followerCount="$followerCount" :followingCount="$followingCount" > 
    <div class="list-group">
        @foreach ($followers as $follower)
            <a href="/profile/{{ $follower->userDoingTheFollowing->id }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ $follower->userDoingTheFollowing->avatar }}" />
                {{ $follower->userDoingTheFollowing->username }}
            </a>
        @endforeach
    </div>
</x-profile>