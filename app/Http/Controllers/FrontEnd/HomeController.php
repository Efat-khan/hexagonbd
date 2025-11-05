<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\LandingPage;
use App\Models\Order;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Teacher;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        $layout_data = LandingPage::first();
        $sliders = Slider::where('status', 'active')->orderBy('created_at', 'asc')->get();
        $clients = Client::where('status', 'active')->where('type','client')->orderBy('created_at', 'desc')->get();
        $brands = Client::where('status', 'active')->where('type','brand')->orderBy('created_at', 'desc')->get();
        $projects = Project::where('status', 'active')->where('show_on_home', 1)->orderBy('created_at', 'desc')->get();
        return view('frontEnd.home.index', compact('layout_data', 'sliders', 'clients', 'brands', 'projects'));
    }
    public function course()
    {
        $layout_data = LandingPage::first();
        return view('frontEnd.course.course', compact('layout_data'));
    }
    public function about()
    {
        $layout_data = LandingPage::first();
        return view('frontEnd.about.about', compact('layout_data'));
    }
    public function management()
    {
        $teams = Team::where('member_type', 'management')->where('status', 'active')->orderBy('order', 'asc')->get();
        $layout_data = LandingPage::first();
        return view('frontEnd.about.management', compact('layout_data','teams'));
    }
    public function team()
    {
        $teams = Team::where('member_type', 'team')->where('status', 'active')->orderBy('order', 'asc')->get();
        $layout_data = LandingPage::first();
        return view('frontEnd.about.team', compact('layout_data','teams'));
    }
    public function notice()
    {
        $layout_data = LandingPage::first();
        return view('frontEnd.notice.all_notice', compact('layout_data'));
    }

    public function gallery_view()
    {
        $images = Gallery::pluck('image'); // Retrieve only the 'image' column

        // Convert the collection to an array and merge all paths
        // Convert JSON strings into PHP arrays and merge
        $mergedImages = $images->map(function ($image) {
            // Check if the value is a JSON string
            if ($this->isJson($image)) {
                // Decode JSON to an array
                return json_decode($image, true); // Decode JSON string into an array
            } else {
                // Treat it as a single image path and return as an array
                return [$image];
            }
        })->flatten()->toArray();
        // dd($mergedImages);
        // dd($images);
        return view('frontEnd.gallery.view_gallery', compact('mergedImages'));
    }
    // Helper function to check if a string is valid JSON
    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function contact()
    {
        $layout_data = LandingPage::first();
        return view('frontEnd.contact.contact', compact('layout_data'));
    }
    public function contact_store(Request $request)
    {
        $validateData = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if (Contact::create($validateData)) {
        
            return back()->with('success', 'Sent message successfully.');
        } else {
            return back()->with('error', "Couldn't send message.");
        }
    }
    public function client()
    {
        $clients = Client::where('status', 'active')->where('type','client')->orderBy('created_at', 'desc')->get();
        $layout_data = LandingPage::first();
        return view('frontEnd.client-and-partner.index', compact('layout_data','clients'));
    }
    public function brands()
    {
        $brands = Client::where('status', 'active')->where('type','brand')->orderBy('created_at', 'desc')->get();
        $layout_data = LandingPage::first();
        return view('frontEnd.brand.index', compact('layout_data','brands'));
    }

    public function project_all()
    {
        $projects = Project::where('status', 'active')->orderBy('created_at', 'desc')->get();
        $layout_data = LandingPage::first();
        return view('frontEnd.project.project_all', compact('layout_data','projects'));
    }
    public function project_show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return redirect()->route('home.project.all')->with('error', 'Project not found.');
        }
        $layout_data = LandingPage::first();
        return view('frontEnd.project.project_show', compact('layout_data','project'));
    }

    public function orgChart()
    {
        $layout_data = LandingPage::first();
        return view('frontEnd.about.org_chart', compact('layout_data'));
    }
}
