@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="card-title h4 mb-4">Submit Device for Recycling</h2>

                    <form method="POST" action="{{ route('device-credits.store') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="device_type" class="form-label">Device Type</label>
                            <select class="form-select @error('device_type') is-invalid @enderror" 
                                    id="device_type" name="device_type" required>
                                <option value="">Select Device Type</option>
                                <option value="smartphone" {{ old('device_type') == 'smartphone' ? 'selected' : '' }}>Smartphone</option>
                                <option value="tablet" {{ old('device_type') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                <option value="laptop" {{ old('device_type') == 'laptop' ? 'selected' : '' }}>Laptop</option>
                                <option value="desktop" {{ old('device_type') == 'desktop' ? 'selected' : '' }}>Desktop Computer</option>
                                <option value="printer" {{ old('device_type') == 'printer' ? 'selected' : '' }}>Printer</option>
                                <option value="monitor" {{ old('device_type') == 'monitor' ? 'selected' : '' }}>Monitor</option>
                                <option value="other" {{ old('device_type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('device_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="model" class="form-label">Model Name/Number</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                   id="model" name="model" value="{{ old('model') }}" 
                                   placeholder="e.g. iPhone 12, Dell XPS 13" required>
                            @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Device Condition</label>
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="condition" 
                                           id="condition_excellent" value="excellent" 
                                           {{ old('condition') == 'excellent' ? 'checked' : '' }} required>
                                    <label class="btn btn-outline-success w-100" for="condition_excellent">
                                        Excellent
                                    </label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="condition" 
                                           id="condition_good" value="good"
                                           {{ old('condition') == 'good' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-info w-100" for="condition_good">
                                        Good
                                    </label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="condition" 
                                           id="condition_fair" value="fair"
                                           {{ old('condition') == 'fair' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning w-100" for="condition_fair">
                                        Fair
                                    </label>
                                </div>
                                <div class="col-6 col-md-3">
                                    <input type="radio" class="btn-check" name="condition" 
                                           id="condition_poor" value="poor"
                                           {{ old('condition') == 'poor' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger w-100" for="condition_poor">
                                        Poor
                                    </label>
                                </div>
                            </div>
                            @error('condition')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Additional Details</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Describe the current state of your device, any defects, etc.">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('device-credits.index') }}" class="btn btn-link text-muted">
                                <i class="fas fa-arrow-left me-2"></i>Back to Credits
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Submit Device
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4 shadow-sm">
                <div class="card-body">
                    <h3 class="h5 mb-3">Points Guide</h3>
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Condition</th>
                                    <th>Points</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-success">Excellent</span></td>
                                    <td>100 points</td>
                                    <td>Like new, fully functional with minimal wear</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-info">Good</span></td>
                                    <td>75 points</td>
                                    <td>Working perfectly with some signs of use</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-warning">Fair</span></td>
                                    <td>50 points</td>
                                    <td>Working with noticeable wear and minor issues</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">Poor</span></td>
                                    <td>25 points</td>
                                    <td>Significant damage but still recyclable</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-check:checked + .btn-outline-success {
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}

.btn-check:checked + .btn-outline-info {
    background-color: #17a2b8 !important;
    border-color: #17a2b8 !important;
}

.btn-check:checked + .btn-outline-warning {
    background-color: #ffc107 !important;
    border-color: #ffc107 !important;
}

.btn-check:checked + .btn-outline-danger {
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('.needs-validation');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>
@endsection 