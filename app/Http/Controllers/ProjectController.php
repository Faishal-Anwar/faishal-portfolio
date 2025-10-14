<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Stack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Cloudinary\Cloudinary;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $projects = Project::latest()->paginate(10);
        $stacks = collect(); // Default to an empty collection

        if (auth()->check()) {
            $stacks = Stack::all();
        }

        return view('projects', compact('projects', 'stacks'));
    }

    public function create()
    {
        $stacks = Stack::all();
        return view('projects.create', compact('stacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'client' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'overview' => 'required',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $data = $request->except('image');

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
        $data['image'] = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'projects'])['secure_url'];

        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        $data['is_featured'] = $request->has('is_featured');

        Project::create($data);

        return redirect()->route('projects.index')
                        ->with('success','Project created successfully.');
    }

    public function show(Project $project)
    {
        $otherProjects = Project::where('slug', '!=', $project->slug)->latest()->take(2)->get();
        return view('project-detail', compact('project', 'otherProjects'));
    }

    public function edit(Project $project)
    {
        $stacks = Stack::all();
        return view('projects.edit', compact('project', 'stacks'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'client' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'overview' => 'required',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'approach' => 'nullable|string',
            'vision' => 'nullable|string',
            'design' => 'nullable|string',
            'conclusion' => 'nullable|string',
        ]);

        $data = $request->except('image');
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('cloudinary')->delete($project->image);
            }
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            $data['image'] = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'projects'])['secure_url'];
        }

        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        $project->update($data);

        return redirect()->route('projects.index')
                        ->with('success','Project updated successfully');
    }

    public function destroy(Project $project)
    {
        Storage::disk('cloudinary')->delete($project->image);
        $project->delete();

        return redirect()->route('projects.index')
                        ->with('success','Project deleted successfully');
    }
}