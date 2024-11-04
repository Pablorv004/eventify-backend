<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Rules\ValidEvent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizer_events = Event::where('organizer_id', Auth::user()->id)->where('deleted', 0)->paginate(5);
        $music_events = Event::where('category_id', 1)->where('deleted', 0)->paginate(5);
        $sport_events = Event::where('category_id', 2)->where('deleted', 0)->get();
        $tech_events = Event::where('category_id', 3)->where('deleted', 0)->get();
        return view('events.organizer_view', compact('organizer_events', 'music_events', 'tech_events', 'sport_events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event = null)
    {
        $categories = Category::all();
        return view('events.form', compact('categories', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event' => ['required', new ValidEvent],
        ]);

        $event = Event::create($request->all());

        return redirect()->route('organizer.view', $event->organizer_id)->with('success', 'Event created successfully.');
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
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('events.form', compact('categories', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event' => ['required', new ValidEvent],
        ]);

        $event->update($request->all());

        return redirect()->route('organizer.view', $event->organizer_id)->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->deleted = 1;
            $event->save();
            return redirect()->back()->with('success', 'Event deleted successfully');
        }
        return redirect()->back()->with('error', 'Event not found');
    }
}
