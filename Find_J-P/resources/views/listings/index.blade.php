{{-- @extends("layout")

@section("content") --}}

<x-layout>

    @include("partials._hero")
    @include("partials._search")

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        {{-- Normal PHP <h1> <?php echo $heading; ?> </h1>  --}}
        {{-- <h1>{{ $heading }}</h1> Blade similar syntas to jsx and angular cleans up --}}

        {{-- MAny diffrent DIRECTIVES exp PHP usfull for filtering if its something you cant do in the controller or within your route --}}
        {{-- @php
            $test = 1;
        @endphp --}}

        {{-- {{ $test }} --}}

        {{-- CONDITIENALS  --}}
        @if (count($listings) == 0)
            <p> No listinings found</p>
        @endif

        @unless (count($listings) == 0)
            {{-- DIRECTIVES wher loops and conditionals and more can be used direcvtive start with @ --}}
            @foreach($listings as $listing)
                <x-listing-card :listing="$listing" /> 

            {{-- <h2>{{ $listing["title"] }}</h2>
                <a href="/listings/{{ $listing['id'] }}">{{ $listing["description"] }}</a> --}}
            @endforeach

            @else
                <p> No listinings found</p>
                
        @endunless
    </div>


    <div class="nt-6 p-4">
        {{ $listings->links() }}
    </div>
        {{-- Regulare PHP  --}}
        {{-- <?php foreach($listings as $listing): ?>
            <h2> <?php echo $listing["title"]?> </h2>
            <p> <?php echo $listing["description"]?> </p>
        <?php endforeach; ?> --}}


{{-- @endsection --}}

</x-layout>