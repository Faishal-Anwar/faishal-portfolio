<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::latest()->get()->groupBy('category');
        $categories = ['Academic Education', 'Experience', 'Non-Formal Education', 'Certifications'];
        return view('about', compact('abouts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed as form is on the index page
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:Academic Education,Experience,Non-Formal Education,Certifications',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = $request->all();
        $data['is_showcased'] = $request->has('is_showcased');

        About::create($data);

        return redirect()->route('about.index')->with('success', 'About entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Not needed as form is on the index page, but can be used for populating the edit form
        $about_item = About::findOrFail($id);
        $abouts = About::latest()->get()->groupBy('category');
        $categories = ['Academic Education', 'Experience', 'Non-Formal Education', 'Certifications'];
        return view('about', compact('about_item', 'abouts', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required|in:Academic Education,Experience,Non-Formal Education,Certifications',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $about = About::findOrFail($id);
        $data = $request->all();
        $data['is_showcased'] = $request->has('is_showcased');
        
        $about->update($data);

        return redirect()->route('about.index')->with('success', 'About entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        return redirect()->route('about.index')->with('success', 'About entry deleted successfully.');
    }
}
