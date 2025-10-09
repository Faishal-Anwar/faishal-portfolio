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

    protected function getCloudinary()
    {
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
    }

    public function index()
    {
        $stacks = Stack::all();
        return view('stack', compact('stacks'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $cloudinary = $this->getCloudinary();
        $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
            'folder' => 'portfolio-images'
        ]);

        Stack::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $result['secure_url'],
            'is_showcased' => $request->has('is_showcased'),
        ]);

        return redirect()->route('stack.index')->with('success', 'Stack item created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Stack $stack)
    {
        return view('stack.edit', compact('stack'));
    }

    public function update(Request $request, Stack $stack)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only('name', 'description');
        $data['is_showcased'] = $request->has('is_showcased');

        if ($request->hasFile('image')) {
            // Manual deletion logic would be needed here
            $cloudinary = $this->getCloudinary();
            $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'portfolio-images'
            ]);
            $data['image'] = $result['secure_url'];
        }

        $stack->update($data);

        return redirect()->route('stack.index')->with('success', 'Stack item updated successfully.');
    }

    public function destroy(Stack $stack)
    {
        // Manual deletion logic would be needed here
        $stack->delete();

        return redirect()->route('stack.index')->with('success', 'Stack item deleted successfully.');
    }
}
