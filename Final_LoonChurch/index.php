<?php
session_start();


$default_email = "admin@gmail.com";
$default_password = "admin123";

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if ($email === $default_email && $password === $default_password) {
        $_SESSION['email'] = $email;
        $_SESSION['fullname'] = "Admin"; 
        header('Location: tracking.html');
        exit();
    } else {
        $loginError = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Lady of Light Parish - Loon | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-brown: #5A352A;
            --secondary-brown: #8D6B5E;
            --accent-gold: #B8860B;
            --light-cream: #F5F0EB;
            --dark-cream: #EAE2DB;
            --text-dark: #3E2723;
            --text-light: #795548;
            --white: #fff;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 10px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 15px 30px rgba(0, 0, 0, 0.15);
            --gradient-brown: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown));
            --gradient-light: linear-gradient(135deg, var(--light-cream), var(--dark-cream));
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: none; 
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        #background-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -2; 
            background-size: cover;
            background-color: var(--primary-brown); 
        }

      
        .login-page {
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            background: transparent;
            border-radius: 40px;
            box-shadow: var(--shadow-lg);
            display: flex;
            overflow: hidden;
            position: relative;
        }

        .login-illustration-section {
            flex: 1.2;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 40px 0 0 40px;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .login-illustration-section::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -100px;
            bottom: -50px;
            width: 300px;
            background: var(--white);
            transform: skewX(-10deg);
            z-index: 0;
            box-shadow: var(--shadow-md);
            border-radius: 20px;
            transition: var(--transition);
        }

        .church-logo-section {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 50px;
            align-self: flex-start;
        }

        .church-logo-section img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease-in-out;
            border: 3px solid var(--accent-gold);
            padding: 2px;
        }

        .church-logo-section img:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .church-logo-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: var(--primary-brown);
            font-weight: 700;
            line-height: 1.2;
        }

        .slideshow-container {
            width: 100%;
            height: 100%;
            position: relative;
            z-index: 1;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transform: scale(1.05);
            transition: opacity 1s ease-in-out, transform 1s ease-in-out; /* 1 second transition */
        }

        .slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(90, 53, 42, 0.5), rgba(139, 69, 19, 0.5)); /* Reduced transparency */
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 40px;
            color: var(--white);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .slide-overlay h3 {
            font-family: 'Playfair Display', serif;
            font-size: 34px; 
            margin-bottom: 15px;
            font-weight: 700;
            line-height: 1.2;
        }

        .slide-overlay p {
            font-size: 15px; 
            line-height: 1.6;
            max-width: 500px;
        }

        .slide-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 2;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .dot:hover {
            background: var(--white);
            transform: scale(1.1);
        }

        .dot.active {
            background: var(--white);
            transform: scale(1.2);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .footer-text {
            position: relative;
            z-index: 1;
            font-size: 13px;
            color: var(--text-light);
            text-align: center;
            margin-top: 50px;
            align-self: flex-end;
        }

        .login-form-section {
            flex: 1;
            background: rgba(90, 53, 42, 0.6);
            border-radius: 0 40px 40px 0;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: var(--white);
            position: relative;
            z-index: 1;
        }

        .login-form-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 700;
            color: var(--white);
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark-cream);
            font-weight: 500;
            font-size: 15px;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid var(--secondary-brown); 
            border-radius: 15px;
            font-size: 16px;
            transition: var(--transition);
            background: var(--dark-cream);
            color: var(--text-dark);
            box-shadow: var(--shadow-sm); 
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.2), var(--shadow-md); 
            outline: none;
            background: var(--light-cream);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 65%;
            transform: translateY(-50%);
            color: var(--text-dark); 
            font-size: 18px;
            transition: var(--transition);
            pointer-events: none;
        }

        .form-group:focus-within .input-icon {
            color: var(--accent-gold);
            transform: translateY(-50%) scale(1.1);
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: var(--accent-gold);
            border: none;
            border-radius: 15px;
            color: var(--primary-brown);
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
            box-shadow: var(--shadow-md);
        }

        .btn-login:hover {
            background: #DAA520;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Loading Styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid var(--light-cream);
            border-top: 5px solid var(--accent-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .loading-text {
            color: var(--white);
            margin-top: 15px;
            font-size: 18px;
            font-weight: 500;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .btn-login.loading {
            position: relative;
            color: transparent;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 3px solid var(--light-cream);
            border-top: 3px solid var(--primary-brown);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .error-message {
            background: #FECACA;
            color: #DC2626;
            padding: 15px 20px;
            border-radius: 12px;
            margin-top: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
            border: 1px solid #FCA5A5;
            color: var(--text-dark);
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        .forgot-password, .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .forgot-password a, .register-link a {
            color: var(--dark-cream);
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-password a:hover, .register-link a:hover {
            color: var(--accent-gold);
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .login-page {
                flex-direction: column;
                max-width: 500px;
                min-height: auto;
                border-radius: 20px;
            }

            .login-illustration-section {
                border-radius: 20px 20px 0 0;
                padding: 40px 30px;
            }

            .login-illustration-section::after {
                display: none;
            }

            .login-form-section {
                border-radius: 0 0 20px 20px;
                padding: 40px 30px;
            }

            .login-form-section h1 {
                font-size: 42px;
            }

            .church-logo-section {
                margin-bottom: 30px;
            }

            .slideshow-container {
                height: 300px;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 15px;
            }

            .login-page {
                border-radius: 15px;
            }

            .login-illustration-section,
            .login-form-section {
                padding: 30px 20px;
            }

            .login-form-section h1 {
                font-size: 36px;
                margin-bottom: 30px;
            }

            .church-logo-section img {
                width: 70px;
                height: 70px;
            }

            .church-logo-section h2 {
                font-size: 20px;
            }

            .form-control {
                padding: 14px 15px 14px 45px;
                font-size: 15px;
            }

            .btn-login {
                padding: 14px;
                font-size: 16px;
            }

            .slide-overlay h3 {
                font-size: 32px;
            }

            .slide-overlay p {
                font-size: 15px;
            }

            .footer-text {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="text-center">
            <div class="loading-spinner"></div>
            <div class="loading-text">Logging in...</div>
        </div>
    </div>

    <video autoplay loop muted playsinline id="background-video">
        <source src="videos/loonbg_video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="login-page">
        <div class="login-illustration-section">
            <div class="church-logo-section">
                <img src="images/church_logo.jpg" alt="Our Lady of Light Parish Logo">
                <h2>Our Lady of Light Parish - Loon</h2>
            </div>

            <div class="slideshow-container">
                <div class="slide active" style="background-image: url('images/church_1.jpg')">
                    <div class="slide-overlay">
                        <h3>Our Lady of Light Parish</h3>
                        <p>A sacred place of worship and community in Loon, where faith and tradition meet in harmony.</p>
                    </div>
                </div>
                <div class="slide" style="background-image: url('images/church_2.jpg')">
                    <div class="slide-overlay">
                        <h3>Sacred Space</h3>
                        <p>Experience the divine presence in our beautifully maintained church, a testament to our rich heritage.</p>
                    </div>
                </div>
                <div class="slide" style="background-image: url('images/church_3.jpg')">
                    <div class="slide-overlay">
                        <h3>Community of Faith</h3>
                        <p>Join our vibrant community of believers, united in worship and service to God and our neighbors.</p>
                    </div>
                </div>
            </div>
            <div class="slide-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>

            <p class="footer-text">&copy; 2025 Our Lady of Light Parish - Loon. All rights reserved.</p>
        </div>

        <div class="login-form-section">
            <h1>Login</h1>
            
            <form action="index.php" method="POST" autocomplete="off" id="loginForm">
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required autocomplete="off">
                    <i class="fas fa-envelope input-icon"></i>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required autocomplete="new-password">
                    <i class="fas fa-lock input-icon"></i>
                </div>
                <button type="submit" name="login" class="btn-login" id="loginButton">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
            <div class="register-link">
                Don't have an account? <a href="#">Register Now</a>
            </div>

            <?php if (isset($loginError)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $loginError; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');
            let currentSlide = 0;
            const slideInterval = 2500; // Change slide every 2.5 seconds

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));

                slides[index].classList.add('active');
                dots[index].classList.add('active');
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });

            let slideTimer = setInterval(nextSlide, slideInterval);

            const slideshowContainer = document.querySelector('.slideshow-container');
            slideshowContainer.addEventListener('mouseenter', () => {
                clearInterval(slideTimer);
            });

            slideshowContainer.addEventListener('mouseleave', () => {
                slideTimer = setInterval(nextSlide, slideInterval);
            });

            showSlide(0);

            // Login form handling
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            const loadingOverlay = document.getElementById('loadingOverlay');

            loginForm.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                // Show loading state
                loginButton.classList.add('loading');
                loadingOverlay.style.display = 'flex';
                
            });
        });
    </script>
</body>
</html> 