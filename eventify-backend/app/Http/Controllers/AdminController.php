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
    public function edit(int $id)
    {
        $user = User::find($id);
        return view('users.edit_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $role = $request->input('user_role');
        switch ($role) {
            case 'Admin':
                $user->role = 'a';
                break;
            case 'User':
                $user->role = 'u';
                break;
            case 'Organizer':
                $user->role = 'o';
                break;
            default:
                $user->role = 'o';
        }

        $user->save();

        
        return redirect()->back()->with('success', __('The user ' . $user->name . ' has been updated succesfully'));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }

    public function toggleSoftDelete(int $id){
        $user = User::find($id);
        
        $message = "";

        if($user->deleted == 0){
            $user->deleted = 1;
            $message = 'Account of user ' . $user->name . ' soft deleted succesfully';
        }else{
            $user->deleted = 0;
            $message = 'Account of user ' . $user->name . ' restored succesfully';
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }

    public function toggleUserStatus(int $id){
        $user = User::find($id);
        
        $message = "";

        if($user->activated == 0){
            $user->activated = 1;
            $message = 'Account of user ' . $user->name . ' activated succesfully';
            Mail::to($user->email)->send(new ActivationEmail($user));
        }else{
            $user->activated = 0;
            $message = 'Account of user ' . $user->name . ' deactivated succesfully';
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }

    public function toggleUserVerified(int $id){
        $user = User::find($id);
        
        $message = "";

        if($user->email_confirmed == 0){
            $user->email_confirmed = 1;
            $message = 'Email of user ' . $user->name . ' verified succesfully';
        }else{
            $user->email_confirmed = 0;
            $message = 'Email of user ' . $user->name . ' unverified succesfully';
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }
}
