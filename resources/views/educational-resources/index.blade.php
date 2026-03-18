@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-4 fw-bold mb-3" style="letter-spacing: -0.02em;">Educational Resources</h1>
            <p class="lead text-muted" style="font-size: 1.25rem;">Learn about e-waste management and recycling through our comprehensive resources.</p>
        </div>
    </div>

    <!-- Search Section -->
    <div class="row mb-5">
        <div class="col-lg-6 mx-auto">
            <div class="search-box">
                <form action="{{ route('educational-resources.search') }}" method="GET" class="d-flex">
                    <input type="text" name="query" class="form-control form-control-lg" placeholder="Search resources..." value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary ms-2">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Resources Grid -->
    <div class="row g-4">
        @forelse($resources as $resource)
        <div class="col-md-6 col-lg-4">
            <div class="resource-card">
                <div class="resource-image">
                    @if($resource->image)
                        <img src="{{ asset('storage/' . $resource->image) }}" alt="{{ $resource->title }}" class="img-fluid">
                    @else
                        <div class="placeholder-image">
                            <i class="fas fa-book-open fa-3x"></i>
                        </div>
                    @endif
                </div>
                <div class="resource-content">
                    <h3 class="resource-title">{{ $resource->title }}</h3>
                    <p class="resource-description">{{ Str::limit($resource->description, 150) }}</p>
                    <div class="resource-meta">
                        <span class="resource-type">
                            <i class="fas fa-tag"></i> {{ $resource->type }}
                        </span>
                        <span class="resource-date">
                            <i class="fas fa-calendar"></i> {{ $resource->created_at->format('M d, Y') }}
                        </span>
                    </div>
                    <a href="{{ route('educational-resources.show', $resource) }}" class="btn btn-outline-primary mt-3">
                        Read More <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="no-results">
                <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                <h3>No resources found</h3>
                <p class="text-muted">Try adjusting your search or browse all resources.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($resources->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            <nav aria-label="Page navigation">
                {{ $resources->links() }}
            </nav>
        </div>
    </div>
    @endif
</div>

<style>
    .search-box {
        background: var(--light-color);
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .search-box .form-control {
        border-radius: 980px;
        padding: 0.8rem 1.2rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        font-size: 1rem;
    }

    .search-box .form-control:focus {
        box-shadow: none;
        border-color: var(--primary-color);
    }

    .resource-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .resource-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .resource-image {
        height: 200px;
        overflow: hidden;
        background: var(--light-color);
    }

    .resource-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .resource-card:hover .resource-image img {
        transform: scale(1.05);
    }

    .placeholder-image {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-color);
    }

    .resource-content {
        padding: 1.5rem;
    }

    .resource-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--dark-color);
        letter-spacing: -0.01em;
    }

    .resource-description {
        color: var(--gray-color);
        margin-bottom: 1rem;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .resource-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.85rem;
        color: var(--gray-color);
    }

    .resource-meta i {
        margin-right: 0.5rem;
        color: var(--primary-color);
    }

    .no-results {
        padding: 3rem;
        background: var(--light-color);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .no-results h3 {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .pagination {
        justify-content: center;
    }

    .page-link {
        color: var(--primary-color);
        border: none;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 980px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .page-link:hover {
        background-color: var(--light-color);
        color: var(--dark-color);
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary {
        border-radius: 980px;
        padding: 0.5rem 1.2rem;
        font-size: 0.9rem;
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
</style>
@endsection 