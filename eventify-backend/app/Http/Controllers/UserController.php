<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentCategory = $request->input('category', 'all');
        $page = $request->input('page', 1);

        if ($currentCategory == 'all') {
            $events = Event::where('start_date', '>', now())->paginate(5, ['*'], 'page', $page);
        } else if($currentCategory == 'user'){
            // TODO: Implement user events
        } else {
            $category = Category::where('name', ucfirst($currentCategory))->first();
            if ($category) {
                $events = Event::where('category_id', $category->id)->where('deleted', 0)->where('start_date', '>', now())->paginate(5, ['*'], 'page', $page);
            } else {
                $events = collect();
            }
        }

        $categories = Category::all();

        return view('users.user_view', compact('events', 'currentCategory', 'categories'));
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
