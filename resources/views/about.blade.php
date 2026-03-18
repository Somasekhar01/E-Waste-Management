@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1 class="hero-title">About EcoRecycle</h1>
        <p class="hero-subtitle">Making a difference in e-waste management</p>
    </div>
</div>

<!-- Mission Section -->
<div class="mission-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="mission-content">
                    <h2 class="section-title">Our Mission</h2>
                    <p class="lead mb-4">To create a sustainable future by making electronic waste recycling accessible, convenient, and rewarding for everyone.</p>
                    <p class="text-muted mb-4">We believe that responsible e-waste management is crucial for protecting our environment and conserving valuable resources. Our platform connects individuals and businesses with recycling facilities, making it easier to dispose of electronic waste properly.</p>
                    <div class="mission-stats">
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="stat-card">
                                    <div class="stat-number">1M+</div>
                                    <div class="stat-label">Devices Recycled</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-card">
                                    <div class="stat-number">500+</div>
                                    <div class="stat-label">Recycling Centers</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mission-image">
                    <img src="{{ asset('images/mission.jpg') }}" alt="Our Mission" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vision Section -->
<div class="vision-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2">
                <div class="vision-content">
                    <h2 class="section-title">Our Vision</h2>
                    <p class="lead mb-4">To become the leading platform for e-waste management in India, setting new standards for environmental responsibility.</p>
                    <p class="text-muted mb-4">We envision a future where electronic waste is properly managed, resources are conserved, and our environment is protected for generations to come.</p>
                    <div class="vision-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle text-primary me-2"></i>
                            <span>Innovative Recycling Solutions</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle text-primary me-2"></i>
                            <span>Community Engagement</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle text-primary me-2"></i>
                            <span>Sustainable Practices</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="vision-image">
                    <img src="{{ asset('images/vision.jpg') }}" alt="Our Vision" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">About Us</div>

                <div class="card-body">
                    <h2>About Our E-Waste Management System</h2>
                    <p>Welcome to our E-Waste Management System. We are dedicated to promoting responsible electronic waste disposal and recycling practices.</p>
                    
                    <h3>Our Mission</h3>
                    <p>Our mission is to make electronic waste recycling accessible, convenient, and rewarding for everyone. We believe in creating a sustainable future by properly managing electronic waste.</p>
                    
                    <h3>What We Do</h3>
                    <ul>
                        <li>Connect users with nearby recycling facilities</li>
                        <li>Provide educational resources about e-waste management</li>
                        <li>Offer rewards for responsible recycling</li>
                        <li>Track recycling history and impact</li>
                    </ul>
                    
                    <h3>Why Choose Us?</h3>
                    <ul>
                        <li>Easy-to-use platform</li>
                        <li>Comprehensive educational resources</li>
                        <li>Reward system for responsible recycling</li>
                        <li>Community-driven approach</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 