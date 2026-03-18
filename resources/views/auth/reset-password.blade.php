@extends('layouts.app')

@section('content')
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-5">
                <div class="auth-card">
                    <div class="auth-header text-center mb-4">
                        <div class="auth-logo mb-3">
                            <i class="fas fa-recycle"></i>
                        </div>
                        <h1>Reset Password</h1>
                        <p>Enter your new password</p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-4">
                            <label for="email">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Enter your email" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Enter new password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="password-strength mt-2">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted">Password strength: <span class="strength-text">Weak</span></small>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Confirm new password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-4">
                            <i class="fas fa-key me-2"></i>Reset Password
                        </button>

                        <div class="auth-footer text-center">
                            <p>Remember your password? <a href="{{ route('login') }}">Sign in</a></p>
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
    }

    .form-control:focus {
        box-shadow: none;
        border-color: var(--primary-color);
    }

    .toggle-password {
        border: 1px solid rgba(0, 0, 0, 0.1);
        color: var(--gray-color);
        transition: all 0.3s ease;
    }

    .toggle-password:hover {
        background: rgba(0, 0, 0, 0.05);
        color: var(--primary-color);
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

    .auth-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .auth-footer a:hover {
        color: var(--secondary-color);
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

    .password-strength {
        margin-top: 0.5rem;
    }

    .progress {
        height: 4px;
        background-color: #e9ecef;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 0.25rem;
    }

    .progress-bar {
        transition: all 0.3s ease;
    }

    .progress-bar.weak {
        width: 25%;
        background-color: #dc3545;
    }

    .progress-bar.medium {
        width: 50%;
        background-color: #ffc107;
    }

    .progress-bar.strong {
        width: 75%;
        background-color: #28a745;
    }

    .progress-bar.very-strong {
        width: 100%;
        background-color: #28a745;
    }

    .strength-text {
        font-weight: 500;
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
    const togglePassword = document.querySelector('.toggle-password');
    const password = document.querySelector('#password');
    const icon = togglePassword.querySelector('i');
    const form = document.querySelector('.auth-form');
    const progressBar = document.querySelector('.progress-bar');
    const strengthText = document.querySelector('.strength-text');

    // Password visibility toggle
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    // Password strength checker
    password.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        let strengthClass = '';
        let strengthLabel = '';

        // Length check
        if (password.length >= 8) strength += 1;
        // Contains number
        if (/\d/.test(password)) strength += 1;
        // Contains lowercase
        if (/[a-z]/.test(password)) strength += 1;
        // Contains uppercase
        if (/[A-Z]/.test(password)) strength += 1;
        // Contains special character
        if (/[^A-Za-z0-9]/.test(password)) strength += 1;

        // Update progress bar
        switch(strength) {
            case 0:
            case 1:
                strengthClass = 'weak';
                strengthLabel = 'Weak';
                break;
            case 2:
                strengthClass = 'medium';
                strengthLabel = 'Medium';
                break;
            case 3:
            case 4:
                strengthClass = 'strong';
                strengthLabel = 'Strong';
                break;
            case 5:
                strengthClass = 'very-strong';
                strengthLabel = 'Very Strong';
                break;
        }

        progressBar.className = 'progress-bar ' + strengthClass;
        strengthText.textContent = strengthLabel;
    });

    // Form validation
    form.addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        let isValid = true;

        // Email validation
        if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            showError('email', 'Please enter a valid email address');
            isValid = false;
        }

        // Password validation
        if (password.length < 8) {
            showError('password', 'Password must be at least 8 characters long');
            isValid = false;
        }

        if (!/\d/.test(password)) {
            showError('password', 'Password must contain at least one number');
            isValid = false;
        }

        if (!/[A-Z]/.test(password)) {
            showError('password', 'Password must contain at least one uppercase letter');
            isValid = false;
        }

        if (!/[a-z]/.test(password)) {
            showError('password', 'Password must contain at least one lowercase letter');
            isValid = false;
        }

        // Password confirmation
        if (password !== passwordConfirmation) {
            showError('password_confirmation', 'Passwords do not match');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const feedback = field.nextElementSibling;
        
        field.classList.add('is-invalid');
        if (!feedback) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            errorDiv.textContent = message;
            field.parentNode.appendChild(errorDiv);
        } else {
            feedback.textContent = message;
        }
    }

    // Clear validation on input
    ['email', 'password', 'password_confirmation'].forEach(id => {
        document.getElementById(id).addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const feedback = this.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.remove();
            }
        });
    });
});
</script>
@endsection 