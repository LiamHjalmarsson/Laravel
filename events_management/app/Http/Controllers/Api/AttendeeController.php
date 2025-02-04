<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    use CanLoadRelationships;

    private array  $relations = ["user"];

    // Gates to work with controllers and recourses and gates are often used best for something
    // thats nott tied to a specific database model or a specific recourse model like gates are good for some kind of generic premission checking or simple cases like this 
    public function __construct()
    {
        // which actions should be protected 
        $this->middleware("auth:sanctum")->except("index", "show", "update");

        // which controller method, what policy method will be called to verify if this user is able to perform a specific operation
        $this->authorizeResource(Attendee::class, "attendee");

        $this->middleware("throttle:60,1")->only("store", "destroy");

    }

    // attendees cant exists on their own always part of a specific event 
    public function index(Event $event) // can fetch event since its part of the url 
    {
        // pagination 
        // $attendees = $event->attendees()->latest();


        $attendees = $this->loadRelationships(
            $event->attendees()->latest()
        );

        return AttendeeResource::collection(
            // create simple paginator to generate html for balde but also works for api 
            // gives us diffrent keys and values in the response with pages links etc 
            $attendees->paginate()
        );
    }

    public function store(Request $request, Event $event)
    {
        $attendee = $this->loadRelationships(
            $event->attendees()->create(
                [
                    "user_id" => $request->user()->id
                ]
            )
        );

        return new AttendeeResource($attendee);
    }

    public function show(Event $event, Attendee $attendee)
    {
        // return new AttendeeResource($attendee);
        return new AttendeeResource(
            $this->loadRelationships($attendee)
        );
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Event $event, Attendee $attendee)
    {
        // $this->authorize("delete_attendee", [$event, $attendee]);

        $attendee->delete();

        return response(status: 204);
    }
}


// User autentication to api
// specifice need s when worikg with apis 
    // a bit different with apis tah with noraml websites 
// LARAVEL SANCTUM 


// revoking tokens 