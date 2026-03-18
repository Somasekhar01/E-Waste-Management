@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0">Device Credits</h1>
            <p class="text-muted">Manage your device recycling credits</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('device-credits.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Device
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if($credits->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-box-open fa-3x text-muted"></i>
                    </div>
                    <h3 class="h5 text-muted">No Device Credits Yet</h3>
                    <p class="text-muted mb-3">Start recycling your devices to earn credits!</p>
                    <a href="{{ route('device-credits.create') }}" class="btn btn-primary">
                        Add Your First Device
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Device Type</th>
                                <th>Model</th>
                                <th>Condition</th>
                                <th>Points</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($credits as $credit)
                                <tr>
                                    <td>{{ $credit->device_type }}</td>
                                    <td>{{ $credit->model }}</td>
                                    <td>
                                        <span class="badge bg-{{ $credit->condition_color }}">
                                            {{ ucfirst($credit->condition) }}
                                        </span>
                                    </td>
                                    <td>{{ $credit->points }}</td>
                                    <td>
                                        <span class="badge bg-{{ $credit->status_color }}">
                                            {{ ucfirst($credit->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $credit->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('device-credits.show', $credit) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-4 py-3 border-top">
                    {{ $credits->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.badge.bg-excellent { background-color: #28a745; }
.badge.bg-good { background-color: #17a2b8; }
.badge.bg-fair { background-color: #ffc107; }
.badge.bg-poor { background-color: #dc3545; }

.badge.bg-pending { background-color: #6c757d; }
.badge.bg-approved { background-color: #28a745; }
.badge.bg-rejected { background-color: #dc3545; }
.badge.bg-redeemed { background-color: #17a2b8; }
</style>
@endsection 