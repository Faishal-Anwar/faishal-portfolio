<?php

namespace App\Http\Controllers;

use App\Models\Stack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Cloudinary;

class StackController extends Controller
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
        $stacks = Stack::all();
        return view('stack', compact('stacks'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
        $imagePath = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'stacks'])['secure_url'];

        Stack::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'is_showcased' => $request->has('is_showcased'),
        ]);

        return redirect()->route('stack.index')->with('success', 'Stack item created successfully.');
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
    public function edit(Stack $stack)
    {
        return view('stack.edit', compact('stack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stack $stack)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is not required on update
        ]);

        $data = $request->only('name', 'description');
        $data['is_showcased'] = $request->has('is_showcased');

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($stack->image) {
                Storage::disk('cloudinary')->delete($stack->image);
            }
            // Store the new image
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            $data['image'] = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'stacks'])['secure_url'];
        }

        $stack->update($data);

        return redirect()->route('stack.index')->with('success', 'Stack item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stack $stack)
    {
        // Delete the image from storage
        if ($stack->image) {
            Storage::disk('cloudinary')->delete($stack->image);
        }

        $stack->delete();

        return redirect()->route('stack.index')->with('success', 'Stack item deleted successfully.');
    }
}
