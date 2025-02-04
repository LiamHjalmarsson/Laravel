<x-layout>
    <div class="m-auto w-4/5">
        @foreach ($games as $game)
            <x-card class="mb-4">
                <div class="grid grid-cols-2 space-x-4">
                    <div>
                        <h2 class="text-center font-medium mb-4">
                            {{ $game->title }}
                        </h2>
                        <div>
                            {{ $game->description }}
                        </div>
                        <div>
                            {{ $game->type }}
                        </div>
                    </div>
                    <div>
                        <img src="{{ $game->image }}" alt="" class="w-25 h-100">
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
</x-layout>
