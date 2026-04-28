<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;
use App\Models\Project;
use App\Models\Inquiry;
use App\Models\Award;
use App\Models\Profile;
use App\Services\CloudinaryService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    private function clearPublicCache()
    {
        Cache::forget('global.profile');
        Cache::forget('page.home');
        Cache::forget('page.about');
        Cache::forget('page.projects');
        Cache::forget('page.stack');

        // Clear individual project detail caches
        $projects = Project::select('slug')->get();
        foreach ($projects as $project) {
            Cache::forget("page.project.{$project->slug}");
        }
    }

    public function dashboard()
    {
        $counts = [
            'projects' => Project::count(),
            'skills' => Skill::count(),
            'inquiries' => Inquiry::count(),
        ];
        return view('admin.dashboard', compact('counts'));
    }

    // --- Profile Management ---
    public function profile()
    {
        $profile = Profile::first() ?? new Profile([
            'name' => 'Faishal Anwar',
            'title' => 'ML Engineer',
            'email' => 'anwarfaishal86@gmail.com'
        ]);
        return view('admin.profile.index', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'cv' => 'nullable|mimes:pdf|max:10240',
            'github_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
        ]);

        $profile = Profile::first() ?? new Profile();
        
        $profile->name = $request->name;
        $profile->title = $request->title;
        $profile->email = $request->email;
        $profile->github_url = $request->github_url;
        $profile->linkedin_url = $request->linkedin_url;
        $profile->instagram_url = $request->instagram_url;

        if ($request->hasFile('image')) {
            if ($profile->image && strpos($profile->image, 'http') === 0) {
                $this->cloudinary->delete($profile->image);
            }
            $profile->image = $this->cloudinary->upload($request->file('image'), 'profile');
        }

        if ($request->hasFile('cv')) {
            if ($profile->cv_path && strpos($profile->cv_path, 'http') === 0) {
                $this->cloudinary->delete($profile->cv_path);
            }
            $profile->cv_path = $this->cloudinary->upload($request->file('cv'), 'cv');
        }

        $profile->save();

        $this->clearPublicCache();
        return back()->with('success', 'Profile updated successfully.');
    }

    // --- Project CRUD ---
    public function projects()
    {
        $projects = Project::orderBy('id', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function createProject()
    {
        return view('admin.projects.create');
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:20',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'icon' => 'required|string',
            'tags' => 'required|string', // comma separated
            'github_url' => 'nullable|url',
            'is_featured' => 'nullable|boolean',
            'case_study' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->cloudinary->upload($request->file('image'), 'projects');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $this->cloudinary->upload($file, 'projects/gallery');
            }
            $validated['gallery'] = $galleryPaths;
        }

        $validated['tags'] = array_map('trim', explode(',', $request->tags));
        $validated['slug'] = Str::slug($request->title);
        $validated['is_featured'] = $request->has('is_featured');

        Project::create($validated);

        $this->clearPublicCache();
        return redirect()->route('admin.projects')->with('success', 'Project created successfully.');
    }

    public function editProject(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function updateProject(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:20',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'icon' => 'required|string',
            'tags' => 'required|string',
            'github_url' => 'nullable|url',
            'is_featured' => 'nullable|boolean',
            'case_study' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $this->cloudinary->delete($project->image);
            $validated['image'] = $this->cloudinary->upload($request->file('image'), 'projects');
        }

        if ($request->hasFile('gallery')) {
            if ($project->gallery) {
                foreach ($project->gallery as $oldPath) {
                    $this->cloudinary->delete($oldPath);
                }
            }
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $this->cloudinary->upload($file, 'projects/gallery');
            }
            $validated['gallery'] = $galleryPaths;
        }

        $validated['tags'] = array_map('trim', explode(',', $request->tags));
        $validated['slug'] = Str::slug($request->title);
        $validated['is_featured'] = $request->has('is_featured');

        $project->update($validated);

        $this->clearPublicCache();
        return redirect()->route('admin.projects')->with('success', 'Project updated successfully.');
    }

    public function deleteProject(Project $project)
    {
        $this->cloudinary->delete($project->image);
        if ($project->gallery) {
            foreach ($project->gallery as $path) {
                $this->cloudinary->delete($path);
            }
        }
        $project->delete();
        $this->clearPublicCache();
        return back()->with('success', 'Project deleted successfully.');
    }

    // --- Skills CRUD (Hero Cards) ---
    public function skills()
    {
        $skills = Skill::all();
        return view('admin.skills.index', compact('skills'));
    }

    public function editSkill(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $skill->update($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.skills')->with('success', 'Skill updated successfully.');
    }

    // --- Experience CRUD ---
    public function experiences()
    {
        $experiences = Experience::orderBy('id', 'desc')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function createExperience()
    {
        return view('admin.experiences.create');
    }

    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Experience::create($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.experiences')->with('success', 'Experience added successfully.');
    }

    public function editExperience(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function updateExperience(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $experience->update($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.experiences')->with('success', 'Experience updated successfully.');
    }

    public function deleteExperience(Experience $experience)
    {
        $experience->delete();
        $this->clearPublicCache();
        return back()->with('success', 'Experience deleted successfully.');
    }

    // --- Education CRUD ---
    public function educations()
    {
        $educations = Education::all();
        return view('admin.educations.index', compact('educations'));
    }

    public function createEducation()
    {
        return view('admin.educations.create');
    }

    public function storeEducation(Request $request)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Education::create($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.educations')->with('success', 'Education added successfully.');
    }

    public function editEducation(Education $education)
    {
        return view('admin.educations.edit', compact('education'));
    }

    public function updateEducation(Request $request, Education $education)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $education->update($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.educations')->with('success', 'Education updated successfully.');
    }

    public function deleteEducation(Education $education)
    {
        $education->delete();
        $this->clearPublicCache();
        return back()->with('success', 'Education deleted successfully.');
    }

    // --- Certification CRUD ---
    public function certifications()
    {
        $certifications = Certification::all();
        return view('admin.certifications.index', compact('certifications'));
    }

    public function createCertification()
    {
        return view('admin.certifications.create');
    }

    public function storeCertification(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Certification::create($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.certifications')->with('success', 'Certification added successfully.');
    }

    public function editCertification(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function updateCertification(Request $request, Certification $certification)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $certification->update($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.certifications')->with('success', 'Certification updated successfully.');
    }

    public function deleteCertification(Certification $certification)
    {
        $certification->delete();
        $this->clearPublicCache();
        return back()->with('success', 'Certification deleted successfully.');
    }

    // --- Award CRUD ---
    public function awards()
    {
        $awards = Award::all();
        return view('admin.awards.index', compact('awards'));
    }

    public function createAward()
    {
        return view('admin.awards.create');
    }

    public function storeAward(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Award::create($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.awards')->with('success', 'Award added successfully.');
    }

    public function editAward(Award $award)
    {
        return view('admin.awards.edit', compact('award'));
    }

    public function updateAward(Request $request, Award $award)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $award->update($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.awards')->with('success', 'Award updated successfully.');
    }

    public function deleteAward(Award $award)
    {
        $award->delete();
        $this->clearPublicCache();
        return back()->with('success', 'Award deleted successfully.');
    }

    // --- Tech Stack CRUD ---
    public function stacks()
    {
        $stacks = TechStack::all()->groupBy('category');
        return view('admin.stacks.index', compact('stacks'));
    }

    public function createStack()
    {
        return view('admin.stacks.create');
    }

    public function storeStack(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'name' => 'required|string|max:255',
            'icon_url' => 'required|url',
            'description' => 'required|string',
        ]);
        TechStack::create($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.stacks')->with('success', 'Tech added to stack successfully.');
    }

    public function editStack(TechStack $stack)
    {
        return view('admin.stacks.edit', compact('stack'));
    }

    public function updateStack(Request $request, TechStack $stack)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'name' => 'required|string|max:255',
            'icon_url' => 'required|url',
            'description' => 'required|string',
        ]);
        $stack->update($validated);
        $this->clearPublicCache();
        return redirect()->route('admin.stacks')->with('success', 'Tech stack updated successfully.');
    }

    public function deleteStack(TechStack $stack)
    {
        $stack->delete();
        $this->clearPublicCache();
        return back()->with('success', 'Tech removed from stack.');
    }

    // --- Inquiry Management ---
    public function inquiries()
    {
        $inquiries = Inquiry::orderBy('id', 'desc')->get();
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function deleteInquiry(Inquiry $inquiry)
    {
        $inquiry->delete();
        return back()->with('success', 'Inquiry deleted successfully.');
    }
}
