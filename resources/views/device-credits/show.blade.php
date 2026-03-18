@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <h2 class="card-title mb-0">Device Credit Details</h2>
                            <span class="badge bg-{{ $deviceCredit->is_redeemed ? 'success' : 'warning' }}">
                                {{ $deviceCredit->is_redeemed ? 'Redeemed' : 'Available' }}
                            </span>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-muted">Device Information</h5>
                                <dl class="row">
                                    <dt class="col-sm-4">Type</dt>
                                    <dd class="col-sm-8">{{ ucfirst($deviceCredit->device_type) }}</dd>

                                    <dt class="col-sm-4">Model</dt>
                                    <dd class="col-sm-8">{{ $deviceCredit->model }}</dd>

                                    <dt class="col-sm-4">Condition</dt>
                                    <dd class="col-sm-8">
                                        <span class="badge bg-{{ $deviceCredit->condition === 'excellent' ? 'success' : ($deviceCredit->condition === 'good' ? 'info' : ($deviceCredit->condition === 'fair' ? 'warning' : 'danger')) }}">
                                            {{ ucfirst($deviceCredit->condition) }}
                                        </span>
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-muted">Credit Information</h5>
                                <dl class="row">
                                    <dt class="col-sm-4">Points</dt>
                                    <dd class="col-sm-8">{{ $deviceCredit->credit_points }}</dd>

                                    <dt class="col-sm-4">Submitted</dt>
                                    <dd class="col-sm-8">{{ $deviceCredit->created_at->format('F j, Y') }}</dd>

                                    @if($deviceCredit->is_redeemed)
                                        <dt class="col-sm-4">Redeemed</dt>
                                        <dd class="col-sm-8">{{ $deviceCredit->redeemed_at->format('F j, Y') }}</dd>
                                    @endif
                                </dl>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-muted">Additional Details</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <dl class="row mb-0">
                                        @if(isset($deviceCredit->device_details['manufacturer']))
                                            <dt class="col-sm-4">Manufacturer</dt>
                                            <dd class="col-sm-8">{{ $deviceCredit->device_details['manufacturer'] }}</dd>
                                        @endif

                                        @if(isset($deviceCredit->device_details['year']))
                                            <dt class="col-sm-4">Year</dt>
                                            <dd class="col-sm-8">{{ $deviceCredit->device_details['year'] }}</dd>
                                        @endif

                                        @if(isset($deviceCredit->device_details['specifications']))
                                            <dt class="col-sm-4">Specifications</dt>
                                            <dd class="col-sm-8">{{ $deviceCredit->device_details['specifications'] }}</dd>
                                        @endif

                                        @if(isset($deviceCredit->device_details['issues']))
                                            <dt class="col-sm-4">Known Issues</dt>
                                            <dd class="col-sm-8">{{ $deviceCredit->device_details['issues'] }}</dd>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('device-credits.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            @if(!$deviceCredit->is_redeemed)
                                <form action="{{ route('device-credits.redeem', $deviceCredit) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to redeem these credits?')">
                                        <i class="fas fa-check"></i> Redeem Credits
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 