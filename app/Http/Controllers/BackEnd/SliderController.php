<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function index()
    {
        $layout_data=LandingPage::first();
        $page_name = 'Slider';
        $slider = Slider::orderBy('created_at', 'desc')->get();
        return view('backEnd.slider.index', compact(['page_name','layout_data', 'slider']));
    }

    public function store(Request $request)
    {
        // Validate the main event data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'sort_description' => 'nullable|string',
            'link' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'status' => 'required|string|in:active,block',
        ]);

        $validatedData['user_id'] = Auth::id();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Store the new image and update the file path in validated data
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back-end-assets/images/slider'), $imageName);
            $imagePath = 'back-end-assets/images/slider/' . $imageName;
            $validatedData['image'] = $imagePath;
        }
        // Create the event
        $slider = Slider::create($validatedData);
        // Response based on the event creation
        if ($slider) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['title']} slider added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['title']} slider added successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['title']} slider added successfully."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Slider not added!',
            ], 500);
        }
    }
    public function edit($id)
    {
        $layout_data=LandingPage::first();
        $slider = Slider::findOrFail($id);
        if ($slider) {
            $page_name = 'Slider-Edit';
            return view('backEnd.slider.edit', compact(['page_name','layout_data', 'slider']));
        }
    }
    public function update(Request $request)
    {
        // Find the service
        $slider = Slider::findOrFail($request->id);

        // Validate the updated data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'sort_description' => 'nullable|string',
            'link' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'status' => 'required|string|in:active,block',
        ]);

        $validatedData['user_id'] = Auth::id();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($slider->image && file_exists(public_path($slider->image))) {
                unlink(public_path($slider->image));
            }

            // Store the new image and update the file path
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back-end-assets/images/slider'), $imageName);
            $validatedData['image'] = 'back-end-assets/images/slider/' . $imageName;
        }

        // Update the service record
        $slider->update($validatedData);

        // Response based on the update operation
        if ($slider) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['title']} slider updated successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['title']} slider updated successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['title']} slider update failed."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Slider update failed!',
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        // Find the event
        $slider = Slider::findOrFail($request->slider_id);
        if ($slider) {
            // Delete the old image if it exists
            if ($slider->image && file_exists(public_path($slider->image))) {
                unlink(public_path($slider->image));
            }
            // Delete the event
            $slider->delete();
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Service deleted successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Service deleted successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Service not found."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Service not found.',
            ], 500);
        }
    }
}
