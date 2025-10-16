<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $layout_data = LandingPage::first();
        $page_name = 'All Students';
        $students = Student::all();
        // dd($students);
        return view('backEnd.student.index', compact('page_name', 'layout_data', 'students'));
    }

    public function create()
    {
        $layout_data = LandingPage::first();
        $page_name = 'Create student';
        // dd($student);
        return view('backEnd.student.create', compact('page_name', 'layout_data'));
    }



    public function store(Request $request)
    {
        // dd($request->all());
        // Validate student-specific data
        $studentData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string|max:500',
            'institute' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'semester' => 'nullable|string|min:1',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $studentData['status'] = 'active';

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('back-end-assets/images/students'), $imageName);
            $studentData['image'] = 'back-end-assets/images/students/' . $imageName;
        }
        // Create the student
        $student = Student::create($studentData);
        // If everything was successful
        session()->flash('success', [
            'icon' => 'success',
            'name' => $studentData['full_name'] . ' added Successfully.',
        ]);

        return response()->json([
            'status' => true,
            'message' => "Student added Successfully.",
        ]);
    }
    public function edit($id)
    {
        $layout_data = LandingPage::first();
        $page_name = 'Edit Student';
        $student = student::findOrFail($id);
          // dd($student);
        return view('backEnd.student.edit', compact('page_name', 'layout_data', 'student'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        // Retrieve the existing student
        $student = Student::findOrFail($request->id);

        // Validate student-specific data
        $studentData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string|max:500',
            'institute' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'semester' => 'nullable|string|min:1',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($student->image && file_exists(public_path($student->image))) {
                unlink(public_path($student->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('back-end-assets/images/students'), $imageName);
            $studentData['image'] = 'back-end-assets/images/students/' . $imageName;
        }
        // Update the student data
        $student->update($studentData);
        // If everything was successful
        session()->flash('success', [
            'icon' => 'success',
            'name' => $studentData['full_name'] . ' updated successfully.',
        ]);

        return response()->json([
            'status' => true,
            'message' => "student updated successfully.",
        ]);
    }

    // Delete student
    public function delete(Request $request)
    {
        $student = Student::findOrFail($request->id);
        // dd($student);
        if (empty($student) && empty($student)) {
            return response()->json([
                'status' => false,
                'msg' => 'Student did not removed.'
            ]);
        } else {
            $student->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Student removed successfully.'
            ]);
        }
    }
}
