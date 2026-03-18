@extends('layouts.app')

@section('content')
<div class="location-finder-page">
    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <div class="header-content">
                <h1>Find Recycling Centers</h1>
                <p>Locate the nearest e-waste recycling facility in your area</p>
                <div class="search-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="locationSearch" placeholder="Enter your location...">
                    </div>
                    <button class="location-btn" id="useCurrentLocation">
                        <i class="fas fa-location-dot"></i>
                        Use My Location
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Map Section -->
                <div class="col-lg-7">
                    <div class="map-section">
                        <div id="map"></div>
                        <div class="map-overlay">
                            <div class="map-stats">
                                <div class="stats-section recycling-centers">
                                    <div class="stats-icon">
                                        <i class="fas fa-recycle"></i>
                                    </div>
                                    <div class="stats-content">
                                        <div class="stats-number">{{ $facilities->count() }}</div>
                                        <div class="stats-label">Recycling Centers</div>
                                        <div class="stats-description">Active facilities in your area</div>
                                    </div>
                                </div>
                                <div class="stats-divider"></div>
                                <div class="stats-section coverage">
                                    <div class="stats-icon">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <div class="stats-content">
                                        <div class="stats-number">8</div>
                                        <div class="stats-label">States Covered</div>
                                        <div class="stats-description">Nationwide presence</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facilities Section -->
                <div class="col-lg-5">
                    <div class="facilities-section">
                        <div class="section-header">
                            <h2>Recycling Centers</h2>
                            <div class="header-actions">
                                <button class="action-btn" id="sortDistance">
                                    <i class="fas fa-sort-amount-down"></i>
                                    Sort by Distance
                                </button>
                                <button class="action-btn" id="filterServices">
                                    <i class="fas fa-filter"></i>
                                    Filter Services
                                </button>
                            </div>
                        </div>
                        <div class="facilities-list">
                            @foreach($facilities as $facility)
                            <div class="facility-card" 
                                 data-facility-id="{{ $facility->id }}"
                                 data-lat="{{ $facility->latitude }}"
                                 data-lng="{{ $facility->longitude }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header">
                                            <div class="status-badge">
                                                <span class="status-dot"></span>
                                                Open Now
                                            </div>
                                            <h3>{{ $facility->name }}</h3>
                                        </div>
                                        <div class="card-info">
                                            <div class="info-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>{{ $facility->address }}</span>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-phone"></i>
                                                <span>{{ $facility->phone }}</span>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-clock"></i>
                                                <span>{{ $facility->hours }}</span>
                                            </div>
                                        </div>
                                        <div class="services-section">
                                            <h4>Services Offered</h4>
                                            <div class="services-grid">
                                                @foreach($facility->services as $service)
                                                    <div class="service-item">
                                                        <i class="fas fa-recycle"></i>
                                                        <span>{{ $service }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-actions">
                                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $facility->latitude }},{{ $facility->longitude }}" 
                                               class="btn btn-primary" target="_blank">
                                                <i class="fas fa-directions"></i>
                                                Get Directions
                                            </a>
                                            <button class="btn btn-outline" onclick="showFacilityInfo({{ $facility->id }})">
                                                <i class="fas fa-info-circle"></i>
                                                View Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Facility Info Modal -->
<div class="modal fade" id="facilityInfoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Facility Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="facilityInfoContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary" id="schedulePickup">
                    <i class="fas fa-calendar-check"></i> Schedule Pickup
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Services Filter Modal -->
<div class="modal fade" id="servicesFilterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter by Services</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="services-filter">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Electronics" id="electronics">
                        <label class="form-check-label" for="electronics">
                            Electronics
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Batteries" id="batteries">
                        <label class="form-check-label" for="batteries">
                            Batteries
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Appliances" id="appliances">
                        <label class="form-check-label" for="appliances">
                            Appliances
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Computers" id="computers">
                        <label class="form-check-label" for="computers">
                            Computers
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Mobile Phones" id="mobilePhones">
                        <label class="form-check-label" for="mobilePhones">
                            Mobile Phones
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Printers" id="printers">
                        <label class="form-check-label" for="printers">
                            Printers
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="applyFilters">Apply Filters</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .location-finder-page {
        min-height: 100vh;
        background: #f8f9fa;
    }

    /* Header Section */
    .header-section {
        background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
        padding: 3rem 0;
        color: white;
        margin-bottom: 2rem;
    }

    .header-content {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .header-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .header-content p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    .search-container {
        display: flex;
        gap: 1rem;
    }

    .search-box {
        flex: 1;
        background: white;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .search-box i {
        color: #666;
    }

    .search-box input {
        border: none;
        background: none;
        outline: none;
        width: 100%;
        font-size: 1rem;
    }

    .location-btn {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .location-btn:hover {
        background: rgba(255,255,255,0.2);
    }

    /* Main Content */
    .main-content {
        padding: 0 2rem 2rem;
    }

    /* Map Section */
    .map-section {
        position: relative;
        height: calc(100vh - 250px);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    #map {
        height: 100%;
        width: 100%;
    }

    .map-overlay {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: white;
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .map-stats {
        display: flex;
        gap: 1rem;
    }

    .stats-section {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .stats-icon {
        width: 40px;
        height: 40px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stats-icon i {
        color: #0d6efd;
        font-size: 1.25rem;
    }

    .stats-content {
        display: flex;
        flex-direction: column;
    }

    .stats-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0d6efd;
    }

    .stats-label {
        font-size: 0.875rem;
        font-weight: 500;
    }

    .stats-description {
        font-size: 0.75rem;
        color: #6c757d;
    }

    .stats-divider {
        width: 1px;
        background: #dee2e6;
    }

    /* Facilities Section */
    .facilities-section {
        height: calc(100vh - 250px);
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 1rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #dee2e6;
    }

    .section-header h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .header-actions {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background: #f8f9fa;
    }

    .action-btn i {
        color: #6c757d;
    }

    .facilities-list {
        flex: 1;
        overflow-y: auto;
        padding-right: 0.5rem;
        margin: 0;
    }

    .facility-card {
        margin-bottom: 1rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }

    .facility-card:hover {
        transform: translateY(-2px);
    }

    .card {
        border: none;
        border-radius: 12px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
        padding: 1rem 1rem 0;
    }

    .status-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #e8f5e9;
        color: #2e7d32;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: #2e7d32;
        border-radius: 50%;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .card-info {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding: 0 1rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .info-item i {
        color: #6c757d;
        width: 20px;
    }

    .services-section {
        margin-bottom: 1rem;
        padding: 0 1rem;
    }

    .services-section h4 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 0.5rem;
    }

    .service-item {
        background: #f8f9fa;
        padding: 0.5rem;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .service-item i {
        color: #0d6efd;
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
        padding: 1rem;
        border-top: 1px solid #dee2e6;
    }

    .btn-primary {
        background: #0d6efd;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background: #0b5ed7;
        color: white;
    }

    .btn-outline {
        background: white;
        border: 1px solid #dee2e6;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .btn-outline:hover {
        background: #f8f9fa;
        color: #0d6efd;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 12px;
        border: none;
    }

    .modal-header {
        border-bottom: 1px solid #dee2e6;
        padding: 1rem 1.5rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid #dee2e6;
        padding: 1rem 1.5rem;
    }

    .services-filter {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-check-input {
        width: 1.25rem;
        height: 1.25rem;
    }

    .form-check-label {
        font-size: 1rem;
    }

    /* Map Error Styles */
    .map-error {
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .map-error i {
        font-size: 3rem;
        color: #dc3545;
        margin-bottom: 1rem;
    }

    .map-error h3 {
        color: #dc3545;
        margin-bottom: 0.5rem;
    }

    .map-error p {
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .map-error button {
        padding: 0.5rem 1.5rem;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .map-section {
            height: 400px;
            margin-bottom: 2rem;
        }

        .facilities-section {
            height: auto;
            max-height: 500px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    let map;
    let markers = [];
    let userLocation = null;
    let mapError = false;

    // Load Google Maps API
    function loadGoogleMaps() {
        return new Promise((resolve, reject) => {
            if (window.google && window.google.maps) {
                resolve();
                return;
            }

            const apiKey = '{{ config("services.google.maps.api_key") }}';
            if (!apiKey) {
                const error = new Error('Google Maps API key is not configured');
                console.error(error);
                showMapError('We are currently experiencing technical difficulties with the map. Please try again later.');
                reject(error);
                return;
            }

            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places`;
            script.async = true;
            script.defer = true;
            
            script.onerror = (error) => {
                console.error('Failed to load Google Maps script:', error);
                showMapError('We are currently experiencing technical difficulties with the map. Please try again later.');
                reject(new Error('Failed to load Google Maps script'));
            };
            
            document.head.appendChild(script);

            script.onload = () => {
                initMap();
                resolve();
            };
        });
    }

    function initMap() {
        try {
            // Default center (India)
            const defaultCenter = { lat: 20.5937, lng: 78.9629 };
            
            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultCenter,
                zoom: 5,
                mapTypeControl: true,
                streetViewControl: false,
                fullscreenControl: true,
                zoomControl: true,
                styles: [
                    {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    }
                ]
            });

            // Add markers for facilities
            document.querySelectorAll('.facility-card').forEach(card => {
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);
                const name = card.querySelector('h3').textContent;

                const marker = new google.maps.Marker({
                    position: { lat, lng },
                    map: map,
                    title: name,
                    animation: google.maps.Animation.DROP
                });

                markers.push(marker);

                marker.addListener('click', () => {
                    showFacilityInfo(card.dataset.facilityId);
                });
            });

            // Add bounds changed listener
            map.addListener('bounds_changed', () => {
                updateVisibleMarkers();
            });

            mapError = false;
        } catch (error) {
            console.error('Error initializing map:', error);
            showMapError('We are currently experiencing technical difficulties with the map. Please try again later.');
            mapError = true;
        }
    }

    function showMapError(message = 'Unable to load map') {
        const mapContainer = document.getElementById('map');
        mapContainer.innerHTML = `
            <div class="map-error">
                <i class="fas fa-map-marked-alt"></i>
                <h3>Map Unavailable</h3>
                <p>${message}</p>
                <button onclick="retryMap()" class="btn btn-primary">
                    <i class="fas fa-sync-alt"></i> Try Again
                </button>
            </div>
        `;
    }

    function retryMap() {
        loadGoogleMaps().catch(error => {
            console.error('Error retrying Google Maps:', error);
            showMapError('We are currently experiencing technical difficulties with the map. Please try again later.');
        });
    }

    // Initialize the page
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            await loadGoogleMaps();
        } catch (error) {
            console.error('Error loading Google Maps:', error);
            showMapError('We are currently experiencing technical difficulties with the map. Please try again later.');
        }
    });

    // Handle "Use My Location" button
    document.getElementById('useCurrentLocation')?.addEventListener('click', () => {
        if (mapError) {
            showMapError('Map is not loaded. Please try again.');
            return;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Center map on user's location
                    map.setCenter(userLocation);
                    map.setZoom(12);

                    // Sort facilities by distance
                    sortFacilitiesByDistance(userLocation);
                },
                (error) => {
                    console.error('Error getting location:', error);
                    alert('Unable to get your location. Please make sure location services are enabled.');
                }
            );
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    });

    function sortFacilitiesByDistance(userLocation) {
        const facilities = Array.from(document.querySelectorAll('.facility-card'));
        
        facilities.forEach(facility => {
            const lat = parseFloat(facility.dataset.lat);
            const lng = parseFloat(facility.dataset.lng);
            const distance = calculateDistance(
                userLocation.lat,
                userLocation.lng,
                lat,
                lng
            );
            facility.dataset.distance = distance;
        });

        const sortedFacilities = facilities.sort((a, b) => {
            return parseFloat(a.dataset.distance) - parseFloat(b.dataset.distance);
        });

        const container = document.querySelector('.facilities-list');
        sortedFacilities.forEach(facility => {
            container.appendChild(facility);
        });
    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius of the earth in km
        const dLat = deg2rad(lat2 - lat1);
        const dLon = deg2rad(lon2 - lon1);
        const a = 
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
            Math.sin(dLon/2) * Math.sin(dLon/2); 
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        const distance = R * c; // Distance in km
        return distance;
    }

    function deg2rad(deg) {
        return deg * (Math.PI/180);
    }

    function updateVisibleMarkers() {
        const bounds = map.getBounds();
        markers.forEach(marker => {
            marker.setVisible(bounds.contains(marker.getPosition()));
        });
    }

    function showFacilityInfo(facilityId) {
        const facility = document.querySelector(`.facility-card[data-facility-id="${facilityId}"]`);
        if (!facility) return;

        const modal = new bootstrap.Modal(document.getElementById('facilityInfoModal'));
        const content = document.getElementById('facilityInfoContent');
        
        content.innerHTML = `
            <h4>${facility.querySelector('h3').textContent}</h4>
            <p><i class="fas fa-map-marker-alt"></i> ${facility.querySelector('.info-item:nth-child(1) span').textContent}</p>
            <p><i class="fas fa-phone"></i> ${facility.querySelector('.info-item:nth-child(2) span').textContent}</p>
            <p><i class="fas fa-clock"></i> ${facility.querySelector('.info-item:nth-child(3) span').textContent}</p>
            <div class="services-list">
                <h5>Services Offered:</h5>
                <ul>
                    ${Array.from(facility.querySelectorAll('.service-item')).map(item => 
                        `<li>${item.querySelector('span').textContent}</li>`
                    ).join('')}
                </ul>
            </div>
        `;
        
        modal.show();
    }
</script>
<script src="{{ asset('js/location-finder.js') }}"></script>
@endpush
@endsection 