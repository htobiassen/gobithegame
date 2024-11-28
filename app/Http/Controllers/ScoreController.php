<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    // Display the scoreboard
    public function index()
    {
        $scores = Score::orderBy('rocket_level', 'desc')->take(100)->get();
        return view('web.pages.scoreboard', compact('scores'));
    }

    // Store a new score
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|max:255',
            'rocket_level' => 'required|integer'
        ]);

        // Create a new score entry
        Score::create([
            'name' => $request->input('name'),
            'rocket_level' => $request->input('rocket_level')
        ]);

        return response()->json(['message' => 'Score saved successfully']);
    }
}
