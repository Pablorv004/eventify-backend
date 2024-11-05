<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Rules\ValidEvent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentCategory = $request->input('category', 'organizer');
        $page = $request->input('page', 1);

        if ($currentCategory == 'organizer') {
            $events = Event::where('organizer_id', Auth::user()->id)->where('deleted', 0)->paginate(5, ['*'], 'page', $page);
        } else {
            $category = Category::where('name', ucfirst($currentCategory))->first();
            if ($category) {
                $events = Event::where('category_id', $category->id)->where('deleted', 0)->paginate(5, ['*'], 'page', $page);
            } else {
                $events = collect();
            }
        }

        $categories = Category::all();

        return view('events.organizer_view', compact('events', 'currentCategory', 'categories'));
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
            'event' => [new ValidEvent],
        ]);

        $event = Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
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
            'event' => [new ValidEvent],
        ]);

        $event->update($request->all());

        return redirect()->route('events.index', $event->organizer_id)->with('success', 'Event updated successfully.');
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
