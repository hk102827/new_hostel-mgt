<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boys Hostel Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        
        .main-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
        }
        
        .header-title {
            background: rgba(255, 255, 255, 0.95);
            color: rgb(243, 195, 0);
            font-weight: bold;
            font-size: 1.5rem;
            padding: 15px 0;
            text-align: center;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .close-btn {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: rgb(243, 195, 0);
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .close-btn:hover {
            background: rgb(243, 195, 0);
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 400px;
            margin: 50px auto;
        }
        
        .logo-section {
            background: rgb(243, 195, 0);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .logo-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgb(243, 195, 0) 0%, rgb(243, 195, 0) 100%);
        }
        
        .logo-content {
            position: relative;
            z-index: 2;
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .logo-icon i {
            color: rgb(243, 195, 0);
            font-size: 2.5rem;
        }
        
        .logo-text {
            font-size: 1.3rem;
            font-weight: bold;
            margin: 0;
        }
        
        .form-section {
            padding: 40px 60px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 25px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: rgb(243, 195, 0);
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(214, 51, 132, 0.25);
        }
        
        .form-label {
            color: #495057;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .form-check {
            margin: 20px 0;
        }
        
        .form-check-input:checked {
            background-color: rgb(243, 195, 0);
            border-color: rgb(243, 195, 0);
        }
        
        .form-check-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .login-btn {
            background-color: rgb(243, 195, 0);
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            width: 100%;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(214, 51, 132, 0.4);
            background: linear-gradient(135deg, rgb(243, 195, 0) 0%, rgb(243, 195, 0) 100%);
        }
        
        .forgot-link {
            color: rgb(243, 195, 0);
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            text-align: center;
            margin-top: 15px;
        }
        
        .forgot-link:hover {
            color: rgb(243, 195, 0);
        }
        
        @media (max-width: 768px) {
            .login-card {
                margin: 20px;
                max-width: none;
            }
            
            .header-title {
                font-size: 1.2rem;
            }
            
            .form-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header -->
        <div class="header-title">
            BOYS HOSTEL MANAGEMENT SYSTEM
           <button class="close-btn" onclick="window.location.href='{{ url("/") }}'"`>
                <i class="bi bi-x"></i>
            </button>

        </div>
        
        <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 70px);">
            <!-- Login Card -->
            <div class="login-card">
                <!-- Logo Section -->
                <div class="logo-section">
                    <div class="logo-content">
                        {{-- <div class="logo-icon">
                            <i class="bi bi-building"></i>
                        </div> --}}
                        <h4 class="logo-text">Boys Hostel</h4>
                    </div>
                </div>
                
                <!-- Form Section -->
                <div class="form-section">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        
                        <!-- Username/Email -->
                        <div class="form-group">
                            <label for="email" class="form-label">User Email</label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   placeholder="Enter your email">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="Enter your password">
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Remember Me -->
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="remember_me" 
                                   name="remember">
                            <label class="form-check-label" for="remember_me">
                                Show Password
                            </label>
                        </div>
                        
                        <!-- Login Button -->
                        <button type="submit" class="login-btn">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Login
                        </button>
                        
                        <!-- Forgot Password -->
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Show Password functionality
        document.getElementById('remember_me').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
        
        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Please fill in all fields');
                return false;
            }
            
            // Add loading state to button
            const submitBtn = this.querySelector('.login-btn');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Logging in...';
            submitBtn.disabled = true;
        });
        
        // Add focus effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>