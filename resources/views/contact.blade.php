@extends('layouts.app')

@section('content')
<div class="contact-page">
    <!-- Hero Section -->
    <div class="contact-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Get in Touch</h1>
                    <p class="lead mb-4">Have questions about e-waste recycling? We're here to help. Reach out to us through any of our channels.</p>
                    <div class="contact-stats">
                        <div class="stat-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>24/7 Support</h4>
                                <p>Always here to help</p>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-headset"></i>
                            <div>
                                <h4>Expert Team</h4>
                                <p>Professional assistance</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-image">
                        <img src="{{ asset('images/contact-hero.svg') }}" alt="Contact Us" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="contact-form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form-card">
                        <div class="form-header text-center mb-4">
                            <h2>Send us a Message</h2>
                            <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Your Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name') }}" 
                                                   placeholder="Enter your full name" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email') }}" 
                                                   placeholder="Enter your email address" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                                   id="subject" name="subject" value="{{ old('subject') }}" 
                                                   placeholder="Enter message subject" required>
                                            @error('subject')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-comment-alt"></i>
                                            </span>
                                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                                      id="message" name="message" rows="5" 
                                                      placeholder="Type your message here..." required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Info Section -->
    <div class="contact-info-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Visit Us</h3>
                        <p>123 Eco Street<br>Green City, India - 500001</p>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-directions me-2"></i>Get Directions
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3>Call Us</h3>
                        <p>+91 123 456 7890<br>Mon - Fri, 9am - 6pm</p>
                        <a href="tel:+911234567890" class="btn btn-outline-primary">
                            <i class="fas fa-phone me-2"></i>Call Now
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email Us</h3>
                        <p>info@ecorecycle.com<br>support@ecorecycle.com</p>
                        <a href="mailto:info@ecorecycle.com" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Send Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .contact-page {
        padding-top: 80px;
    }

    .contact-hero {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 5rem 0;
        margin-bottom: 4rem;
    }

    .contact-hero h1 {
        color: var(--dark-color);
        font-size: 3rem;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .contact-hero .lead {
        color: var(--gray-color);
        font-size: 1.2rem;
        line-height: 1.6;
    }

    .contact-stats {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-item i {
        font-size: 2rem;
        color: var(--primary-color);
        background: rgba(0, 113, 227, 0.1);
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    .stat-item h4 {
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
        color: var(--dark-color);
    }

    .stat-item p {
        margin: 0;
        color: var(--gray-color);
        font-size: 0.9rem;
    }

    .contact-image {
        position: relative;
        padding: 2rem;
    }

    .contact-image img {
        max-width: 100%;
        height: auto;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.1));
    }

    .contact-form-section {
        padding: 4rem 0;
    }

    .contact-form-card {
        background: white;
        border-radius: 16px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .form-header h2 {
        font-size: 2rem;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .form-header p {
        color: var(--gray-color);
        font-size: 1.1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
        font-weight: 500;
    }

    .input-group {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .input-group-text {
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.1);
        color: var(--primary-color);
        padding: 0.75rem 1rem;
    }

    .form-control {
        border: 1px solid rgba(0, 0, 0, 0.1);
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: var(--primary-color);
    }

    .contact-info-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 5rem 0;
    }

    .info-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        height: 100%;
        transition: transform 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .info-card:hover {
        transform: translateY(-5px);
    }

    .icon-wrapper {
        width: 70px;
        height: 70px;
        background: rgba(0, 113, 227, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .icon-wrapper i {
        font-size: 1.8rem;
        color: var(--primary-color);
    }

    .info-card h3 {
        font-size: 1.3rem;
        color: var(--dark-color);
        margin-bottom: 1rem;
    }

    .info-card p {
        color: var(--gray-color);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .btn-outline-primary {
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        padding: 0.5rem 1.25rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 991.98px) {
        .contact-hero {
            padding: 3rem 0;
        }

        .contact-hero h1 {
            font-size: 2.5rem;
        }

        .contact-stats {
            flex-direction: column;
            gap: 1.5rem;
        }

        .contact-image {
            margin-top: 2rem;
        }

        .contact-form-card {
            padding: 2rem;
        }
    }

    @media (max-width: 767.98px) {
        .contact-hero h1 {
            font-size: 2rem;
        }

        .contact-hero .lead {
            font-size: 1.1rem;
        }

        .stat-item i {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .info-card {
            margin-bottom: 1.5rem;
        }
    }

    .alert {
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .alert ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert li {
        margin-bottom: 0.25rem;
    }

    .alert li:last-child {
        margin-bottom: 0;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>
@endsection 