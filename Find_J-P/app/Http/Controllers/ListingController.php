<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Validated;

class ListingController extends Controller
{
    // Show get all listings
    public function index (Request $request) {

        // dd($request->tag);
        // dd(request("tag")); // helper 

        return view('listings.index', [
            // "heading" => "Latest listings",
            // "listings" => Listing::latest()->filter(request(["tag", "search"]))->get()
            "listings" => Listing::latest()->filter(request(["tag", "search"]))->paginate(6)
            // "listings" => Listing::latest()->filter(request(["tag", "search"]))->simplePaginate(2)
            // "listings" => Listing::all()
        ]);
    }

    // Show singel listing
    public function show (Listing $listing) {
        return view("listings.show", [
            "listing" => $listing
        ]);
    }

    // Show create form
    public function create () {
        return view("listings.create");
    }

    // store listing data 
    public function store (Request $request) { // dependency injection 

        // dd($request->file("logo"));

        $formFileds = $request->validate(
            [
                "title" => "required",
                "company" => ["required", Rule::unique("listings", "company")],
                "location" => "required",
                "website" => "required",
                "email" => ["required", "email"],
                "tags" => "required",
                "description" => "required",
            ]
        );

        if($request->hasFile('logo')) {
            $formFileds['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFileds["user_id"] = auth()->id(); // auth helper 

        Listing::create($formFileds);

        return redirect("/")->with("message", "Listing created successfully");
    }

    public function edit (Listing $listing) {
        return view("listings.edit", ["listing" => $listing]);
    }

    public function update (Request $request, Listing $listing) {

        // Make user logged in user is owner 

        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthoruzed Action");
        }
        $formFileds = $request->validate(
            [
                "title" => "required",
                "company" => "required",
                "location" => "required",
                "website" => "required",
                "email" => ["required", "email"],
                "tags" => "required",
                "description" => "required",
            ]
        );

        if($request->hasFile('logo')) {
            $formFileds['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFileds); // regulare method

        return back()->with("message", "Listing updated");
    }

    public function delete (Listing $listing) {

        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthoruzed Action");
        }
        
        $listing->delete();

        return redirect("/")->with("message", "Listing deleted");
    }

    // Manage Listings
    public function manage () {
        return view("listings.manage", [
            "listings" => auth()->user()->listings()->get()
        ]);
    }
}
