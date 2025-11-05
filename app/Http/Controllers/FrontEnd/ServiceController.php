<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function all(){
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('frontEnd.service.all',compact('services'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        // Perform the search
        $results = Service::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%") 
            ->get();
        return response()->json($results);
    }
    public function service($id)
    {
        $service = Service::findOrFail($id);
        // dd($panel_member);
        return view('frontEnd.service.view', compact('service'));
    }

    public function ventilation_system()
    {
        return view('frontEnd.service.fixed_page.ventilation_system');
    }
    public function fighting_system()
    {
        return view('frontEnd.service.fixed_page.fire_fighting_system');
    }
    public function plumbing_works()
    {
        return view('frontEnd.service.fixed_page.plumbing_works');
    }
    public function additional_works()
    {
        return view('frontEnd.service.fixed_page.additional_works');
    }
    public function service_all()
    {
        return view('frontEnd.service.fixed_page.service_all');
    }
}
