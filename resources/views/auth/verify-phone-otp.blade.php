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
                        <p>Enter the OTP sent to your phone</p>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.verify.otp.submit') }}" class="otp-form">
                        @csrf
                        <div class="mb-4">
                            <div class="otp-inputs">
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                            </div>
                            <input type="hidden" name="otp" id="otp-input">
                        </div>

                        <div class="text-center mb-4">
                            <p class="text-muted">Didn't receive the OTP?</p>
                            <form method="POST" action="{{ route('password.phone') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="phone" value="{{ session('reset_phone') }}">
                                <button type="submit" class="btn btn-link">
                                    <i class="fas fa-redo me-2"></i>Resend OTP
                                </button>
                            </form>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-check me-2"></i>Verify OTP
                        </button>
                    </form>

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

    .otp-inputs {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .otp-inputs input {
        width: 45px;
        height: 45px;
        text-align: center;
        font-size: 1.25rem;
        font-weight: 600;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .otp-inputs input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 113, 227, 0.25);
        outline: none;
    }

    .otp-inputs input:invalid {
        border-color: #dc3545;
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

    .btn-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .btn-link:hover {
        color: var(--secondary-color);
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

        .otp-inputs input {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.otp-inputs input');
    const otpInput = document.getElementById('otp-input');

    // Handle input
    inputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            // Allow only numbers
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Move to next input if value is entered
            if (this.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        // Handle backspace
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Handle paste
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').slice(0, 6);
            if (/^\d+$/.test(pastedData)) {
                pastedData.split('').forEach((digit, i) => {
                    if (inputs[i]) {
                        inputs[i].value = digit;
                    }
                });
            }
        });
    });

    // Update hidden input before form submission
    document.querySelector('.otp-form').addEventListener('submit', function(e) {
        const otp = Array.from(inputs).map(input => input.value).join('');
        otpInput.value = otp;
    });
});
</script>
@endsection 