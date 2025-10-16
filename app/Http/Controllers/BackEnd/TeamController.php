<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(){
        $page_name = 'Team & Management';
        $layout_data=LandingPage::first();
        $teams = Team::orderBy('order', 'asc')->get();
        return view('backEnd.team.index', compact('layout_data','page_name','teams'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the main event data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable',
            'member_type' => 'required|in:team,management',
            'tel_phone' => 'nullable',
            'email' => 'nullable',
            'designation' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'qualification' => 'nullable',
            'description' => 'nullable',
            'fb_link' => 'nullable',
            'ln_link' => 'nullable',
            'wp_link' => 'nullable',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:active,block',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Store the new image and update the file path in validated data
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back-end-assets/images/team/'), $imageName);
            $imagePath = 'back-end-assets/images/team/' . $imageName;
            $validatedData['image'] = $imagePath;
        }
        // Create the event
        $team = Team::create($validatedData);
        // Response based on the event creation
        if ($team) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['name']} added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['name']} added successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['name']} added successfully."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Not added!',
            ], 500);
        }
    }
    public function edit($id)
    {
        $layout_data=LandingPage::first();
        $team = Team::findOrFail($id);
        if ($team) {
            $page_name = 'Team & Management-Edit';
            return view('backEnd.team.edit', compact(['page_name','layout_data', 'team']));
        }
    }
    public function update(Request $request)
    {
        // Find the service
        $team = Team::findOrFail($request->id);
        // dd($teacher);
        // Validate the main event data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable',
            'member_type' => 'required|in:team,management',
            'tel_phone' => 'nullable',
            'email' => 'nullable',
            'designation' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'qualification' => 'nullable',
            'description' => 'nullable',
            'fb_link' => 'nullable',
            'ln_link' => 'nullable',
            'wp_link' => 'nullable',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:active,block',
        ]);


        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($team->image && file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }

            // Store the new image and update the file path
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back-end-assets/images/team/'), $imageName);
            $validatedData['image'] = 'back-end-assets/images/team/' . $imageName;
        }

        // Update the service record
        $team->update($validatedData);

        // Response based on the update operation
        if ($team) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['name']} updated successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['name']} updated successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['name']} update failed."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Update failed!',
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        // Find the event
        $team = Team::findOrFail($request->id);
        if ($team) {
            // Delete the old image if it exists
            if ($team->image && file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }
            // Delete the event
            $team->delete();
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Deleted successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Deleted successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Not found."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Not found.',
            ], 500);
        }
    }
}
