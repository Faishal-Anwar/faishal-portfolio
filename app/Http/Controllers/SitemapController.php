<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class SitemapController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return response()->view('sitemap', [
            'projects' => $projects,
        ])->header('Content-Type', 'application/xml');
    }
}
