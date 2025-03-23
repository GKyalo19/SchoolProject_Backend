<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events= Event::all();
        return view('events/event', compact('events'));
    }

    //create an Events
    public function createEvent(Request $request)
    {
        $request->validate([
            'classification_id'=>'required|integer|exists:classifications, id',
            'name'=>'required',
            'venue'=>'required',
            'description'=>'string',
            'startDate'=>'required|date',
            'endDate'=>'required|date',
            'hosts'=>'string',
            'sponsors'=>'string',
            'capacity'=>'integer',
        ]);

        $event = new Event();
        $event->classification_id = $request->classification_id;
        $event->name = $request->name;
        $event->venue = $request->venue;
        $event->description = $request->description;
        $event->startDate = $request->startDate;
        $event->endDate = $request->endDate;
        $event->hosts = $request->hosts;
        $event->sponsors = $request->sponsors;
        $event->capacity = $request->capacity;

        $event->save();

        $eventCheck = Event::find($event->id);

        return response()->json($eventCheck);
    }

    public function getEvents()
    {
        $event = Event::all();
        if ($event){
            return response()->json($event);
        }
        else {
            return response("No event was found");
        }
    }

    public function getEvent($id)
    {
        try {
            $event = Event::findOrFail($id);
            return response()->json($event);
        }
        catch (\Exception $e) {
            return response()->json([
                "error"=>"Event was not found with id: ", $id
            ], 404);
        }
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'classification_id'=>'required|integer|exists:classifications, id',
            'name'=>'required',
            'venue'=>'required',
            'description'=>'string',
            'startDate'=>'required|date',
            'endDate'=>'required|date',
            'hosts'=>'string',
            'sponsors'=>'string',
            'capacity'=>'integer',
        ]);
        try {
            $existingEvent = Event::findOrFail($id);
            if($existingEvent){
                $existingEvent->classification_id = $request->classification_id;
                $existingEvent->name = $request->name;
                $existingEvent->venue = $request->venue;
                $existingEvent->description = $request->description;
                $existingEvent->startDate = $request->startDate;
                $existingEvent->endDate = $request->endDate;
                $existingEvent->hosts = $request->hosts;
                $existingEvent->sponsors = $request->sponsors;
                $existingEvent->capacity = $request->capacity;

                return response()->json($existingEvent);
            }
            else {
                response()->json("Location not found with id: ",$id);
            }
        }
        catch (\Exception $e){
            return response()->json([
                "error"=>"Event could not be updated"
            ], 404);
        }
    }

    public function deleteEvent($id)
    {
        try {
            $existingEvent = Event::findOrFail($id);
            if ($existingEvent) {
                $existingEvent->delete();
                return response()->json([
                    "deleted" => $existingEvent
                ]);
            } else {
                return response("Menu does not exist");
            }
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Menu could not be deleted!"
            ], 403);
        }
    }
}


