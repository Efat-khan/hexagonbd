<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ClientController extends Controller
{
    public function index()
    {
        $layout_data=LandingPage::first();
        $page_name = 'Client';
        $clients = Client::orderBy('created_at', 'desc')->get();
        return view('backEnd.client.index', compact(['page_name','layout_data', 'clients']));
    }

    public function store(Request $request)
    {
        // Validate the main event data
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'alt_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'fb_address' => 'nullable|url|max:255',
            'ln_address' => 'nullable|url|max:255',
            'wp_link' => 'nullable|max:255',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|string|in:active,block',
        ]);
        // Generate a slug from the name
        $slug = Str::slug($validatedData['company_name']);
        // Ensure slug is unique by appending a number if needed
        $originalSlug = $slug;
        $count = 1;
        while (Client::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
         // Add the slug to validated data
        $validatedData['slug'] = $slug;
        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Store the new image and update the file path in validated data
            $fileName = time(). '_' . uniqid().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('back-end-assets/images/client/'), $fileName);
            $filePath = 'back-end-assets/images/client/' . $fileName;
            $validatedData['image'] = $filePath;
        }
        // Create the event
        $client = Client::create($validatedData);
        // Response based on the event creation
        if ($client) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['company_name']} added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['company_name']} added successfully.",
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
        $layout_data=LandingPage::first();
        $client = Client::findOrFail($id);
        if ($client) {
            $page_name = 'Client-Edit';
            return view('backEnd.client.edit', compact(['page_name','layout_data', 'client']));
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        // Find the service
        $client = Client::findOrFail($request->id);

        // Validate the updated data
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'alt_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'fb_address' => 'nullable|url|max:255',
            'ln_address' => 'nullable|url|max:255',
            'wp_link' => 'nullable|max:255',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|string|in:active,block',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old file if it exists
            if ($client->image && file_exists(public_path($client->image))) {
                unlink(public_path($client->image));
            }
            // Store the new file and update the file path in validated data
            $fileName = time(). '_' . uniqid().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('back-end-assets/images/client/'), $fileName);
            $filePath = 'back-end-assets/images/client/' . $fileName;
            $validatedData['image'] = $filePath;
        }
        
        // Response based on the update operation
        if ($client->update($validatedData)) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['company_name']} updated successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['company_name']} updated successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['company_name']} update failed."
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
        $client = Client::findOrFail($request->client_id);
        if ($client) {
            // Delete the old image if it exists
            if ($client->image && file_exists(public_path($client->image))) {
                unlink(public_path($client->image));
            }
            // Delete the event
            $client->delete();
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Notice deleted successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Notice deleted successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Notice not found."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Notice not found.',
            ], 500);
        }
    }
}
