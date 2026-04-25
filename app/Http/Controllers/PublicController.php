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

    public function projectDetail($slug)
    {
        return Cache::remember("project_detail_{$slug}", 86400, function () use ($slug) {
            $project = Project::where('slug', $slug)->firstOrFail();
            return view('project-detail', compact('project'))->render();
        });
    }

    public function stack()
    {
        return Cache::remember('stack_data', 86400, function () {
            $stacks = TechStack::all();
            return view('stack', compact('stacks'))->render();
        });
    }

    public function contact()
    {
        return view('contact');
    }

    public function storeInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $inquiry = Inquiry::create($validated);

        try {
            Mail::to('anwarfaishal86@gmail.com')->send(new InquiryNotification($inquiry));
        } catch (\Exception $e) {
            // Silently fail if mail fails
        }

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function downloadCv()
    {
        try {
            // Bypass cache to ensure we get the latest path
            $profile = Profile::first();

            if ($profile && $profile->cv_path) {
                $url = $profile->cv_path;
                
                // If it's a Cloudinary URL
                if (strpos($url, 'http') === 0) {
                    if (strpos($url, 'cloudinary.com') !== false) {
                        // Ensure fl_attachment is present to force download
                        // Cloudinary supports fl_attachment for both images (PDFs as images) and raw files
                        if (strpos($url, '/upload/') !== false && strpos($url, 'fl_attachment') === false) {
                            $url = str_replace('/upload/', '/upload/fl_attachment/', $url);
                        }
                    }
                    return redirect($url);
                }

                // If it's a local storage path (unlikely to work on Vercel unless in git)
                if (Storage::disk('public')->exists($url)) {
                    return Storage::disk('public')->download($url);
                }
            }
        } catch (\Exception $e) {
            // Silently fall through to static fallback
        }

        // Final direct download fallback for static asset in public/assets
        // On Vercel, base_path('public/assets/...') is often more reliable than public_path()
        $staticPath = base_path('public/assets/CV-Faishal-Anwar.pdf');
        
        if (file_exists($staticPath)) {
            return response()->download($staticPath, 'CV-Faishal-Anwar.pdf', [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="CV-Faishal-Anwar.pdf"',
            ]);
        }

        // Last resort: redirect to the asset URL directly
        return redirect(asset('assets/CV-Faishal-Anwar.pdf'));
    }
}
