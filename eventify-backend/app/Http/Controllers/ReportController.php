<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\EventAttendee;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function createReport()
    {
        // Events_attendees of the current logged user
        $event_attendees = EventAttendee::where('user_id', auth()->id())->with('event')->get();

        // Get the events from the event_attendees
        $events = $event_attendees->map(function ($attendee) {
            $event = $attendee->event;
            $event->registered_at = $attendee->registered_at;
            return $event;
        });

        $pdf = PDF::loadView('reports.event_attendees_report', ['events' => $events]);

        // Create PDF in web browser
        return $pdf->stream();

        // Download PDF
        // return $pdf->download('prueba.pdf');

    }
}
