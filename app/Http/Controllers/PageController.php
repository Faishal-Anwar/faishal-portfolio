<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\About;
use App\Models\Stack;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class PageController extends Controller
{
    public function home()
    {
        $featuredProjects = Project::where('is_featured', true)->latest()->take(2)->get();
        $latestProjects = Project::where('is_featured', false)->whereNotNull('slug')->latest()->take(2)->get();

        $abouts = About::where('is_showcased', true)->latest()->get()->groupBy('category');

        $stacks = Stack::where('is_showcased', true)->latest()->take(8)->get();

        return view('home', [
            'featuredProjects' => $featuredProjects,
            'latestProjects' => $latestProjects,
            'abouts' => $abouts,
            'stacks' => $stacks,
        ]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function storeContactForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('anwarfaishal86@gmail.com')->send(new ContactFormMail($data));

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }

    public function sitemap()
    {
        $projects = Project::latest()->get();

        return response()->view('sitemap', [
            'projects' => $projects,
        ])->header('Content-Type', 'text/xml');
    }
}
