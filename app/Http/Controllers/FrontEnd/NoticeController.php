<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function all_notice(){

        $notices = Notification::orderBy('created_at', 'desc')->get();
        return view('frontEnd.notice.all_notice',compact('notices'));
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
    public function notice($id)
    {
        $notice = Notification::findOrFail($id);
        // dd($panel_member);
        return view('frontEnd.notice.view_notice', compact('notice'));
    }
}
