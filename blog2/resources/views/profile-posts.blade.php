{{--  
    Dynamic vlaues need : 
    like seending props in react
    Manully passing all needed varaibel fromthis direct blade to our component
    --}}
<x-profile doctitle="{{ $username }}'s Profile" :username="$username" :avatar="$avatar" :currentlyFollowing="$currentlyFollowing" :postCount="$postCount" :followerCount="$followerCount" :followingCount="$followingCount" > 
{{-- <x-profile :sharedData="$sharedData">  --}}
    <div class="list-group">
        @foreach ($posts as $post)
            <x-post :post="$post" hideAuthor/>
        @endforeach
    </div>
</x-profile>