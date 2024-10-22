<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ActivationEmail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Método para mostrar la vista de administrador
    public function index()
    {
        // Obtener todos los usuarios de la base de datos
        $users = User::all();

        // Pasar los usuarios a la vista
        return view('admin.admin_view', compact('users'));
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

    public function toggleUserStatus(int $id){
        $user = User::find($id);
        
        $message = "";

        if($user->activated == 0){
            $user->activated = 1;
            $message = 'User' . $user->name . ' activated succesfully.';
            Mail::to($user->email)->send(new ActivationEmail($user));
        }else{
            $user->activated = 0;
            $message = 'User' . $user->name . ' deactivated succesfully.';
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }
}
