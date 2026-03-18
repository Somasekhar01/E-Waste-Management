@extends('layouts.app')

@section('content')
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-5">
                <div class="auth-card">
                    <div class="auth-header text-center mb-4">
                        <div class="auth-logo mb-3">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h1>Verify Phone Number</h1>
                        <p>Enter the verification code sent to your phone</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verify.phone') }}" class="auth-form">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="otp">Verification Code</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="text" class="form-control @error('otp') is-invalid @enderror" 
                                       id="otp" name="otp" placeholder="Enter 6-digit code" required autofocus
                                       maxlength="6" pattern="[0-9]{6}">
                                @error('otp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-4">
                            <i class="fas fa-check me-2"></i>Verify Code
                        </button>

                        <div class="auth-footer text-center">
                            <p>Didn't receive the code? 
                                <form method="POST" action="{{ route('resend.otp') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0">
                                        Resend Code
                                    </button>
                                </form>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .auth-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .auth-card {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .auth-logo {
        width: 60px;
        height: 60px;
        background: rgba(0, 113, 227, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .auth-logo i {
        font-size: 1.8rem;
        color: var(--primary-color);
    }

    .auth-header h1 {
        font-size: 2rem;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .auth-header p {
        color: var(--gray-color);
        font-size: 1.1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
        font-weight: 500;
        font-size: 0.95rem;
    }

    .input-group {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .input-group:focus-within {
        box-shadow: 0 4px 8px rgba(0, 113, 227, 0.1);
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
        transition: all 0.3s ease;
        letter-spacing: 0.5em;
        text-align: center;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: var(--primary-color);
    }

    .btn-primary {
        padding: 0.75rem;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 113, 227, 0.2);
    }

    .auth-footer {
        color: var(--gray-color);
    }

    .auth-footer .btn-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .auth-footer .btn-link:hover {
        color: var(--secondary-color);
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

    @media (max-width: 767.98px) {
        .auth-card {
            padding: 2rem;
        }

        .auth-header h1 {
            font-size: 1.75rem;
        }

        .auth-header p {
            font-size: 1rem;
        }

        .auth-logo {
            width: 50px;
            height: 50px;
        }

        .auth-logo i {
            font-size: 1.5rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInput = document.getElementById('otp');
    
    // Only allow numbers
    otpInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Auto-focus and move to next input
    otpInput.addEventListener('keyup', function(e) {
        if (this.value.length === 6) {
            this.form.submit();
        }
    });
});
</script>
@endsection 