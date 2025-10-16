<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseFaq;
use App\Models\CourseResource;
use App\Models\CourseTimeline;
use App\Models\Gallery;
use App\Models\LandingPage;
use App\Models\Teacher;
use App\Models\TeacherCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CourseController extends Controller
{
    public function index()
    {
        $layout_data=LandingPage::first();
        $course_categories = Category::all();
        $page_name = 'Course';
        $courses = Course::orderBy('date', 'desc')->get();
        return view('backEnd.course.index', compact(['page_name','layout_data', 'courses', 'course_categories']));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the course data
        $validatedData = $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'total_batch' => 'nullable|numeric',
            'number_of_student_per_batch' => 'nullable|numeric',
            'number_of_student_per_batch' => 'nullable|numeric',
            'regular_price' => 'nullable|numeric',
            'discounted_price' => 'nullable|numeric',
            'course_type' => 'required|string|in:online,offline',
            'sort_description' => 'required|string',
            'description' => 'nullable|string',
            'reg_status' => 'required|boolean',
            'popular_course' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            'status' => 'required|string|in:active,block',
        ]);
        // Generate a slug from the name
        $slug = Str::slug($validatedData['name']);
        // Ensure slug is unique by appending a number if needed
        $originalSlug = $slug;
        $count = 1;
        while (Course::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        // course code generation
        $course_code = 'C-' . strtoupper(Str::random(6));
        // Add the course code to validated data
        $validatedData['corse_code'] = $course_code;
        // Add the slug to validated data
        $validatedData['slug'] = $slug;
        //image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back-end-assets/images/course'), $imageName);
            $validatedData['image'] = 'back-end-assets/images/course/' . $imageName;
        } else {
            $validatedData['image'] = null; // Set to null if no image is uploaded
        }
        // dd($validatedData);
        $course = Course::create($validatedData);
        
        // Response based on the course creation
        if ($course) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['name']} Course added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['name']} Course added successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['name']} Course added successfully."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Course not added!',
            ], 500);
        }
    }

    public function edit($id, Request $request)
    {
        $course = Course::find($id);
        $teachers = Teacher::all();
        $course_categories = Category::all();
        if ($course) {
            $page_name = 'Course-Edit';
            $layout_data=LandingPage::first();
            return view('backEnd.course.edit', compact(['page_name','layout_data', 'course', 'course_categories','teachers']));
        }
    }

    public function update(Request $request)
    {
        $course = Course::findOrFail($request->id);

        $validatedData = $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'total_batch' => 'nullable|numeric',
            'number_of_student_per_batch' => 'nullable|numeric',
            'regular_price' => 'nullable|numeric',
            'discounted_price' => 'nullable|numeric',
            'course_type' => 'required|string|in:online,offline',
            'sort_description' => 'required|string',
            'description' => 'nullable|string',
            'reg_status' => 'required|boolean',
            'popular_course' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:active,block',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($course->image && file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }

            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back-end-assets/images/course'), $imageName);
            $validatedData['image'] = 'back-end-assets/images/course/' . $imageName;
        }
        $course->update($validatedData);

        session()->flash('success', [
            'icon' => 'success',
            'name' => "{$validatedData['name']} course updated successfully."
        ]);

        return response()->json([
            'status' => true,
            'message' => "{$validatedData['name']} course updated successfully.",
        ], 200);
    }


    // Course Delete
    public function delete(Request $request)
    {
        // dd($request->all());
        // Find the course
        $course = Course::findOrFail($request->Course_id);
        if ($course) {
            if ($course->image && file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }
            // Delete the Course
            $course->delete();
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Course deleted successfully."
            ]);
            // Successful response
            return response()->json([
                'status' => true,
                'message' => 'Course deleted successfully.',
            ], 200);
        }
    }
    // course FAQ Store
    public function store_faq(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required',
            'question' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required',
        ]);

        // Store course in the database
        if (CourseFaq::create($validatedData)) {

            session()->flash('success', [
                'icon' => 'success',
                'name' => 'FAQ added Successfully.'
            ]);
            return response()->json([
                'status' => true,
                'message' => "FAQ added Successfully.",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "FAQ not added !!",
            ]);
        }
    }
    // course Timeline Update
    public function update_faq(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'course_id' => 'required',
            'question' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required',
        ]);
        $course_faq = courseFaq::find($request->id);
        if (!$course_faq) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'FAQ not updated.'
            ]);
            return redirect()->back();
        }

        // Update course timeline with validated data only
        $course_faq_update = $course_faq->update($validatedData);
        if (!$course_faq_update) {
            // Set a error flash message
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'FAQ missing information.'
            ]);
        } else {
            // Set a success flash message
            session()->flash('success', [
                'icon' => 'success',
                'name' => 'FAQ updated successfully.'
            ]);
        }

        // Return JSON response
        return redirect()->back();
    }
    // course FAQ Delete
    public function delete_faq(Request $request)
    {
        // dd($request->all());
        $course_faq = courseFaq::find($request->course_faq_id);

        if (empty($course_faq)) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'FAQ Not found.'
            ]);
            // return redirect()->back();
            return response()->json([
                'status' => false,
                'msg' => 'FAQ Not found.'
            ]);
        } else {
            $course_faq->delete();

            return response()->json([
                'status' => true,
                'msg' => 'FAQ deleted successfully.'
            ]);
        }
    }
    // course Timeline Store
    public function store_timeline(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Store course in the database
        if (CourseTimeline::create($validatedData)) {

            session()->flash('success', [
                'icon' => 'success',
                'name' => $validatedData['name'] . ' course timeline added Successfully.'
            ]);
            return response()->json([
                'status' => true,
                'message' => "course timeline added Successfully.",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "course timeline not added !!",
            ]);
        }
    }
    // course Timeline Update
    public function update_timeline(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'course_id' => 'required',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
        ]);
        $course_timeline = courseTimeline::find($request->id);
        if (!$course_timeline) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => $validatedData['name'] . ' course time line did not updated.'
            ]);
            return redirect()->back();
        }

        // Update course timeline with validated data only
        $course_timeline_update = $course_timeline->update($validatedData);
        if (!$course_timeline_update) {
            // Set a error flash message
            session()->flash('error', [
                'icon' => 'error',
                'name' => $validatedData['name'] . ' course time line missing information.'
            ]);
        } else {
            // Set a success flash message
            session()->flash('success', [
                'icon' => 'success',
                'name' => $validatedData['name'] . ' course time line updated successfully.'
            ]);
        }

        // Return JSON response
        return redirect()->back();
    }

    // course Timeline Delete
    public function delete_timeline(Request $request)
    {
        // dd($request->all());
        $course_timeline = courseTimeline::find($request->course_timeline_id);

        if (empty($course_timeline)) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'course Timeline Not found.'
            ]);
            // return redirect()->back();
            return response()->json([
                'status' => false,
                'msg' => 'course Timeline Not found.'
            ]);
        } else {
            $course_timeline->delete();

            return response()->json([
                'status' => true,
                'msg' => 'course Timeline deleted successfully.'
            ]);
        }
    }
    // course Resource Store
    public function store_resource(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required',
            'resource_link' => 'required|string|',
            'status' => 'required',
        ]);

        // Store course in the database
        if (CourseResource::create($validatedData)) {

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
            'course_id' => 'required|integer|exists:courses,id', // Ensure the course exists
            'resource_link' => 'required|string|url', // Validate as a valid URL
            'status' => 'required|string|in:active,blocked', // Status must be 'active' or 'blocked'
        ]);
        $course_resource = courseResource::find($request->id);
        if (!$course_resource) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'Resource not updated.'
            ]);
            return redirect()->back();
        }
        // Update course resource with validated data only
        $course_resource_update = $course_resource->update($validatedData);
        if ($course_resource_update) {
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
        $course_resource = courseResource::find($request->course_resource_id);

        if (empty($course_resource)) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'Course Resource Not found.'
            ]);
            // return redirect()->back();
            return response()->json([
                'status' => false,
                'msg' => 'Course Resource Not found.'
            ]);
        } else {
            $course_resource->delete();

            return response()->json([
                'status' => true,
                'msg' => 'Course Resource deleted successfully.'
            ]);
        }
    }
    // course Resource Store
    public function store_teacher(Request $request)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required',
            'course_id' => 'required',
        ]);

        // Store course in the database
        if (TeacherCourses::create($validatedData)) {

            session()->flash('success', [
                'icon' => 'success',
                'name' => 'Course teacher added Successfully.'
            ]);
            return response()->json([
                'status' => true,
                'message' => "Course teacher added Successfully.",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Course teacher not added !!",
            ]);
        }
    }
    // course Resource Update
    public function update_teacher(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'teacher_id' => 'required',
            'course_id' => 'required',
        ]);
        $course_teacher = TeacherCourses::find($request->id);
        if (!$course_teacher) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'Course teacher not updated.'
            ]);
            return redirect()->back();
        }
        // Update course resource with validated data only
        $course_teacher_update = $course_teacher->update($validatedData);
        if ($course_teacher_update) {
            // Set a success flash message
            session()->flash('success', [
                'icon' => 'success',
                'name' => 'Course teacher updated successfully.'
            ]);
        } else {
            // Set a error flash message
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'Course teacher missing information.'
            ]);
        }
        // Return JSON response
        return redirect()->back();
    }

    // course Resource Delete
    public function delete_teacher(Request $request)
    {
        // dd($request->all());
        $course_teacher = TeacherCourses::find($request->course_teacher_id);

        if (empty($course_teacher)) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => 'Course teacher Not found.'
            ]);
            // return redirect()->back();
            return response()->json([
                'status' => false,
                'msg' => 'Course teacher Not found.'
            ]);
        } else {
            $course_teacher->delete();

            return response()->json([
                'status' => true,
                'msg' => 'Course teacher deleted successfully.'
            ]);
        }
    }
}
