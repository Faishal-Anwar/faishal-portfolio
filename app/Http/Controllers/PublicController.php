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
            // Bypass cache for the actual download action
            $profile = Profile::first();

            if ($profile && $profile->cv_path) {
                $url = $profile->cv_path;
                
                if (strpos($url, 'http') === 0) {
                    // Stream the file from Cloudinary to force a download from our domain
                    // This bypasses Cloudinary's potential fl_attachment errors and browser tab behavior
                    return response()->streamDownload(function () use ($url) {
                        $stream = fopen($url, 'rb');
                        if ($stream) {
                            fpassthru($stream);
                            fclose($stream);
                        }
                    }, 'CV-Faishal-Anwar.pdf', [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'attachment; filename="CV-Faishal-Anwar.pdf"',
                    ]);
                }

                if (Storage::disk('public')->exists($url)) {
                    return Storage::disk('public')->download($url);
                }
            }
        } catch (\Exception $e) {
            // Fall through to local fallback
        }

        // Final direct download fallback for static asset in public/assets
        $staticPath = base_path('public/assets/CV-Faishal-Anwar.pdf');
        
        if (file_exists($staticPath)) {
            return response()->download($staticPath, 'CV-Faishal-Anwar.pdf', [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="CV-Faishal-Anwar.pdf"',
            ]);
        }

        // Ultimate fallback: redirect to asset URL (might open in tab, but won't 404)
        return redirect(asset('assets/CV-Faishal-Anwar.pdf'));
    }
}
