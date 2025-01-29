<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\EventAttendee;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportMail;
use Illuminate\Support\Facades\Log;

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
    private function generatePdf()
    {
        $event_attendees = EventAttendee::where('user_id', auth()->id())->with('event')->get();
        return PDF::loadView('reports.event_attendees_report', ['events' => $event_attendees]);
    }

    public function create()
    {
<<<<<<< Updated upstream
        $pdf = $this->generatePdf();
        return $pdf->stream();
    }

    /**
     * Downloads the PDF report of the events attended by the current logged user.
     */
    public function download()
    {
        $pdf = $this->generatePdf();
=======
        // Obtener los eventos de los asistentes para el usuario actual
        $event_attendees = EventAttendee::where('user_id', auth()->id())->with('event')->get();

        // Crear el PDF y configurar las opciones
        $pdf = PDF::loadView('reports.event_attendees_report', [
            'events' => $event_attendees,
        ])->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => false, // Deshabilitar imágenes remotas
            'chroot' => public_path(), // Limitar a `public/`
        ]);

        // Descargar el PDF
>>>>>>> Stashed changes
        return $pdf->download('report.pdf');
    }

    /**
     * Sends the PDF report to the authenticated user's email.
     */
    public function sendEmail()
    {
        $pdf = $this->generatePdf();
        $email = auth()->user()->email;

        Mail::to($email)->send(new ReportMail($pdf));

        return back()->with('success', 'PDF report sent to your email successfully.');

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
