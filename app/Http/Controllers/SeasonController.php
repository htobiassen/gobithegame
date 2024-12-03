<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class SeasonController extends Controller
{
    // Show all seasons
    public function index()
    {
        $seasons = Season::orderBy('start_date', 'desc')->get();
        return view('web.pages.seasons', compact('seasons'));
    }

    // Show form to create a new season
    public function create()
    {
        return view('web.pages.create_season');
    }

    // Store a new season
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'allocation_percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Season::create([
            'name' => $request->input('name'),
            'allocation_percentage' => $request->input('allocation_percentage'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('seasons.index')->with('success', 'Season created successfully.');
    }

    // Show a specific season
    public function show(Season $season)
    {
        return view('web.pages.show_season', compact('season'));
    }

    // Update a season
    public function update(Request $request, Season $season)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'allocation_percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $season->update([
            'name' => $request->input('name'),
            'allocation_percentage' => $request->input('allocation_percentage'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('seasons.index')->with('success', 'Season updated successfully.');
    }

    // Delete a season
    public function destroy(Season $season)
    {
        $season->delete();
        return redirect()->route('seasons.index')->with('success', 'Season deleted successfully.');
    }
}
