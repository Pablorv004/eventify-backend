<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\EventAttendee;

class UserController extends Controller
{
    /**
     * Display a listing of events based on the current user's preferences.
     *
     * This method retrieves events for the current logged-in user based on the selected category.
     * It excludes events that the user is already registered for, unless the user specifically
     * requests to see only the events they are registered for.
     *
     * @param \Illuminate\Http\Request $request The HTTP request instance (Current category is recovered through this).
     * 
     */
    public function index(Request $request)
    {
        // Events_attendees of the current logged user
        $event_attendees = EventAttendee::where('user_id', auth()->id())->with('event')->get();

        // Ids of the events that the user is already registered for
        $registeredEventIds = EventAttendee::where('user_id', auth()->id())
        ->pluck('event_id')
        ->toArray();

        // Current category selected by the user
        $currentCategory = $request->input('category', 'all');

        // Current page (for paginator)
        $page = $request->input('page', 1);

        if ($currentCategory == 'all') {
            // Exclude events that the user is already registered for
            $events = Event::where('start_date', '>', now())
                ->whereNotIn('id', $registeredEventIds)
                ->paginate(5, ['*'], 'page', $page);
                
        } else if ($currentCategory == 'user') {
            // Send to the view only the events that the user is registered for
            $events = EventAttendee::where('user_id', auth()->id())->with('event')->get();

        // If the code enters this else block, it means that he has selected a specific category
        } else {
            // Get category by name
            $category = Category::where('name', ucfirst($currentCategory))->first();
            
            if ($category) {
                // Get only events that have not started from the selected category, excluding the ones that the user is already registered for 
                $events = Event::where('category_id', $category->id)
                    ->where('deleted', 0)
                    ->where('start_date', '>', now())
                    ->whereNotIn('id', $registeredEventIds)
                    ->paginate(5, ['*'], 'page', $page);
            } else {
                $events = collect();
            }
        }

        $categories = Category::all();

        return view('users.user_view', compact('events', 'currentCategory', 'categories'));
    }

    /**
     * Register the user to an event.
     */
    public function registerEvent($eventId)
    {
        $eventAttendee = new EventAttendee();
        $eventAttendee->event_id = $eventId;
        $eventAttendee->user_id = auth()->id();
        $eventAttendee->status = 'registered';
        $eventAttendee->registered_at = now();
        $eventAttendee->save();

        return redirect()->back()->with('success', 'You have successfully registered for the event.');
    }

    /**
     * Unregister the user from an event.
     */
    public function unregisterEvent($eventId)
    {
        $eventAttendee = EventAttendee::where('event_id', $eventId)
            ->where('user_id', auth()->id())
            ->first();

        if ($eventAttendee) {
            $eventAttendee->delete();
            return redirect()->back()->with('success', 'You have successfully unregistered from the event.');
        }

        return redirect()->back()->with('error', 'You are not registered for this event.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
