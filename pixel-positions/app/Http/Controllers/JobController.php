<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request; 
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(["employer", "tags"])->get()->groupBy("featured");
        $tags = Tag::all();

        return view("jobs.index", [
            "jobs" => $jobs[0],
            "featuredJobs" => $jobs[1],
            "tags" => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("jobs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            "title" => ["required"],
            "salary" => ["required"],
            "location" => ["required"],
            "type" => ["required", Rule::in(["Remote", "Hybrid", "On site"])],
            "schedule" => ["required", Rule::in(["Full time", "half time", "Extra"])],
            "url" => ["required", "url"],
            "tags" => ["nullable"]
        ]);

        $attributes["featured"] = $request->has("featured");

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, "tags"));

        if ($attributes["tags"] ?? false) {
            foreach (explode(",", $attributes["tags"]) as $tag ) {
                $job->tag($tag);
            }
        }

        return redirect("/");
    }

}
