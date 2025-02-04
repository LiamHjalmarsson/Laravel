@extends("layouts.app")

@section("content")
    <h1 class="mb-10 text-2x1">
        Add Review for {{ $book->title }}
    </h1>

    <form method="POST" action="{{ route('books.reviews.store', $book) }}">
        @csrf
        <label for="review">
            Review
        </label>
        <textarea name="review" id="review" class="input mb-4">
        </textarea>

        @error('review')
            <div class="mb-4 text-red-500">
                {{ $message }}
            </div>
        @enderror

        <label for="rating">
            Rating
        </label>
        <select name="rating" id="rating" class="input mb-4">
            <option value="">
                Select a rating
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">
                        {{ $i }}
                    </option>
                @endfor
            </option>
        </select>

        @error('rating')
            <div class="mb-4 text-red-500">
                {{ $message }}
            </div>
        @enderror

        <button type="submit" class="btn">
            Add review
        </button>
    </form>
@endsection