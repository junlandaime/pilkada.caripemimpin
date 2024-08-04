<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Region;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Get upcoming elections
        $upcomingElections = Candidate::select('region_id', 'position', 'election_date')
            ->distinct()
            ->where('election_date', '>', now())
            ->orderBy('election_date')
            ->take(5)
            ->get();

        // Get featured candidates
        $featuredCandidates = Candidate::inRandomOrder()
            ->take(4)
            ->get();

        // Get list of regions
        $regions = Region::all();

        // Get total candidates count
        $totalCandidates = Candidate::count();

        return view('home', compact('upcomingElections', 'featuredCandidates', 'regions', 'totalCandidates'));
    }

    public function about()
    {
        // $regions = Region::withCount('candidates')->paginate(15);
        return view('about');
    }
}
