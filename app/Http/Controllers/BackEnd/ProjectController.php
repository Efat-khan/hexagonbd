<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\LandingPage;
use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $layout_data = LandingPage::first();
        $page_name = 'Project';
        $clients = Client::orderBy('created_at', 'desc')->get();
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('backEnd.project.index', compact('layout_data', 'page_name', 'clients', 'projects'));
    }
    public function store(Request $request)
    {
        // Validate 
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'client_id' => 'nullable|string',
            'show_on_home' => 'nullable',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|string|in:active,block',
        ]);
        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Store the new image and update the file path in validated data
            $fileName = time() . '_' . uniqid() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('back-end-assets/images/project/'), $fileName);
            $filePath = 'back-end-assets/images/project/' . $fileName;
            $validatedData['image'] = $filePath;
        }
        // Create the event
        $project = Project::create($validatedData);
        // Response based on the event creation
        if ($project) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['title']} added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['title']} added successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Not added!"
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Not added!',
            ], 500);
        }
    }
    public function edit($id)
    {
        $layout_data = LandingPage::first();
        $project = Project::findOrFail($id);
        $clients = Client::orderBy('created_at', 'desc')->get();
        if ($project) {
            $page_name = 'Project-Edit';
            return view('backEnd.project.edit', compact(['page_name', 'layout_data', 'project', 'clients']));
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        // Find the service
        $project = Project::findOrFail($request->id);

        // Validate 
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'client_id' => 'nullable|string',
            'show_on_home' => 'nullable',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|string|in:active,block',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old file if it exists
            if ($project->image && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }
            // Store the new file and update the file path in validated data
            $fileName = time() . '_' . uniqid() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('back-end-assets/images/project/'), $fileName);
            $filePath = 'back-end-assets/images/project/' . $fileName;
            $validatedData['image'] = $filePath;
        }

        // Response based on the update operation
        if ($project->update($validatedData)) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['title']} updated successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['title']} updated successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['title']} update failed."
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
        $project = project::findOrFail($request->project_id);
        if ($project) {
            // Delete the old image if it exists
            if ($project->image && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }
            // Delete the event
            $project->delete();
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Project deleted successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Project deleted successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Project not found."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Project not found.',
            ], 500);
        }
    }

    public function store_resource(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'project_id' => 'required',
            'file' => 'required',
            'status' => 'required',
        ]);
        // Handle image upload if present
        if ($request->hasFile('file')) {
            // Store the new file and update the file path in validated data
            $fileName = 'R-' . $request->project_id . '_' . uniqid() . '_' . $request->file->getClientOriginalName();
            $request->file->move(public_path('back-end-assets/images/project/'), $fileName);
            $filePath = 'back-end-assets/images/project/' . $fileName;
            $validatedData['file'] = $filePath;
        }
        // Store course in the database
        if (ProjectFile::create($validatedData)) {

            session()->flash('success', [
                'icon' => 'success',
                'name' => 'Resource added Successfully.'
            ]);
            return response()->json([
                'status' => true,
                'message' => "Resource added Successfully.",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Resource not added !!",
            ]);
        }
    }
    // course Resource Update
    public function update_resource(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'project_id' => 'required',
            'file' => 'required',
            'status' => 'required',
        ]);
        $resource = ProjectFile::find($request->id);
        // Handle image upload if present
        if ($request->hasFile('file')) {
            // Delete the old image if it exists
            if ($resource->file && file_exists(public_path($resource->file))) {
                unlink(public_path($resource->file));
            }
            // Store the new file and update the file path in validated data
            $fileName = 'R-' . $request->project_id . '_' . uniqid() . '_' . $request->file->getClientOriginalName();
            $request->file->move(public_path('back-end-assets/images/project/'), $fileName);
            $filePath = 'back-end-assets/images/project/' . $fileName;
            $validatedData['file'] = $filePath;
        }
        if (!$resource) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'Resource not updated.'
            ]);
            return redirect()->back();
        }
        // Update course resource with validated data only
        $resource = $resource->update($validatedData);
        if ($resource) {
            // Set a success flash message
            session()->flash('success', [
                'icon' => 'success',
                'name' => 'Resource updated successfully.'
            ]);
        } else {
            // Set a error flash message
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'Resource missing information.'
            ]);
        }
        // Return JSON response
        return redirect()->back();
    }

    // course Resource Delete
    public function delete_resource(Request $request)
    {
        // dd($request->all());
        $resource = ProjectFile::find($request->project_resource_id);
        if ($resource->file && file_exists(public_path($resource->file))) {
            unlink(public_path($resource->file));
        }
        if (empty($resource)) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'Resource Not found.'
            ]);
            // return redirect()->back();
            return response()->json([
                'status' => false,
                'msg' => 'Resource Not found.'
            ]);
        } else {
            $resource->delete();

            return response()->json([
                'status' => true,
                'msg' => 'Resource deleted successfully.'
            ]);
        }
    }
}
