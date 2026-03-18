@extends('layouts.app')

@section('content')
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-5">
                <div class="auth-card">
                    <div class="auth-header text-center mb-4">
                        <div class="auth-logo mb-3">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h1>Reset Password</h1>
                        <p>Choose how you want to reset your password</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="reset-options">
                        <!-- Email Reset Option -->
                        <div class="reset-option mb-4">
                            <h5 class="mb-3">Reset via Email</h5>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                                </button>
                            </form>
                        </div>

                        <div class="divider mb-4">
                            <span>OR</span>
                        </div>

                        <!-- Phone Reset Option -->
                        <div class="reset-option">
                            <h5 class="mb-3">Reset via Phone</h5>
                            <form method="POST" action="{{ route('password.phone') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-mobile-alt me-2"></i>Send OTP
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="auth-footer text-center mt-4">
                        <p>Remember your password? <a href="{{ route('login') }}">Sign in</a></p>
                    </div>
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

    .reset-option {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
    }

    .reset-option h5 {
        color: var(--dark-color);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .divider {
        text-align: center;
        position: relative;
    }

    .divider::before,
    .divider::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 45%;
        height: 1px;
        background: #dee2e6;
    }

    .divider::before {
        left: 0;
    }

    .divider::after {
        right: 0;
    }

    .divider span {
        background: white;
        padding: 0 1rem;
        color: var(--gray-color);
        font-weight: 500;
    }

    .form-label {
        font-weight: 500;
        color: var(--dark-color);
    }

    .input-group-text {
        background: #f8f9fa;
        border-right: none;
    }

    .input-group .form-control {
        border-left: none;
    }

    .input-group .form-control:focus {
        border-color: #dee2e6;
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 0.2rem rgba(0, 113, 227, 0.25);
    }

    .btn-primary {
        padding: 0.75rem 1.5rem;
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

    .auth-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .auth-footer a:hover {
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

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
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

        .reset-option {
            padding: 1.25rem;
        }
    }
</style>
@endsection 