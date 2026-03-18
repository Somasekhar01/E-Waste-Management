<?php

namespace App\Http\Controllers;

use App\Models\DeviceCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceCreditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $credits = DeviceCredit::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('device-credits.index', compact('credits'));
    }

    public function create()
    {
        return view('device-credits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_type' => 'required|string',
            'model' => 'required|string',
            'condition' => 'required|string',
            'device_details' => 'required|array',
        ]);

        $creditPoints = $this->calculateCreditPoints(
            $validated['device_type'],
            $validated['condition']
        );

        $deviceCredit = DeviceCredit::create([
            'user_id' => Auth::id(),
            'device_type' => $validated['device_type'],
            'model' => $validated['model'],
            'condition' => $validated['condition'],
            'credit_points' => $creditPoints,
            'device_details' => $validated['device_details'],
        ]);

        return redirect()->route('device-credits.show', $deviceCredit)
            ->with('success', 'Device credit request submitted successfully!');
    }

    public function show(DeviceCredit $deviceCredit)
    {
        $this->authorize('view', $deviceCredit);
        return view('device-credits.show', compact('deviceCredit'));
    }

    public function redeem(DeviceCredit $deviceCredit)
    {
        $this->authorize('redeem', $deviceCredit);

        if ($deviceCredit->is_redeemed) {
            return back()->with('error', 'This credit has already been redeemed.');
        }

        $deviceCredit->update([
            'is_redeemed' => true,
            'redeemed_at' => now(),
        ]);

        return back()->with('success', 'Credit points redeemed successfully!');
    }

    private function calculateCreditPoints($deviceType, $condition)
    {
        $basePoints = [
            'smartphone' => 100,
            'laptop' => 200,
            'tablet' => 150,
            'desktop' => 250,
            'other' => 50,
        ];

        $conditionMultiplier = [
            'excellent' => 1.2,
            'good' => 1.0,
            'fair' => 0.8,
            'poor' => 0.5,
        ];

        $base = $basePoints[$deviceType] ?? $basePoints['other'];
        $multiplier = $conditionMultiplier[$condition] ?? $conditionMultiplier['fair'];

        return round($base * $multiplier);
    }
} 