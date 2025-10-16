<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $layout_data=LandingPage::first();
        $page_name = 'Gallery';
        $gallery = Gallery::orderBy('created_at', 'desc')->get();
        return view('backEnd.gallery.index', compact(['page_name','layout_data', 'gallery']));
    }

    public function store(Request $request)
    {
        // Debugging to check the input files
        // dd($request->file('image'));

        // Validate the main event data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5000', // Validate each file
            'event_id' => 'nullable', // Validate each file
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['event_id'] = 0;

        // Handle multiple file uploads if present
        if ($request->hasFile('image')) {
            $filePaths = []; // Array to hold paths of uploaded files

            foreach ($request->file('image') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('back-end-assets/gallery'), $fileName);
                $filePath = 'back-end-assets/gallery/' . $fileName;
                $filePaths[] = $filePath;
            }

            // Store the paths in the database or as needed
            $validatedData['image'] = json_encode($filePaths); // Assuming you want to store paths as JSON
        }

        // Create the gallery entry
        $gallery = Gallery::create($validatedData);

        // Response based on the gallery creation
        if ($gallery) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['title']} gallery added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['title']} gallery added successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Gallery not added!"
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Gallery not added!',
            ], 500);
        }
    }

    public function edit($id)
    {
        $layout_data=LandingPage::first();
        $gallery = Gallery::findOrFail($id);
        if ($gallery) {
            $page_name = 'Gallery-Edit';
            return view('backEnd.gallery.edit', compact(['page_name','layout_data', 'gallery']));
        }
    }
    public function update(Request $request)
{
    // Find the gallery entry
    $gallery = Gallery::findOrFail($request->id);

    // Validate input
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'image.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5000',
        'event_id' => 'nullable',
    ]);

    $validatedData['user_id'] = Auth::id();

    // Decode existing images from the database
    $existingImages = json_decode($gallery->image, true) ?? [];

    // Array to hold final images (existing + new uploads)
    $updatedImages = $existingImages;

    // Handle new image uploads
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $file) {
            $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('back-end-assets/gallery'), $fileName);
            $filePath = 'back-end-assets/gallery/' . $fileName;
            $updatedImages[] = $filePath; // Add new image to the array
        }
    }

    // Check if any images are removed by the user
    if ($request->has('removed_images')) {
        $removedImages = $request->input('removed_images'); // Expecting an array of paths

        // Filter out the removed images from the updated list
        $updatedImages = array_filter($updatedImages, function ($image) use ($removedImages) {
            return !in_array($image, $removedImages);
        });

        // Delete removed images from the server
        foreach ($removedImages as $removedImage) {
            if (file_exists(public_path($removedImage))) {
                unlink(public_path($removedImage));
            }
        }
    }

    // Update the database with the final images
    $validatedData['image'] = json_encode(array_values($updatedImages)); // Re-index the array

    // Update the gallery entry
    if ($gallery->update($validatedData)) {
        session()->flash('success', [
            'icon' => 'success',
            'name' => "{$validatedData['title']} gallery updated successfully."
        ]);
        return response()->json([
            'status' => true,
            'message' => "{$validatedData['title']} gallery updated successfully.",
        ]);
    } else {
        session()->flash('error', [
            'icon' => 'error',
            'name' => "{$validatedData['title']} gallery update failed."
        ]);
        return response()->json([
            'status' => false,
            'message' => 'Gallery update failed!',
        ], 500);
    }
}


    public function delete(Request $request)
    {
        // Find the event
        $gallery = Gallery::findOrFail($request->gallery_id);
        if ($gallery) {
            // Delete the old image if it exists
             // Decode the image JSON to get an array of file paths
        $imagePaths = json_decode($gallery->image, true);

        if (is_array($imagePaths)) {
            foreach ($imagePaths as $filePath) {
                // Check if the file exists and delete it
                if (file_exists(public_path($filePath))) {
                    unlink(public_path($filePath));
                }
            }
        }
        else{
            unlink(public_path($imagePaths));
        }
            // Delete the event
            $gallery->delete();
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Gallery image deleted successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Gallery image deleted successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Gallery image not found."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Gallery image not found.',
            ], 500);
        }
    }
}
