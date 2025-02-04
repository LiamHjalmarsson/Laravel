<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{

    use CanLoadRelationships;
    /**
     * Display a listing of the resource.
     */

    // middleware 

    public function __construct()
    {
        // which actions should be protected 
        $this->middleware("auth:sanctum")->except("index", "show");

        // which controller method, what policy method will be called to verify if this user is able to perform a specific operation
        $this->authorizeResource(Event::class, "event");


        // throttle 
        $this->middleware("api")->only("store", "destroy", "update");
    }

    private $relations = [
        "user",
        "attendees",
        "attendes.user"
    ];

    public function index()
    {
        // return response()->json(Event::all());
        // Event Resource controlling json response 
        // the response changes not an array like before and have a data property
        // api resources allow to have more filed to add some kind of meta fileds 

        // can customize 
        // can be used to hide attributes 
        // build nested resources insied eventes 
        // return EventResource::collection(Event::all());

        // $relations = [
        //     "user",
        //     "attendees",
        //     "attendes.user"
        // ]; // what can be loaded

        $query = $this->loadRelationships(Event::query());
        // $query = $this->loadRelationships(Event::query(), $relations);

        // return EventResource::collection(Event::with("user")->paginate());
        return EventResource::collection($query->paginate());
    }

    // helper method
    // protected function shouldIncludeRelation(string $relation): bool {
    //     $include = request()->query(("include"));

    //     if (!$include) {
    //         return false;
    //     }

    //     $relations = array_map("trim", explode(",", $include));

    //     return in_array($relation, $relations);
    // }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->validate(
        //     [
        //         "name" => "required|string",
        //         "description" => "nullable|string",
        //         "start_time" => "required|date",
        //         "end_time" => "required|date|after:start_time",
        //     ]
        // );

        $event = Event::create([
            ...$request->validate(
                [
                    "name" => "required|string",
                    "description" => "nullable|string",
                    "start_time" => "required|date",
                    "end_time" => "required|date|after:start_time",
                ]
                ),
            "user_id" => $request->user()->id
        ]);

        // new instanve of an event recourse 
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // return response()->json($event);
        // $event->load("user", "attendees");
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {

        // if (Gate::denies("update-event", $event)) {
        //     abort(403, "You are not authroized to to update this event.");
        // }

        // this is samething as above
        // $this->authorize("update-event", $event);

        $event->update(
            $request->validate([
                "name" => "sometimes|string",
                "description" => "nullable|string",
                "start_time" => "sometimes|date",
                "end_time" => "sometimes|date|after:start_time",
            ])
        );

        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        // return response(status: 204);
        return response()->json(
            [
                "message" => "Event was successfully deleted"
            ], 204
        );
    }
}
