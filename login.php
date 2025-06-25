<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.all.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #007bff 60%, #00c6ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-form {
            background: #fff;
            color: #000;
            padding: 35px 30px 30px 30px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 123, 255, 0.18), 0 1.5px 8px rgba(0,0,0,0.10);
            width: 100%;
            max-width: 400px;
            position: relative;
        }
        .login-form .logo-market {
            display: flex;
            justify-content: center;
            margin-bottom: 18px;
        }
        .login-form .logo-market img {
            height: 64px;
            width: auto;
            border-radius: 10px;
            box-shadow: 0 2px 12px 0 rgba(0,123,255,0.15);
            background: #fff;
            padding: 4px 10px;
        }
        .login-form h2 {
            margin-bottom: 18px;
            font-weight: 700;
            color: #007bff;
            text-align: center;
        }
        .login-form .form-label {
            font-weight: 500;
        }
        .login-form .btn-primary {
            background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .login-form .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3 60%, #009ec3 100%);
        }
        /* Ganti bubble dengan ornamen tema teknologi */
        .tech-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }
        .tech-circuit {
            position: absolute;
            opacity: 0.18;
            filter: blur(0.2px);
            animation: techMove 18s linear infinite;
        }
        .tech-circuit.c1 {
            left: 8%; top: 10%; width: 120px; height: 120px;
            animation-delay: 0s;
        }
        .tech-circuit.c2 {
            left: 60%; top: 20%; width: 90px; height: 90px;
            animation-delay: 3s;
        }
        .tech-circuit.c3 {
            left: 30%; top: 60%; width: 140px; height: 140px;
            animation-delay: 6s;
        }
        .tech-circuit.c4 {
            left: 75%; top: 70%; width: 100px; height: 100px;
            animation-delay: 1.5s;
        }
        .tech-circuit.c5 {
            left: 45%; top: 35%; width: 80px; height: 80px;
            animation-delay: 5s;
        }
        @keyframes techMove {
            0% { transform: scale(1) rotate(0deg);}
            50% { transform: scale(1.08) rotate(3deg);}
            100% { transform: scale(1) rotate(0deg);}
        }
    </style>
</head>
<body>
<?php
if (isset($_GET['error']) && $_GET['error'] === 'login_gagal') {
    echo "
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal !',
        text: 'Periksa Kembali Username atau Password !',
    });
    </script>";
}
?>
<div class="tech-bg">
    <!-- SVG circuit style 1 -->
    <svg class="tech-circuit c1" viewBox="0 0 120 120" fill="none">
        <rect x="10" y="10" width="100" height="100" rx="18" stroke="#00c6ff" stroke-width="3"/>
        <circle cx="60" cy="60" r="30" stroke="#007bff" stroke-width="2"/>
        <rect x="55" y="15" width="10" height="20" fill="#00c6ff"/>
        <rect x="85" y="55" width="20" height="10" fill="#007bff"/>
    </svg>
    <!-- SVG circuit style 2 -->
    <svg class="tech-circuit c2" viewBox="0 0 90 90" fill="none">
        <rect x="10" y="10" width="70" height="70" rx="14" stroke="#007bff" stroke-width="2"/>
        <circle cx="45" cy="45" r="18" stroke="#00c6ff" stroke-width="2"/>
        <rect x="40" y="5" width="10" height="15" fill="#00c6ff"/>
        <rect x="65" y="40" width="15" height="10" fill="#007bff"/>
    </svg>
    <!-- SVG circuit style 3 -->
    <svg class="tech-circuit c3" viewBox="0 0 140 140" fill="none">
        <rect x="20" y="20" width="100" height="100" rx="22" stroke="#00c6ff" stroke-width="3"/>
        <circle cx="70" cy="70" r="40" stroke="#007bff" stroke-width="2"/>
        <rect x="65" y="25" width="10" height="25" fill="#00c6ff"/>
        <rect x="105" y="65" width="25" height="10" fill="#007bff"/>
    </svg>
    <!-- SVG circuit style 4 -->
    <svg class="tech-circuit c4" viewBox="0 0 100 100" fill="none">
        <rect x="15" y="15" width="70" height="70" rx="16" stroke="#007bff" stroke-width="2"/>
        <circle cx="50" cy="50" r="25" stroke="#00c6ff" stroke-width="2"/>
        <rect x="47" y="10" width="6" height="15" fill="#00c6ff"/>
        <rect x="75" y="47" width="15" height="6" fill="#007bff"/>
    </svg>
    <!-- SVG circuit style 5 -->
    <svg class="tech-circuit c5" viewBox="0 0 80 80" fill="none">
        <rect x="10" y="10" width="60" height="60" rx="12" stroke="#00c6ff" stroke-width="2"/>
        <circle cx="40" cy="40" r="18" stroke="#007bff" stroke-width="2"/>
        <rect x="37" y="5" width="6" height="10" fill="#00c6ff"/>
        <rect x="60" y="37" width="10" height="6" fill="#007bff"/>
    </svg>
</div>

    <div class="login-form">
        <div class="logo-market">
            <img src="assets/img/logomarket.png" alt="Logo Market-IT">
        </div>
        <h2>Login Market-IT</h2>
        <form method="post" action="login_proces.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username"  placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>