<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\CourseFaq;
use App\Models\Event;
use App\Models\Order;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherCourses;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $courses = $query->latest()->paginate(9); // paginate for better UX
        $categories = Category::all();

        return view('frontEnd.course.index', compact('courses', 'categories'));
    }
    public function show($id)
    {
        $course = Course::findOrFail($id);
        $course_teachers = TeacherCourses::where('course_id',$id)->pluck('teacher_id');
        $course_testimonials = Contact::where('course_id',$id)->where('status',1)->get();
        $teachers = Teacher::whereIn('id',$course_teachers)->get();
        $faqs = CourseFaq::where('course_id',$id)->where('status',1)->get();
        return view('frontEnd.course.show', compact('course','teachers','course_testimonials','faqs'));
    }

   public function store(Request $request)
   {
    // Check for duplicate enrollment using phone + course_id
    $existingStudent = Student::where('phone', $request->phone)->first();

    if ($existingStudent) {
        $alreadyEnrolled = Order::where('student_id', $existingStudent->id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($alreadyEnrolled) {
                session()->flash('warning', [
                    'icon' => 'warning',
                    'name' => "You have already enrolled in this course with this phone number.",
                ]);
                return redirect()->back();
            // return response()->json([
            //     'status' => false,
            //     'message' => "You have already enrolled in this course with this phone number.",
            // ]);
        }
    }

    // Validate student-specific data
    $studentData = $request->validate([
        'full_name'     => 'required|string|max:255',
        'phone'         => 'required|string',
        'email'         => 'nullable|email',
        'gender'        => 'required|in:male,female',
        'address'       => 'nullable|string|max:500',
        'institute'     => 'required|string|max:255',
        'department'    => 'nullable|string|max:255',
        'semester'      => 'nullable|string|min:1',
        'father_name'   => 'required|string|max:255',
        'mother_name'   => 'required|string|max:255',
        'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $studentData['status'] = 'block';

    // Handle image upload
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('back-end-assets/images/students'), $imageName);
        $studentData['image'] = 'back-end-assets/images/students/' . $imageName;
    }

    // Reuse existing student or create a new one
    $student = $existingStudent ?? Student::create($studentData);

    if (!$student) {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Student creation failed.",
            ]);
            return redirect()->back();
        // return response()->json([
        //     'status' => false,
        //     'message' => "Student creation failed.",
        // ]);
    }

    // Validate order-specific data
    $orderValidation = $request->validate([
        'course_id'       => 'required|exists:courses,id',
        'amount'          => 'required|numeric|min:0',
        'payment_method'  => 'required',
        'sender_number'   => 'required|string|max:15',
        'transaction_id'  => 'required|string|max:255|unique:orders,transaction_id',
        'notes'           => 'nullable',
        'status'          => 'nullable',
    ]);

    $orderValidation['student_id'] = $student->id;
    $orderValidation['order_tracking_id'] = 'ENROLL-'.Carbon::now()->format('Ymd');
    $order = Order::create($orderValidation);

    if (!$order) {
        session()->flash('error', [
                'icon' => 'error',
                'name' => "Enrollment failed.",
            ]);
        return redirect()->back();
    }

    // session()->flash('success', [
    //     'icon' => 'success',
    //     'name' => $studentData['full_name'] . ' Enrolled Successfully.',
    // ]);
    return view('frontEnd.course.enroll-confermation-msg',compact('order'));
}
    public function enroll($id)
    {
        //dd($id);
        $course = Course::findOrFail($id);
        return view('frontEnd.course.enroll', compact('course'));
    }
}
