<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;
use App\Models\Project;
use App\Models\TechStack;
use App\Models\Inquiry;
use App\Models\Award;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryNotification;

class PublicController extends Controller
{
    public function home()
    {
        return Cache::remember('home_data', 86400, function () {
            $skills = Skill::all();
            $featuredProject = Project::where('is_featured', true)->first();
            $topStacks = TechStack::limit(6)->get();
            return view('home', compact('skills', 'featuredProject', 'topStacks'))->render();
        });
    }

    public function about()
    {
        return Cache::remember('about_data', 86400, function () {
            $experiences = Experience::orderBy('id', 'desc')->get();
            $educations = Education::all();
            $certifications = Certification::all();
            $awards = Award::all();
            return view('about', compact('experiences', 'educations', 'certifications', 'awards'))->render();
        });
    }

    public function projects()
    {
        return Cache::remember('projects_data', 86400, function () {
            $projects = Project::all();
            return view('projects', compact('projects'))->render();
        });
    }

    public function stack()
    {
        return Cache::remember('stack_data', 86400, function () {
            $stacks = TechStack::all()->groupBy('category');
            return view('stack', compact('stacks'))->render();
        });
    }

    public function contact()
    {
        return view('contact');
    }

    public function projectDetail($slug)
    {
        return Cache::remember("project_detail_{$slug}", 86400, function () use ($slug) {
            $project = Project::where('slug', $slug)->firstOrFail();
            return view('project-detail', compact('project'))->render();
        });
    }

    public function storeInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $inquiry = Inquiry::create($validated);

        // Send Email Notification
        try {
            Mail::to(env('MAIL_TO_ADDRESS', 'anwarfaishal86@gmail.com'))->send(new InquiryNotification($inquiry));
        } catch (\Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you for your message! I will get back to you soon.');
    }

    public function downloadCv()
    {
        $profile = Profile::first();

        if ($profile && $profile->cv_path && strpos($profile->cv_path, 'http') === 0) {
            $url = $profile->cv_path;
            if (strpos($url, 'upload/') !== false) {
                $url = str_replace('upload/', 'upload/fl_attachment/', $url);
            }
            return redirect($url);
        }

        $staticPath = public_path('assets/CV-Faishal-Anwar.pdf');
        if (file_exists($staticPath)) {
            return response()->download($staticPath);
        }

        abort(404, 'CV file not found.');
    }
}
