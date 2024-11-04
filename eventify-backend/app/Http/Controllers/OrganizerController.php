<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO: Uncomment when events are implemented
        // TODO $events = Event::all();
        // TODO $organizer_events = Event::where('organizer_id', Auth::user()->id)->get();
        // TODO return view('organizer.organizer_view', compact('events', 'organizer_events'));

        return view('organizer.organizer_view');
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
