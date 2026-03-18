<?php

namespace App\Http\Controllers;

use App\Models\RecyclingHistory;
use App\Models\RecyclingFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecyclingHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $history = RecyclingHistory::where('user_id', Auth::id())
            ->with('facility')
            ->latest('recycling_date')
            ->paginate(10);

        $totalCarbonReduction = RecyclingHistory::where('user_id', Auth::id())
            ->sum('carbon_footprint_reduction');

        return view('recycling-history.index', compact('history', 'totalCarbonReduction'));
    }

    public function create()
    {
        $facilities = RecyclingFacility::where('is_active', true)->get();
        return view('recycling-history.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:recycling_facilities,id',
            'recycling_date' => 'required|date',
            'device_type' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $carbonReduction = $this->calculateCarbonReduction(
            $validated['device_type'],
            $validated['quantity']
        );

        $history = RecyclingHistory::create([
            'user_id' => Auth::id(),
            'facility_id' => $validated['facility_id'],
            'recycling_date' => $validated['recycling_date'],
            'device_type' => $validated['device_type'],
            'quantity' => $validated['quantity'],
            'carbon_footprint_reduction' => $carbonReduction,
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('recycling-history.show', $history)
            ->with('success', 'Recycling record added successfully!');
    }

    public function show(RecyclingHistory $history)
    {
        $this->authorize('view', $history);
        return view('recycling-history.show', compact('history'));
    }

    private function calculateCarbonReduction($deviceType, $quantity)
    {
        $carbonFactors = [
            'smartphone' => 0.5,
            'laptop' => 1.2,
            'tablet' => 0.8,
            'desktop' => 1.5,
            'other' => 0.3,
        ];

        $factor = $carbonFactors[$deviceType] ?? $carbonFactors['other'];
        return round($factor * $quantity, 2);
    }
} 