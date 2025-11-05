<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function all_achievement(){
        // dd('ok');
        $achievements = Notification::orderBy('created_at', 'desc')->where('status','active')->get();
        return view('frontEnd.achievement.all_achievement',compact('achievements'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validate query
        if (empty($query) || strlen($query) < 2) {
            return response()->json([], 200); // Return an empty response
        }

        // Perform the search
        $results = Notification::where('title', 'LIKE', "%{$query}%")
        ->orWhere('message', 'LIKE', "%{$query}%")
        ->get();
        return response()->json($results);
    }
    public function all_career(){
        // dd('ok');
        $careers = Notification::orderBy('created_at', 'desc')->where('status','block')->get();
        return view('frontEnd.career.all_career',compact('careers'));
    }
    public function career_search(Request $request)
    {
        $query = $request->input('query');
        // Validate query
        if (empty($query) || strlen($query) < 2) {
            return response()->json([], 200); // Return an empty response
        }
        // Perform the search
        $results = Notification::where('title', 'LIKE', "%{$query}%")
        ->orWhere('message', 'LIKE', "%{$query}%")
        ->get();
        return response()->json($results);
    }
}
