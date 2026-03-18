@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    @if($resource->thumbnail)
                        <img src="{{ asset($resource->thumbnail) }}" class="card-img-top" alt="{{ $resource->title }}">
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h1 class="card-title h2">{{ $resource->title }}</h1>
                            <span class="badge bg-primary">{{ $resource->type }}</span>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach($resource->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag }}</span>
                            @endforeach
                        </div>

                        @if($resource->type === 'video' && $resource->media_url)
                            <div class="ratio ratio-16x9 mb-4">
                                <iframe src="{{ $resource->media_url }}" title="{{ $resource->title }}" allowfullscreen></iframe>
                            </div>
                        @endif

                        <div class="content mb-4">
                            {!! $resource->content !!}
                        </div>

                        @if($resource->type === 'infographic' && $resource->media_url)
                            <div class="text-center mb-4">
                                <img src="{{ asset($resource->media_url) }}" alt="{{ $resource->title }}" class="img-fluid">
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Published on {{ $resource->published_at->format('F j, Y') }}</small>
                            <div class="share-buttons">
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="shareOnFacebook()">
                                    <i class="fab fa-facebook"></i> Share
                                </button>
                                <button class="btn btn-outline-info btn-sm me-2" onclick="shareOnTwitter()">
                                    <i class="fab fa-twitter"></i> Share
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="shareOnWhatsApp()">
                                    <i class="fab fa-whatsapp"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Resources -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="card-title h5 mb-4">Related Resources</h3>
                        <div class="row g-4">
                            @foreach($resource->tags as $tag)
                                @foreach(App\Models\EducationalResource::where('id', '!=', $resource->id)
                                    ->where('is_published', true)
                                    ->whereJsonContains('tags', $tag)
                                    ->take(3)
                                    ->get() as $related)
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            @if($related->thumbnail)
                                                <img src="{{ asset($related->thumbnail) }}" class="card-img-top" alt="{{ $related->title }}">
                                            @endif
                                            <div class="card-body">
                                                <h4 class="card-title h6">{{ $related->title }}</h4>
                                                <a href="{{ route('educational-resources.show', $related) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        }

        function shareOnTwitter() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent(document.title);
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
        }

        function shareOnWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent(document.title);
            window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
        }
    </script>
@endpush 