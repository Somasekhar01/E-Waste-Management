@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">E-Waste Management</h1>
            <p class="hero-subtitle">Making electronic waste recycling accessible and rewarding for everyone</p>
            <div class="mt-4">
                <a href="{{ route('location-finder') }}" class="btn btn-primary btn-lg me-3">
                    <i class="fas fa-map-marker-alt me-2"></i>Find Recycling Center
                </a>
                <a href="{{ route('educational-resources.index') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-graduation-cap me-2"></i>Learn More
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section py-5">
        <div class="container">
            <h2 class="section-title">Why Choose Us?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-map-marked-alt fa-3x text-primary"></i>
                        </div>
                        <h3>Easy Location</h3>
                        <p>Find the nearest recycling center with our interactive map</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-coins fa-3x text-primary"></i>
                        </div>
                        <h3>Earn Credits</h3>
                        <p>Get rewarded for recycling your electronic waste</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-leaf fa-3x text-primary"></i>
                        </div>
                        <h3>Eco-Friendly</h3>
                        <p>Contribute to a sustainable environment</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="process-section py-5 bg-light">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="process-card text-center">
                        <div class="process-number">1</div>
                        <h4>Find Center</h4>
                        <p>Locate the nearest recycling facility</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-card text-center">
                        <div class="process-number">2</div>
                        <h4>Drop Off</h4>
                        <p>Bring your e-waste to the center</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-card text-center">
                        <div class="process-number">3</div>
                        <h4>Get Credits</h4>
                        <p>Earn points for your contribution</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="process-card text-center">
                        <div class="process-number">4</div>
                        <h4>Track Impact</h4>
                        <p>Monitor your environmental impact</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Impact Section -->
    <div class="impact-section py-5">
        <div class="container">
            <h2 class="section-title">Our Impact</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="impact-card text-center">
                        <div class="impact-number">1M+</div>
                        <p>Devices Recycled</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="impact-card text-center">
                        <div class="impact-number">500+</div>
                        <p>Recycling Centers</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="impact-card text-center">
                        <div class="impact-number">50K+</div>
                        <p>Happy Users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="section-title text-white">Ready to Start Recycling?</h2>
            <p class="lead mb-4">Join thousands of users who are making a difference</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                <i class="fas fa-user-plus me-2"></i>Get Started
            </a>
        </div>
    </div>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Find answers to common questions about e-waste recycling</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <!-- General Questions -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    What is e-waste?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    E-waste, or electronic waste, refers to discarded electrical or electronic devices. This includes items like computers, mobile phones, televisions, and other electronic equipment that have reached the end of their useful life.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Why is e-waste recycling important?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    E-waste recycling is crucial because:
                                    <ul>
                                        <li>It prevents harmful materials from entering landfills</li>
                                        <li>Recovers valuable materials for reuse</li>
                                        <li>Reduces environmental pollution</li>
                                        <li>Conserves natural resources</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    How does the recycling process work?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our recycling process involves:
                                    <ol>
                                        <li>Collection of e-waste from drop-off points or scheduled pickups</li>
                                        <li>Sorting and categorization of devices</li>
                                        <li>Manual dismantling and separation of components</li>
                                        <li>Recovery of valuable materials</li>
                                        <li>Safe disposal of hazardous substances</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    What items do you accept?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We accept various electronic items including:
                                    <ul>
                                        <li>Computers and laptops</li>
                                        <li>Mobile phones and tablets</li>
                                        <li>Televisions and monitors</li>
                                        <li>Printers and scanners</li>
                                        <li>Batteries and chargers</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    What happens to my data?
                                </button>
                            </h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We take data security seriously. All devices undergo a secure data wiping process before recycling. For devices that cannot be wiped, we ensure physical destruction of storage components.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
    .hero-section {
        background: linear-gradient(135deg, #f5f5f7 0%, #ffffff 100%);
        padding: 120px 0 60px;
        text-align: center;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 700;
        letter-spacing: -0.015em;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.5rem;
        color: var(--apple-gray);
        margin-bottom: 2rem;
    }

    .feature-card {
        padding: 2rem;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5f5f7;
        border-radius: 50%;
    }

    .process-card {
        padding: 2rem;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .process-number {
        width: 40px;
        height: 40px;
        background: var(--apple-blue);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-weight: 600;
    }

    .impact-card {
        padding: 2rem;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .impact-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--apple-blue);
        margin-bottom: 0.5rem;
    }

    .cta-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }

    .btn-outline-primary {
        border: 2px solid var(--apple-blue);
        color: var(--apple-blue);
        padding: 0.8rem 2rem;
        font-size: 1rem;
        font-weight: 500;
        border-radius: 980px;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: var(--apple-blue);
        color: white;
        transform: translateY(-1px);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: -0.015em;
        margin-bottom: 3rem;
        text-align: center;
    }

    .lead {
        font-size: 1.25rem;
        color: var(--apple-gray);
    }

    .faq-section {
        background: #f8f9fa;
        padding: 5rem 0;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .accordion-item {
        border: none;
        margin-bottom: 1rem;
        border-radius: 8px !important;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .accordion-button {
        padding: 1.25rem;
        font-size: 1.1rem;
        font-weight: 500;
        color: #333;
        background: white;
        border: none;
    }

    .accordion-button:not(.collapsed) {
        color: #1a237e;
        background: #f8f9fa;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,0.1);
    }

    .accordion-body {
        padding: 1.25rem;
        background: white;
    }

    .accordion-body ul,
    .accordion-body ol {
        margin: 0.5rem 0;
        padding-left: 1.5rem;
    }

    .accordion-body li {
        margin-bottom: 0.5rem;
    }

    .accordion-body li:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }

        .section-subtitle {
            font-size: 1rem;
        }

        .accordion-button {
            padding: 1rem;
            font-size: 1rem;
        }

        .accordion-body {
            padding: 1rem;
        }
    }
    </style>
    @endpush
@endsection
