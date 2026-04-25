<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/projects', [PublicController::class, 'projects'])->name('projects');
Route::get('/stack', [PublicController::class, 'stack'])->name('stack');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'storeInquiry'])->name('contact.store');
Route::get('/projects/{slug}', [PublicController::class, 'projectDetail'])->name('project-detail');
Route::get('/download-cv', [PublicController::class, 'downloadCv'])->name('download.cv');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    // Projects
    Route::get('/projects', [AdminController::class, 'projects'])->name('admin.projects');
    Route::get('/projects/create', [AdminController::class, 'createProject'])->name('admin.projects.create');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('admin.projects.store');
    Route::get('/projects/{project}/edit', [AdminController::class, 'editProject'])->name('admin.projects.edit');
    Route::put('/projects/{project}', [AdminController::class, 'updateProject'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [AdminController::class, 'deleteProject'])->name('admin.projects.delete');

    // Skills
    Route::get('/skills', [AdminController::class, 'skills'])->name('admin.skills');
    Route::get('/skills/{skill}/edit', [AdminController::class, 'editSkill'])->name('admin.skills.edit');
    Route::put('/skills/{skill}', [AdminController::class, 'updateSkill'])->name('admin.skills.update');

    // Experience
    Route::get('/experiences', [AdminController::class, 'experiences'])->name('admin.experiences');
    Route::get('/experiences/create', [AdminController::class, 'createExperience'])->name('admin.experiences.create');
    Route::post('/experiences', [AdminController::class, 'storeExperience'])->name('admin.experiences.store');
    Route::get('/experiences/{experience}/edit', [AdminController::class, 'editExperience'])->name('admin.experiences.edit');
    Route::put('/experiences/{experience}', [AdminController::class, 'updateExperience'])->name('admin.experiences.update');
    Route::delete('/experiences/{experience}', [AdminController::class, 'deleteExperience'])->name('admin.experiences.delete');

    // Education
    Route::get('/educations', [AdminController::class, 'educations'])->name('admin.educations');
    Route::get('/educations/create', [AdminController::class, 'createEducation'])->name('admin.educations.create');
    Route::post('/educations', [AdminController::class, 'storeEducation'])->name('admin.educations.store');
    Route::get('/educations/{education}/edit', [AdminController::class, 'editEducation'])->name('admin.educations.edit');
    Route::put('/educations/{education}', [AdminController::class, 'updateEducation'])->name('admin.educations.update');
    Route::delete('/educations/{education}', [AdminController::class, 'deleteEducation'])->name('admin.educations.delete');

    // Certifications
    Route::get('/certifications', [AdminController::class, 'certifications'])->name('admin.certifications');
    Route::get('/certifications/create', [AdminController::class, 'createCertification'])->name('admin.certifications.create');
    Route::post('/certifications', [AdminController::class, 'storeCertification'])->name('admin.certifications.store');
    Route::get('/certifications/{certification}/edit', [AdminController::class, 'editCertification'])->name('admin.certifications.edit');
    Route::put('/certifications/{certification}', [AdminController::class, 'updateCertification'])->name('admin.certifications.update');
    Route::delete('/certifications/{certification}', [AdminController::class, 'deleteCertification'])->name('admin.certifications.delete');

    // Awards
    Route::get('/awards', [AdminController::class, 'awards'])->name('admin.awards');
    Route::get('/awards/create', [AdminController::class, 'createAward'])->name('admin.awards.create');
    Route::post('/awards', [AdminController::class, 'storeAward'])->name('admin.awards.store');
    Route::get('/awards/{award}/edit', [AdminController::class, 'editAward'])->name('admin.awards.edit');
    Route::put('/awards/{award}', [AdminController::class, 'updateAward'])->name('admin.awards.update');
    Route::delete('/awards/{award}', [AdminController::class, 'deleteAward'])->name('admin.awards.delete');

    // Tech Stack
    Route::get('/stacks', [AdminController::class, 'stacks'])->name('admin.stacks');
    Route::get('/stacks/create', [AdminController::class, 'createStack'])->name('admin.stacks.create');
    Route::post('/stacks', [AdminController::class, 'storeStack'])->name('admin.stacks.store');
    Route::get('/stacks/{stack}/edit', [AdminController::class, 'editStack'])->name('admin.stacks.edit');
    Route::put('/stacks/{stack}', [AdminController::class, 'updateStack'])->name('admin.stacks.update');
    Route::delete('/stacks/{stack}', [AdminController::class, 'deleteStack'])->name('admin.stacks.delete');

    // Inquiries
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('admin.inquiries');
    Route::delete('/inquiries/{inquiry}', [AdminController::class, 'deleteInquiry'])->name('admin.inquiries.delete');
});
