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
        $data = Cache::remember('page.home', 3600, function () {
            return [
                'coreSkills' => Skill::all(),
                'featuredProject' => Project::where('is_featured', true)->first(),
                'topStacks' => TechStack::limit(6)->get(),
            ];
        });
        return view('home', $data);
    }

    public function about()
    {
        $data = Cache::remember('page.about', 3600, function () {
            return [
                'experiences' => Experience::orderBy('id', 'desc')->get(),
                'educations' => Education::all(),
                'certifications' => Certification::all(),
                'awards' => Award::all(),
            ];
        });
        return view('about', $data);
    }

    public function projects()
    {
        $projects = Cache::remember('page.projects', 3600, function () {
            return Project::all();
        });
        return view('projects', compact('projects'));
    }

    public function projectDetail($slug)
    {
        $project = Cache::remember("page.project.{$slug}", 3600, function () use ($slug) {
            return Project::where('slug', $slug)->firstOrFail();
        });
        return view('project-detail', compact('project'));
    }

    public function stack()
    {
        $stacks = Cache::remember('page.stack', 3600, function () {
            return TechStack::all()->groupBy('category');
        });
        return view('stack', compact('stacks'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function storeInquiry(Request $request)
    {
        // Honeypot anti-spam check
        if ($request->filled('honeypot')) {
            return back()->with('success', 'Your message has been sent successfully!'); // Silent fail for bots
        }

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
            \Illuminate\Support\Facades\Log::error('Inquiry Mail Failed: ' . $e->getMessage());
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
