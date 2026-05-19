<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the main landing page with leaderboard and candidates.
     */
    public function index()
    {
        // Get all candidates
        $candidates = Candidate::orderBy('candidate_number', 'asc')->get();

        // Separate by gender and order by votes descending for leaderboard
        $putraLeaderboard = Candidate::where('gender', 'putra')
            ->orderBy('current_votes', 'desc')
            ->orderBy('candidate_number', 'asc')
            ->get();

        $putriLeaderboard = Candidate::where('gender', 'putri')
            ->orderBy('current_votes', 'desc')
            ->orderBy('candidate_number', 'asc')
            ->get();

        // Calculate global statistics
        $totalVotes = Candidate::sum('current_votes');
        $totalCandidates = Candidate::count();
        $totalFaculties = Candidate::distinct('faculty')->count();

        // Get Top 3 for Podium
        $podiumPutra = $putraLeaderboard->take(3)->values();
        $podiumPutri = $putriLeaderboard->take(3)->values();

        // Reorder top 3 for aesthetic podium display: [Silver (Rank 2), Gold (Rank 1), Bronze (Rank 3)]
        $podiumPutraAesthetic = collect();
        if ($podiumPutra->has(1)) $podiumPutraAesthetic->push($podiumPutra[1]); // 2nd
        if ($podiumPutra->has(0)) $podiumPutraAesthetic->push($podiumPutra[0]); // 1st
        if ($podiumPutra->has(2)) $podiumPutraAesthetic->push($podiumPutra[2]); // 3rd

        $podiumPutriAesthetic = collect();
        if ($podiumPutri->has(1)) $podiumPutriAesthetic->push($podiumPutri[1]); // 2nd
        if ($podiumPutri->has(0)) $podiumPutriAesthetic->push($podiumPutri[0]); // 1st
        if ($podiumPutri->has(2)) $podiumPutriAesthetic->push($podiumPutri[2]); // 3rd

        return view('welcome', compact(
            'candidates',
            'putraLeaderboard',
            'putriLeaderboard',
            'podiumPutraAesthetic',
            'podiumPutriAesthetic',
            'totalVotes',
            'totalCandidates',
            'totalFaculties'
        ));
    }

    /**
     * AJAX endpoint to get candidate details.
     */
    public function show($id)
    {
        $candidate = Candidate::findOrFail($id);
        
        // Decode mission if stored as JSON
        $missions = json_decode($candidate->mission);
        if (!$missions) {
            $missions = [$candidate->mission];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $candidate->id,
                'candidate_number' => $candidate->candidate_number,
                'name' => $candidate->name,
                'gender' => $candidate->gender,
                'faculty' => $candidate->faculty,
                'prodi' => $candidate->prodi,
                'photo_path' => $candidate->photo_path,
                'bio' => $candidate->bio,
                'vision' => $candidate->vision,
                'missions' => $missions,
                'current_votes' => $candidate->current_votes
            ]
        ]);
    }
}
