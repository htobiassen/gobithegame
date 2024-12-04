<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Season;

class ScoreController extends Controller
{
    // Display the scoreboard
    public function index(Request $request)
    {
        // Get free leaderboard scores
        $freeScores = Score::where('is_paid', false)
            ->orderBy('score', 'desc')
            ->take(100)
            ->get();

        // Get the current active season for paid leaderboard
        $currentSeason = Season::where('start_date', '<=', now())
            ->where(function ($query) {
                $query->where('end_date', '>=', now())
                    ->orWhereNull('end_date');
            })
            ->first();

        $paidScores = collect(); // Default empty collection for paid leaderboard
        if ($currentSeason) {
            $paidScores = Score::where('season_id', $currentSeason->id)
                ->where('is_paid', true)
                ->orderBy('score', 'desc')
                ->take(100)
                ->get();
        }

        // Pass data to the view
        return view('web.pages.scoreboard', compact('freeScores', 'paidScores', 'currentSeason'));
    }


    // Store a new score
    public function store(Request $request)
    {
        // Cast `is_paid` to a boolean before validation
        $request->merge([
            'is_paid' => filter_var($request->input('is_paid'), FILTER_VALIDATE_BOOLEAN),
        ]);

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'score' => 'required|integer',
            'wallet_address' => 'required|string|max:255',
            'is_paid' => 'required|boolean',
            'payment_amount' => 'required|numeric|min:0',
        ]);

        $isPaid = $request->input('is_paid', false);
        $paymentAmount = $request->input('payment_amount', 0);

        if ($isPaid) {
            // Get the current active season
            $currentSeason = Season::where('start_date', '<=', now())
                ->where(function ($query) {
                    $query->where('end_date', '>=', now())
                        ->orWhereNull('end_date');
                })
                ->first();

            if (!$currentSeason) {
                // Reject paid submissions if no season is active
                return response()->json(['message' => 'No active season for paid playthrough.'], 400);
            }

            // Add allocationPercentage to the prize pool
            $allocationPercentage = $currentSeason->allocation_percentage; // e.g., 75
            $prizePoolIncrement = ($paymentAmount * $allocationPercentage) / 100;
            $currentSeason->prize_pool += $prizePoolIncrement;
            $currentSeason->save();
        }

        $score = Score::create([
            'name' => $request->input('name'),
            'score' => $request->input('score'),
            'wallet_address' => $request->input('wallet_address'),
            'season_id' => $isPaid ? $currentSeason->id : null,
            'is_paid' => $isPaid,
            'payment_amount' => $paymentAmount,
        ]);

        return response()->json(['message' => 'Score saved successfully!'], 200);
    }
}
