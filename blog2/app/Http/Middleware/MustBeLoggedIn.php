<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // next is how the equest passes throuth to the next layer 
        // if we do nothing nothing will happen
        // return $next($request);

        if (auth()->check()) {
            return $next($request);
        } else {
            return redirect("/")->with("failure", "You must be logged in");
        }
    }
}


// IF we want to use this in our routes we have to tell laravel that it exists 
// To do that we dig into the fil kernel.php within our http folder 