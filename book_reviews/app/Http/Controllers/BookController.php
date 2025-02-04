<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     * // all the books 
     */
    public function index(Request $request) // typhinting 
    {
        $title = $request->input("title");

        $filter = $request->input("filter", "");

        // when mehotd passa first argunemt tex title, secoung argument is a function/closure/arrow function
        // what the function would do is if title is not null/empety it will run the function 
        $books = Book::when($title, function ($query, $title) {
            return $query->title($title);
        });


        // match is simullar to switch but diffrence is that it lets you return a  value 
        $books = match($filter) { 
            "popular_last_month" => $books->popularLastMonth(),
            "popular_last_6months" => $books->popularLast6Months(),
            "highest_rated_last_month" => $books->highestRatedLastMonth(),
            "highest_rated_last_6months" => $books->highestRatedLast6Months(),
            default => $books->latest()->withAvgRating()->withReviewsCount()
        };

        // $books = $books->get();

        // with cache come up with unique keys that will contain all variables that can have influence on the result of the cache
        // $books = Cache::remember("books", 3600, fn() => $books->get());
        $chacheKey = "books:" . $filter . ":" . $title;
        $books = cache()->remember($chacheKey , 3600, fn() => $books->get());

        return view("books.index", ["books" => $books]); // Use the same convention of tempaltes as the route names
    }


    // SCOPING RESOURCE ROUTES 
    
    /**
     * Show the form for creating a new resource.
     * show form to create a book  
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * Handels the form of creating the book 
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * show one book
     */
    public function show(int $id)
    {

        $chacheKey = "book" . $id;

        $book = cache()->remember(
            $chacheKey, 
            3600, 
            fn() => Book::with([
                "reviews" => fn ($query) => $query->latest()
            ])->withAvgRating()->withReviewsCount()->findOrFail($id)
        );

        return view("books.show", 
            ["book" => $book]
        );

        // this only make a diffrence to the lazyloading if you would have 100 or 50 books or at least more than one
        // lazy loading would just run a sepreate query 
        // return view("books.show", 
        //     ["book" => $book->load([
        //         // load condintiall relations sort filter etc 
        //         "reviews" => fn ($query) => $query->latest()
        //     ])]
        // );
    }

    /**
     * Show the form for editing the specified resource.
     * show form for editing a book
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
