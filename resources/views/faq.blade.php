@extends('layouts.app')

@section('content')
<div class="faq-page">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Frequently Asked Questions</h1>
                <p>Find answers to common questions about e-waste recycling</p>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="faqSearch" placeholder="Search for answers...">
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Content -->
    <div class="faq-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- General Questions -->
                    <div class="faq-section">
                        <h2>General Questions</h2>
                        <div class="accordion" id="generalAccordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#general1">
                                        What is e-waste?
                                    </button>
                                </h3>
                                <div id="general1" class="accordion-collapse collapse show" data-bs-parent="#generalAccordion">
                                    <div class="accordion-body">
                                        E-waste, or electronic waste, refers to discarded electrical or electronic devices. This includes items like computers, mobile phones, televisions, and other electronic equipment that have reached the end of their useful life.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general2">
                                        Why is e-waste recycling important?
                                    </button>
                                </h3>
                                <div id="general2" class="accordion-collapse collapse" data-bs-parent="#generalAccordion">
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
                        </div>
                    </div>

                    <!-- Recycling Process -->
                    <div class="faq-section">
                        <h2>Recycling Process</h2>
                        <div class="accordion" id="processAccordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#process1">
                                        How does the recycling process work?
                                    </button>
                                </h3>
                                <div id="process1" class="accordion-collapse collapse show" data-bs-parent="#processAccordion">
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
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#process2">
                                        What happens to my data?
                                    </button>
                                </h3>
                                <div id="process2" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                                    <div class="accordion-body">
                                        We take data security seriously. All devices undergo a secure data wiping process before recycling. For devices that cannot be wiped, we ensure physical destruction of storage components.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Collection & Drop-off -->
                    <div class="faq-section">
                        <h2>Collection & Drop-off</h2>
                        <div class="accordion" id="collectionAccordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collection1">
                                        How can I dispose of my e-waste?
                                    </button>
                                </h3>
                                <div id="collection1" class="accordion-collapse collapse show" data-bs-parent="#collectionAccordion">
                                    <div class="accordion-body">
                                        You can dispose of your e-waste in several ways:
                                        <ul>
                                            <li>Visit our nearest recycling center</li>
                                            <li>Schedule a pickup service</li>
                                            <li>Use our drop-off points</li>
                                            <li>Participate in our e-waste collection drives</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collection2">
                                        What items do you accept?
                                    </button>
                                </h3>
                                <div id="collection2" class="accordion-collapse collapse" data-bs-parent="#collectionAccordion">
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
                        </div>
                    </div>

                    <!-- Environmental Impact -->
                    <div class="faq-section">
                        <h2>Environmental Impact</h2>
                        <div class="accordion" id="environmentAccordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#environment1">
                                        What are the environmental benefits?
                                    </button>
                                </h3>
                                <div id="environment1" class="accordion-collapse collapse show" data-bs-parent="#environmentAccordion">
                                    <div class="accordion-body">
                                        E-waste recycling provides several environmental benefits:
                                        <ul>
                                            <li>Reduces greenhouse gas emissions</li>
                                            <li>Conserves natural resources</li>
                                            <li>Prevents soil and water contamination</li>
                                            <li>Minimizes energy consumption</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#environment2">
                                        How do you ensure safe disposal?
                                    </button>
                                </h3>
                                <div id="environment2" class="accordion-collapse collapse" data-bs-parent="#environmentAccordion">
                                    <div class="accordion-body">
                                        We follow strict environmental guidelines:
                                        <ul>
                                            <li>Certified recycling processes</li>
                                            <li>Proper handling of hazardous materials</li>
                                            <li>Regular environmental audits</li>
                                            <li>Compliance with local regulations</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .faq-page {
        min-height: 100vh;
        background: #f8f9fa;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
        padding: 4rem 0;
        color: white;
        margin-bottom: 3rem;
    }

    .hero-content {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .hero-content p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    .search-box {
        background: white;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        max-width: 500px;
        margin: 0 auto;
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

    /* FAQ Content */
    .faq-content {
        padding-bottom: 4rem;
    }

    .faq-section {
        margin-bottom: 3rem;
    }

    .faq-section h2 {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #1a237e;
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
</style>

@push('scripts')
<script>
    // FAQ Search functionality
    document.getElementById('faqSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const accordionItems = document.querySelectorAll('.accordion-item');
        
        accordionItems.forEach(item => {
            const question = item.querySelector('.accordion-button').textContent.toLowerCase();
            const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection 