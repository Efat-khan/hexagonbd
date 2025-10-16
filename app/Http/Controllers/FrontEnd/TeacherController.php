<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Advisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvisorController extends Controller
{
    public function all_advisor()
    {
        // Query to find distinct series from the three columns and sort them in descending order
        $distinctSeries = Advisor::select('series')->whereNotNull('series')->orderByRaw("CAST(SUBSTRING_INDEX(series, '-', -1) AS UNSIGNED) DESC")->distinct()->get();
        // dd($distinctSeries);
        return view('frontEnd.advisor.all_advisor', compact('distinctSeries'));
    }

    public function advisor($id)
    {
        $series = $id;
        // dd($panel_member);
        return view('frontEnd.advisor.view_advisor', compact('series'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform the search
        $results = Advisor::where('name', 'LIKE', "%{$query}%") // Adjust 'name' to your searchable field
            ->orWhere('phone', 'LIKE', "%{$query}%") 
            ->orWhere('email', 'LIKE', "%{$query}%") 
            ->get();

        return response()->json($results);
    }
}
