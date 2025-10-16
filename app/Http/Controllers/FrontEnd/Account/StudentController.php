<?php

namespace App\Http\Controllers\FrontEnd\Account;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberBiography;
use App\Models\MemberCareer;
use App\Models\MemberEducationalQualification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class MemberAccountController extends Controller
{
    public function index(): View
    {
        if (Auth::user()->status == 'active') {
            $member = Member::where('user_id', Auth::user()->id)->first();
            $career = MemberCareer::where('user_id', Auth::user()->id)->orderBy('end_year', 'desc')->get();
            $edu = MemberEducationalQualification::where('user_id', Auth::user()->id)->orderBy('year', 'desc')->get();
            session()->flash('success', [
                'icon' => 'success',
                'title' => 'Welcome.'
            ]);
            return view('frontEnd.account.account', compact('career', 'edu', 'member'));
        } else {
            return view('frontEnd.account.membership-form');
        }
    }


    public function store(Request $request)
    {
        // dd($request->all());

        // Use a transaction to ensure both tables are saved togethe
            // Validate member-specific data
            $memberData = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'phone' => 'required|numeric',
                'alt_phone' => 'nullable|numeric',
                'gender' => 'required|in:male,female',
                'dob' => 'nullable|date',
                'blood_group' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
                'nid_or_birth_certificates_no' => 'nullable|string|max:50',
                'address' => 'nullable|string|max:500',
                'post_code' => 'nullable|string|max:10',
                'institute_student_id' => 'required|string|unique:members,institute_student_id',
                'institute_name' => 'nullable|string|max:255',
                'institute_batch' => 'nullable|integer|min:1',
                'institute_department' => 'required|string|max:255',
                'previous_institution' => 'nullable|string|max:255',
                'first_time_society_panel_series' => 'nullable|string|max:255',
                'first_time_society_post' => 'nullable|string|max:255',
                'second_time_society_panel_series' => 'nullable|string|max:255',
                'second_time_society_post' => 'nullable|string|max:255',
                'third_time_society_panel_series' => 'nullable|string|max:255',
                'third_time_society_post' => 'nullable|string|max:255',
                'number_of_time_as_society_executive_member' => 'nullable|integer|min:0',
                'current_work_details' => 'nullable',
                'message' => 'nullable|string|max:1000',
                'advice' => 'nullable|string|max:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'archive' => 'nullable|json',
                'biography' => 'nullable|string|max:2000',
                'fb_account' => 'nullable|url',
                'wa_account' => 'nullable|url',
                'inst_account' => 'nullable|url',
                'x_account' => 'nullable|url',
                'tel_account' => 'nullable|url',
                'ln_account' => 'nullable|url',
                'web_site_link' => 'nullable|url',
            ]);

            // Associate the created user with the member data
            $memberData['admin_id'] = 0;
            $memberData['user_id'] = Auth::user()->id;
            $memberData['name'] = Auth::user()->name;
            $memberData['email'] = Auth::user()->email;

            // Handle image upload
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('back-end-assets/images/members'), $imageName);
                $memberData['image'] = 'back-end-assets/images/members/' . $imageName;
            }
            // Create the member
            Member::create($memberData);
     
            User::where('id', $memberData['user_id'])->update(['status' => 'active']);
        // If everything was successful
        session()->flash('success', [
            'icon' => 'success',
            'title' => $memberData['name'] . ' added Successfully.',
        ]);

        return response()->json([
            'status' => true,
            'message' => "Member added Successfully.",
        ]);
    }
   
    // biography_career_education
    public function biography_career_education_index()
    {
        $member = Member::where('user_id', Auth::user()->id)->first();
        $careers = MemberCareer::where('user_id', Auth::user()->id)->get();
        $educations = MemberEducationalQualification::where('user_id', Auth::user()->id)->get();
        // dd($education);

        return view('frontEnd.account.bio-career-education.index', compact('careers', 'educations', 'member'));
    }
    // Biography update
    public function biography_update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'biography' => 'required',
        ]);

        // Define the attributes to find the user
        $attributes = ['user_id' => Auth::user()->id];

        // Define the values to update or create the Bio
        $values = [
            'biography' => $request->input('biography'),
        ];

        // Use updateOrCreate to find or create the Bio
        $member_biography = Member::updateOrCreate($attributes, $values);

        // Flash success message to the session
        session()->flash('success', [
            'icon' => 'success',
            'title' => 'Biography updated successfully!'
        ]);

        // Return a response
        return redirect()->back();
    }

    // Career update
    public function career_create(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'job_title' => 'required|string',
            'company_name' => 'required|string',
            'start_year' => 'required',
            'end_year' => 'required',
        ]);
        if ($validator->passes()) {
            $career = new MemberCareer();
            $career->user_id = Auth::user()->id;
            $career->job_title = $request->input('job_title');
            $career->company_name = $request->input('company_name');
            $career->company_website = $request->input('company_website');
            $career->start_year = $request->start_year;
            $career->end_year = $request->end_year;
            $career->save();
            // Use Create to create the 
            session()->flash('success', [
                'icon' => 'success',
                'title' => 'Career Added successfully.'
            ]);

            return response()->json([
                'status' => true,
                'message' => "Member Career Added successfully.",
            ]);
        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    // Career Update
    public function career_update(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'careerId' => 'required',
            'job_title' => 'required|string',
            'company_name' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',

        ]);
        if ($validator->passes()) {
            $career = MemberCareer::findOrFail($request->careerId);
            $career->user_id = Auth::user()->id;
            $career->job_title = $request->job_title;
            $career->company_name = $request->company_name;
            $career->company_website = $request->company_website;
            $career->start_year = $request->start_year;
            $career->end_year = $request->end_year;
            $career->save();
            // Use Create to create the 
            session()->flash('success', [
                'icon' => 'success',
                'title' => 'Career Updated successfully.'
            ]);
            return redirect()->back();
        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function career_delete(Request $request)
    {
        // dd($request->all());
        $career = MemberCareer::find($request->id);

        if (empty($career)) {
            session()->flash('error', [
                'icon' => 'error',
                'title' => 'Career Not found.'
            ]);
            // return redirect()->back();
            return response()->json([
                'status' => false,
                'msg' => 'Career did not deleted.'
            ]);
        } else {
            $career->delete();

            return response()->json([
                'status' => true,
                'msg' => 'Career deleted successfully.'
            ]);
        }
    }
    // Edu create
    public function edu_create(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'qualification' => 'required|string',
            'year' => 'required',

        ]);
        if ($validator->passes()) {
            $edu = new MemberEducationalQualification();
            $edu->user_id = Auth::user()->id;
            $edu->qualification = $request->input('qualification');
            $edu->year = $request->year;
            $edu->save();
            // Use Create to create the 

            session()->flash('success', [
                'icon' => 'success',
                'title' => 'You are Educational Qualification created successfully.'
            ]);
            return response([
                'status' => true,
                'message' => 'You are Educational Qualification created successfully.',
            ]);
        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    //edu Update
    public function edu_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eduId' => 'required',
            'eduQualification' => 'required|string',
            'eduYear' => 'required',

        ]);
        if ($validator->passes()) {
            $edu = MemberEducationalQualification::findOrFail($request->eduId);
            $edu->user_id = Auth::user()->id;
            $edu->qualification = $request->input('eduQualification');
            $edu->year = $request->eduYear;
            $edu->save();
            // Use Create to create the 
            session()->flash('success', [
                'icon' => 'success',
                'title' => 'You are Educational Qualification Updated successfully.'
            ]);
            return redirect()->back();
        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    // Educational qualification Delete
    public function edu_delete(Request $request)
    {
        // dd($id);
        $edu = MemberEducationalQualification::findOrFail($request->id);

        if (empty($edu)) {

            return response()->json([
                'status' => false,
                'msg' => 'Educational Qualification did not deleted.'
            ]);
        } else {
            $edu->delete();

            return response()->json([
                'status' => true,
                'msg' => 'Educational Qualification deleted successfully.'
            ]);
        }
    }
    // Member info update
    public function info_index()
    {
        $member = Member::where('user_id', Auth::user()->id)->first();
        return view('frontEnd.account.member-info.index', compact('member'));
    }
    public function info_update(Request $request)
    {
        dd($request->all());
        // Retrieve the existing user
        $user = User::findOrFail($request->user_id);

        // Validate the user data
        $userData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($request->user_id ?? 'NULL') . ',id',
            'role' => 'nullable',
            'status' => 'nullable',
            'email_verified_at' => 'nullable',
        ]);

        $userData['email_verified_at'] = Carbon::now();

        // Update the user
        $user->update($userData);

        // Validate member-specific data
        $memberData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'alt_phone' => 'nullable|numeric',
            'gender' => 'required|in:male,female',
            'admin_id' => 'required',
            'dob' => 'nullable|date',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'nid_or_birth_certificates_no' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'post_code' => 'nullable|string|max:10',
            'institute_student_id' => 'required|string|unique:members,institute_student_id,' . ($request->id ?? 'NULL') . ',id',
            'institute_name' => 'nullable|string|max:255',
            'institute_batch' => 'nullable|integer|min:1',
            'institute_department' => 'required|string|max:255',
            'previous_institution' => 'nullable|string|max:255',
            'first_time_society_panel_series' => 'nullable|string|max:255',
            'first_time_society_post' => 'nullable|string|max:255',
            'second_time_society_panel_series' => 'nullable|string|max:255',
            'second_time_society_post' => 'nullable|string|max:255',
            'third_time_society_panel_series' => 'nullable|string|max:255',
            'third_time_society_post' => 'nullable|string|max:255',
            'number_of_time_as_society_executive_member' => 'nullable|integer|min:0',
            'current_work_details' => 'nullable',
            'message' => 'nullable|string|max:1000',
            'advice' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archive' => 'nullable|json',
            'biography' => 'nullable|string|max:2000',
            'fb_account' => 'nullable|url',
            'wa_account' => 'nullable|url',
            'inst_account' => 'nullable|url',
            'x_account' => 'nullable|url',
            'tel_account' => 'nullable|url',
            'ln_account' => 'nullable|url',
            'web_site_link' => 'nullable|url',
        ]);

        // Associate the existing user with the member data
        $member = Member::where('user_id', $user->id)->first();
        if (!$member) {
            // If the member does not exist, create a new one
            $memberData['user_id'] = $user->id;
            $member = Member::create($memberData);
        } else {
            // Update the existing member
            $member->update($memberData);
        }



        session()->flash('success', [
            'icon' => 'success',
            'title' => $userData['name'] . ' updated successfully.',
        ]);

        return response()->json([
            'status' => true,
            'message' => "Member updated successfully.",
        ]);
    }
}
