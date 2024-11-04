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
        $events = Event::All();
        $organizer_events = Event::where('organizer_id', Auth::user()->id)->paginate(5);
        $music_events = Event::where('category_id', 1)->get();
        $tech_events = Event::where('category_id', 2)->get();
        $sport_events = Event::where('category_id', 3)->get();
        $categories = Event::select('category_id')->distinct()->get();
        $organizers = User::where('role', 'o')->get();
        return view('events.organizer_view', compact('events', 'organizer_events', 'music_events'));
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
    public function destroy(string $id)
    {
        //
    }
}
