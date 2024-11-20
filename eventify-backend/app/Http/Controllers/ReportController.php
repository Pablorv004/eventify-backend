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
     * Creates a PDF report of the events attended by the current logged user.
     */
    public function create()
    {
        // Events_attendees of the current logged user
        $event_attendees = EventAttendee::where('user_id', auth()->id())->with('event')->get();

        $pdf = PDF::loadView('reports.event_attendees_report', ['events' => $event_attendees]);

        // Create PDF in web browser
        // return $pdf->stream();

        // Download PDF
        return $pdf->download('report.pdf');
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
