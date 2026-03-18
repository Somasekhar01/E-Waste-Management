<?php

namespace App\Http\Controllers;

use App\Models\DeviceCredit;
use Illuminate\Http\Request;

class DeviceCreditsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of device credits.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $credits = DeviceCredit::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('device-credits.index', compact('credits'));
    }

    /**
     * Show the form for creating a new device credit.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('device-credits.create');
    }

    /**
     * Store a newly created device credit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_type' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'condition' => 'required|string|in:excellent,good,fair,poor',
            'description' => 'nullable|string|max:1000',
        ]);

        $credit = DeviceCredit::create([
            'user_id' => auth()->id(),
            'device_type' => $validated['device_type'],
            'model' => $validated['model'],
            'condition' => $validated['condition'],
            'description' => $validated['description'],
            'points' => $this->calculatePoints($validated['condition']),
            'status' => 'pending',
        ]);

        return redirect()->route('device-credits.show', $credit)
            ->with('success', 'Device credit request submitted successfully!');
    }

    /**
     * Display the specified device credit.
     *
     * @param  \App\Models\DeviceCredit  $deviceCredit
     * @return \Illuminate\View\View
     */
    public function show(DeviceCredit $deviceCredit)
    {
        $this->authorize('view', $deviceCredit);
        return view('device-credits.show', compact('deviceCredit'));
    }

    /**
     * Calculate points based on device condition.
     *
     * @param  string  $condition
     * @return int
     */
    private function calculatePoints($condition)
    {
        return match ($condition) {
            'excellent' => 100,
            'good' => 75,
            'fair' => 50,
            'poor' => 25,
            default => 0,
        };
    }
}
