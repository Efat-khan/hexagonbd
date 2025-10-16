<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    public function index()
    {
        $page_name = 'Setting';
        $layout_data=LandingPage::first();
        // session()->flash('success',[
        //     'icon' => 'success',
        //     'title' => 'Welcome '.Auth::user()->name. '.'
        // ]);
        $layout_setting = LandingPage::first();
        // dd($layout_setting);
        return view('backEnd.setting.landing_page', compact('page_name','layout_data', 'layout_setting'));
    }
    // Logo Create Or Update
    public function logo_store(Request $request)
    {
        // dd($request->all());
        // Validation
        $validatedData = $request->validate([
            'logo_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $validatedData['user_id'] =Auth::id();
        // Image handling
        if ($request->hasFile('logo_image')) {
            $image = $request->file('logo_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('back-end-assets/images/logo_image'), $imageName); // Save image to public/images

            // Save the file path (or update it) in the database
            $validatedData['logo_image'] = 'back-end-assets/images/logo_image/' . $imageName;
        }

        // Create or update database entry
        if ($request->id != null) {
            $record = LandingPage::find($request->id);
            // Update logic
            if ($record) {
                // Delete the old image file if it exists
                if ($record->logo_image && file_exists(public_path($record->logo_image))) {
                    unlink(public_path($record->logo_image));
                }
                $record->update($validatedData);
                // Set a success flash message
                session()->flash('success', [
                    'icon' => 'success',
                    'name' => 'Image updated successfully.'
                ]);

                // Return JSON response
                return response()->json([
                    'status' => true,
                    'message' => "Image updated successfully",
                ]);
            } else {
                session()->flash('error', [
                    'icon' => 'error',
                    'name' => 'Image not updated.'
                ]);

                // Return JSON response
                return response()->json([
                    'status' => false,
                    'message' => "Image not updated.",
                ]);
            }
        } else {
            // Create logic
            LandingPage::create($validatedData);
            session()->flash('success', [
                'icon' => 'success',
                'name' => 'Image uploaded successfully.'
            ]);

            // Return JSON response
            return response()->json([
                'status' => true,
                'message' => "Image uploaded successfully.",
            ]);
        }
    }
    

    // Web Site Info Create Or Update
    public function site_info_store(Request $request)
    {
        // dd($request->all());
        // Validation
        $validatedData = $request->validate([
            'web_title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'fb_link' => 'nullable|url',
            'in_link' => 'nullable|url',
            'x_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'location' => 'nullable|string|max:255',
            'gps_location' => 'nullable',
            'gps_location' => 'nullable',
            'copyright_text' => 'nullable|string|max:255',
            'copyright_link' => 'nullable|url',
            'developer_link' => 'nullable|url',
            'who_we_are_text' => 'nullable|string',
            'who_we_are_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slogan' => 'nullable|string',
            'employees_number' => 'nullable|integer',
            'office_number' => 'nullable|integer',
            'office_time_text' => 'nullable|string',
            'warehouse_number' => 'nullable|integer',
            'successful_project_number' => 'nullable|integer',
            'satisfied_client_percentage_number' => 'nullable|integer',
            'awards_own_number' => 'nullable|integer',
        ]);
        $validatedData['user_id'] =Auth::id();
        if ($request->hasFile('who_we_are_image')) {
            $image = $request->file('who_we_are_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('back-end-assets/images/about_image'), $imageName); // Save image to public/images
            // Save the file path (or update it) in the database
            $validatedData['who_we_are_image'] = 'back-end-assets/images/about_image/' . $imageName;
        }
        // Create or update database entry
        if ($request->id != null) {
            $record = LandingPage::find($request->id);
            // Update logic
            if ($record) {
                $record->update($validatedData);
                // Set a success flash message
                session()->flash('success', [
                    'icon' => 'success',
                    'name' => 'Web Site Info updated successfully.'
                ]);

                // Return JSON response
                return response()->json([
                    'status' => true,
                    'message' => "Web Site Info updated successfully",
                ]);
            } else {
                session()->flash('error', [
                    'icon' => 'error',
                    'name' => 'Web Site Info not updated.'
                ]);

                // Return JSON response
                return response()->json([
                    'status' => false,
                    'message' => "Web Site Info not updated.",
                ]);
            }
        } else {
            // Create logic
            LandingPage::create($validatedData);
            session()->flash('success', [
                'icon' => 'success',
                'name' => 'Web Site Info uploaded successfully.'
            ]);

            // Return JSON response
            return response()->json([
                'status' => true,
                'message' => "Web Site Info uploaded successfully.",
            ]);
        }
    }
    // about Create Or Update
    public function about_store(Request $request)
    {
        // dd($request->all());
        // Validation
        $validatedData = $request->validate([
            'about_title' => 'required|string|max:255',
            'about_sort_description' => 'nullable|string',
            'about_description' => 'required',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);
        $validatedData['user_id'] =Auth::id();
        // Image handling
        if ($request->hasFile('about_image')) {
            $image = $request->file('about_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('back-end-assets/images/about_image'), $imageName); // Save image to public/images

            // Save the file path (or update it) in the database
            $validatedData['about_image'] = 'back-end-assets/images/about_image/' . $imageName;
        }
        // Create or update database entry
        if ($request->id != null) {
            $record = LandingPage::find($request->id);
            // Update logic
            if ($record) {
                // Delete the old image file if it exists
                if ($request->hasFile('about_image')) {
                    if ($record->about_image && file_exists(public_path($record->about_image))) {
                        unlink(public_path($record->about_image));
                    }
                }
                $record->update($validatedData);
                // Set a success flash message
                session()->flash('success', [
                    'icon' => 'success',
                    'name' => 'About updated successfully.'
                ]);

                // Return JSON response
                return response()->json([
                    'status' => true,
                    'message' => "About updated successfully",
                ]);
            } else {
                session()->flash('error', [
                    'icon' => 'error',
                    'name' => 'About not updated.'
                ]);

                // Return JSON response
                return response()->json([
                    'status' => false,
                    'message' => "About not updated.",
                ]);
            }
        } else {
            // Create logic
            LandingPage::create($validatedData);
            session()->flash('success', [
                'icon' => 'success',
                'name' => 'About uploaded successfully.'
            ]);

            // Return JSON response
            return response()->json([
                'status' => true,
                'message' => "About uploaded successfully.",
            ]);
        }
    }
}
