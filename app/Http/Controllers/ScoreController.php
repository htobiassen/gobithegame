<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    // Display the scoreboard
    public function index()
    {
        $scores = Score::orderBy('score', 'desc')->take(100)->get();
        return view('web.pages.scoreboard', compact('scores'));
    }

    // Store a new score
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'score' => 'required|integer',
            'wallet_address' => 'required|string|max:255',
        ]);

        Score::create([
            'name' => $request->input('name'),
            'score' => $request->input('score'),
            'wallet_address' => $request->input('wallet_address'),
        ]);

        return response()->json(['message' => 'Score saved successfully!'], 200);
    }
}
