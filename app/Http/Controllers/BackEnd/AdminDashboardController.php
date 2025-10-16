<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Auth;
class AdminDashboardController extends Controller
{
    public function index():View{
        $layout_data=LandingPage::first();
      
        $layout_setting = LandingPage::first();
        $page_name = 'Dashboard';
        return view('backEnd.dashboard.index',compact('page_name','layout_data','layout_setting'));
    }
}
