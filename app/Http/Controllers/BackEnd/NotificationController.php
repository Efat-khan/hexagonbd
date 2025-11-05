<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $layout_data=LandingPage::first();
        $page_name = 'Notification';
        $notification = Notification::orderBy('created_at', 'desc')->get();
        return view('backEnd.notification.index', compact(['page_name','layout_data', 'notification']));
    }

    public function store(Request $request)
    {
        // Validate the main event data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'link' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10048',
            'status' => 'required|string|in:active,block',
        ]);

        $validatedData['user_id'] = Auth::id();

        // Handle file upload if present
        if ($request->hasFile('file')) {
            // Store the new image and update the file path in validated data
            $fileName = time(). '_' . uniqid().'_'.$request->file->getClientOriginalName();
            $request->file->move(public_path('back-end-assets/notice'), $fileName);
            $filePath = 'back-end-assets/notice/' . $fileName;
            $validatedData['file'] = $filePath;
        }
        // Create the event
        $notification = Notification::create($validatedData);
        // Response based on the event creation

        if ($notification) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Achievement/ Career added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Achievement added successfully!',
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Achievement/ Career/ Career not added!"
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Achievement/ Career not added!',
            ], 500);
        }
    }
    public function edit($id)
    {
        $layout_data=LandingPage::first();
        $notification = Notification::findOrFail($id);
        if ($notification) {
            $page_name = 'Notification-Edit';
            return view('backEnd.notification.edit', compact(['page_name','layout_data', 'notification']));
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        // Find the service
        $notification = Notification::findOrFail($request->id);

        // Validate the updated data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'link' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10048',
            'status' => 'required|string|in:active,block',
        ]);

        $validatedData['user_id'] = Auth::id();
        // Handle file upload if present
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($notification->file && file_exists(public_path($notification->file))) {
                unlink(public_path($notification->file));
            }
            // Store the new file and update the file path in validated data
            $fileName = time(). '_' . uniqid().'_'.$request->file->getClientOriginalName();
            $request->file->move(public_path('back-end-assets/notice'), $fileName);
            $filePath = 'back-end-assets/notice/' . $fileName;
            $validatedData['file'] = $filePath;
        }
        
        // Response based on the update operation
        if ($notification->update($validatedData)) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Updated successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Updated successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Update failed."
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
        $notice = Notification::findOrFail($request->notice_id);
        if ($notice) {
            // Delete the old image if it exists
            if ($notice->file && file_exists(public_path($notice->file))) {
                unlink(public_path($notice->file));
            }
            // Delete the event
            $notice->delete();
            session()->flash('success', [
                'icon' => 'success',
                'title' => "Achievement/ Career deleted successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Achievement/ Career deleted successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'title' => "Achievement/ Career not found."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Achievement/ Career not found.',
            ], 500);
        }
    }
}
