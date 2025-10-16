<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $layout_data=LandingPage::first();
        $page_name = 'Service';
        $service = Service::orderBy('created_at', 'desc')->get();
        return view('backEnd.service.index', compact(['page_name','layout_data', 'service']));
    }

    public function store(Request $request)
    {
        // Validate the main event data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'status' => 'required|string|in:active,block',
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['user_name'] = Auth::user()->name;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Store the new image and update the file path in validated data
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back-end-assets/images/service'), $imageName);
            $imagePath = 'back-end-assets/images/service/' . $imageName;
            $validatedData['image'] = $imagePath;
        }
        // Create the event
        $service = Service::create($validatedData);
        // Response based on the event creation
        if ($service) {
            session()->flash('success', [
                'icon' => 'success',
                'title' => "{$validatedData['title']} service added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['title']} service added successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'title' => "{$validatedData['title']} service added successfully."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Service not added!',
            ], 500);
        }
    }
    public function edit($id)
    {
        $layout_data=LandingPage::first();
        $service = Service::findOrFail($id);
        if ($service) {
            $page_name = 'Service-Edit';
            return view('backEnd.service.edit', compact(['page_name','layout_data', 'service']));
        }
    }
    public function update(Request $request)
    {
        // Find the service
        $service = Service::findOrFail($request->id);
    
        // Validate the updated data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'status' => 'required|string|in:active,block',
        ]);
    
        $validatedData['user_id'] = Auth::id();
        $validatedData['user_name'] = Auth::user()->name;
    
        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }
    
            // Store the new image and update the file path
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back-end-assets/images/service'), $imageName);
            $validatedData['image'] = 'back-end-assets/images/service/' . $imageName;
        }
    
        // Update the service record
        $service->update($validatedData);
    
        // Response based on the update operation
        if ($service) {
            session()->flash('success', [
                'icon' => 'success',
                'title' => "{$validatedData['title']} service updated successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['title']} service updated successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'title' => "{$validatedData['title']} service update failed."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Service update failed!',
            ], 500);
        }
    }
    
    public function delete(Request $request)
    {
        // Find the event
        $service = Service::findOrFail($request->service_id);
        if ($service) {
                // Delete the old image if it exists
                if ($service->image && file_exists(public_path($service->image))) {
                    unlink(public_path($service->image));
                }
            // Delete the event
            $service->delete();
            session()->flash('success', [
                'icon' => 'success',
                'title' => "Service deleted successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Service deleted successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'title' => "Service not found."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Service not found.',
            ], 500);
        }
    }
}
