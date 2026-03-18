// Initialize the map
let map;
let markers = [];
let userMarker;
let userLocation;
let mapError = false;

function initMap() {
    try {
        // Default center (India)
        const defaultCenter = { lat: 20.5937, lng: 78.9629 };
        
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: defaultCenter,
            mapTypeControl: true,
            streetViewControl: false,
            fullscreenControl: true,
            zoomControl: true,
            styles: [
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [{"visibility": "off"}]
                }
            ]
        });

        // Add markers for all facilities
        document.querySelectorAll('.facility-card').forEach(card => {
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            
            const marker = new google.maps.Marker({
                position: { lat, lng },
                map: map,
                title: card.querySelector('h3').textContent,
                icon: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
                }
            });
            
            markers.push(marker);
            
            // Add click event to show facility info
            marker.addListener('click', () => {
                showFacilityInfo(card.dataset.facilityId);
            });
        });

        // Add error handling for map
        google.maps.event.addListener(map, 'error', function() {
            showMapError();
        });

        // Add bounds changed listener to update visible markers
        google.maps.event.addListener(map, 'bounds_changed', function() {
            updateVisibleMarkers();
        });

        // Initialize search box
        const searchBox = new google.maps.places.SearchBox(document.getElementById('locationSearch'));
        searchBox.addListener('places_changed', function() {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            const bounds = new google.maps.LatLngBounds();
            places.forEach(place => {
                if (!place.geometry) return;
                bounds.extend(place.geometry.location);
            });
            map.fitBounds(bounds);
        });

    } catch (error) {
        console.error('Error initializing map:', error);
        showMapError();
    }
}

function updateVisibleMarkers() {
    const bounds = map.getBounds();
    const facilities = document.querySelectorAll('.facility-card');
    
    facilities.forEach(facility => {
        const lat = parseFloat(facility.dataset.lat);
        const lng = parseFloat(facility.dataset.lng);
        const position = new google.maps.LatLng(lat, lng);
        
        if (bounds && bounds.contains(position)) {
            facility.style.display = 'block';
        } else {
            facility.style.display = 'none';
        }
    });
}

function showMapError() {
    mapError = true;
    const mapContainer = document.getElementById('map');
    mapContainer.innerHTML = `
        <div class="map-error">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Unable to load map</h3>
            <p>Please check your internet connection and try again.</p>
            <button onclick="retryMap()" class="btn btn-primary">
                <i class="fas fa-sync-alt"></i> Retry
            </button>
        </div>
    `;
}

function retryMap() {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${window.googleMapsApiKey}&callback=initMap`;
    script.async = true;
    script.defer = true;
    script.onerror = function() {
        showMapError();
    };
    document.head.appendChild(script);
}

// Handle "Use My Location" button click
document.getElementById('useCurrentLocation').addEventListener('click', () => {
    if (mapError) {
        alert('Please fix the map loading issue first.');
        return;
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                
                // Update map center
                map.setCenter(userLocation);
                map.setZoom(12);
                
                // Add or update user marker
                if (userMarker) {
                    userMarker.setPosition(userLocation);
                } else {
                    userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            scale: 10,
                            fillColor: '#4285F4',
                            fillOpacity: 1,
                            strokeWeight: 2,
                            strokeColor: '#FFFFFF'
                        }
                    });
                }
                
                // Calculate and sort facilities by distance
                sortFacilitiesByDistance();
            },
            (error) => {
                alert('Unable to retrieve your location. Please make sure location services are enabled.');
                console.error('Error getting location:', error);
            }
        );
    } else {
        alert('Geolocation is not supported by your browser.');
    }
});

// Sort facilities by distance from user
function sortFacilitiesByDistance() {
    if (!userLocation) return;
    
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
    
    // Sort facilities by distance
    const facilitiesList = document.querySelector('.facilities-list');
    const sortedFacilities = Array.from(facilities)
        .sort((a, b) => a.dataset.distance - b.dataset.distance);
    
    // Reorder facilities in the DOM
    sortedFacilities.forEach(facility => {
        facilitiesList.appendChild(facility);
    });
}

// Calculate distance between two points using Haversine formula
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Earth's radius in kilometers
    const dLat = toRad(lat2 - lat1);
    const dLon = toRad(lon2 - lon1);
    
    const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
              Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * 
              Math.sin(dLon/2) * Math.sin(dLon/2);
    
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return R * c;
}

function toRad(value) {
    return value * Math.PI / 180;
}

// Show facility information in modal
function showFacilityInfo(facilityId) {
    const facility = document.querySelector(`.facility-card[data-facility-id="${facilityId}"]`);
    if (!facility) return;
    
    const modal = new bootstrap.Modal(document.getElementById('facilityInfoModal'));
    const content = document.getElementById('facilityInfoContent');
    
    // Populate modal content
    content.innerHTML = `
        <h3>${facility.querySelector('h3').textContent}</h3>
        <div class="facility-details">
            <p><i class="fas fa-map-marker-alt"></i> ${facility.querySelector('.info-item:nth-child(1) span').textContent}</p>
            <p><i class="fas fa-phone"></i> ${facility.querySelector('.info-item:nth-child(2) span').textContent}</p>
            <p><i class="fas fa-clock"></i> ${facility.querySelector('.info-item:nth-child(3) span').textContent}</p>
        </div>
        <div class="services-list">
            <h4>Services Offered</h4>
            <div class="services-grid">
                ${Array.from(facility.querySelectorAll('.service-item')).map(item => `
                    <div class="service-item">
                        <i class="fas fa-recycle"></i>
                        <span>${item.querySelector('span').textContent}</span>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
    
    modal.show();
}

// Initialize when document is ready
document.addEventListener('DOMContentLoaded', () => {
    // Load Google Maps API
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${window.googleMapsApiKey}&callback=initMap`;
    script.async = true;
    script.defer = true;
    script.onerror = function() {
        showMapError();
    };
    document.head.appendChild(script);
}); 