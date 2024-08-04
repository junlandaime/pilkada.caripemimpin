<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Candidate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalCandidates = Candidate::count();
        $totalRegions = Region::count();
        // $upcomingElections = Election::where('date', '>', now())->count();

        return view('admin.dashboard', compact('totalCandidates', 'totalRegions'));
    }
}
