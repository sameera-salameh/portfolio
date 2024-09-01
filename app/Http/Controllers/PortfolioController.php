<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        $aboutme = AboutMe::with('htmltag')->get();
        $contact = Contact::with('htmltag')->get();
        $education = Education::with('htmltag')->get();
        $project = Project::with('htmltag')->get();
        $service = Service::with('htmltag')->get();
        $skill = Skill::with('htmltag')->get();
        return response()->json([
            'aboutme' => $aboutme,
            'contact' => $contact,
            'education' => $education,
            'projects' => $project,
            'services' => $service,
            'skills' => $skill,
        ]);
    }
}
