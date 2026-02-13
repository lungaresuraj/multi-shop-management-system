<?php
require_once 'config/db.php';

// Redirect if already logged in
if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'admin') {
        header("Location: dashboard_admin.php");
        exit();
    } elseif ($_SESSION['user_type'] == 'shop') {
        header("Location: dashboard_shop.php");
        exit();
    }
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $login_type = $_POST['login_type'];
    
    if ($login_type == 'admin') {
        $query = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $admin = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            $_SESSION['email'] = $admin['email'];
            $_SESSION['user_type'] = 'admin';
            header("Location: dashboard_admin.php");
            exit();
        } else {
            $error = "Invalid admin credentials!";
        }
    } else {
        $query = "SELECT * FROM shops WHERE email = '$email' AND password = '$password' AND status = 'active'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $shop = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $shop['id'];
            $_SESSION['shop_name'] = $shop['shop_name'];
            $_SESSION['owner_name'] = $shop['owner_name'];
            $_SESSION['email'] = $shop['email'];
            $_SESSION['user_type'] = 'shop';
            header("Location: dashboard_shop.php");
            exit();
        } else {
            $error = "Invalid shop credentials or account inactive!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEROMAN - Multi-Shop Management System Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
            border-radius: 20px 20px 0 0 !important;
            border: none;
        }

        .card-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 32px;
            letter-spacing: 2px;
        }

        .card-header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .card-body {
            padding: 40px;
        }

        .form-control, .form-select {
            height: 50px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: none;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            height: 50px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102,126,234,0.3);
            color: white;
        }

        .input-group-text {
            background: transparent;
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #667eea;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .login-type-selector {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .login-type {
            flex: 1;
            text-align: center;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .login-type.active {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .login-type i {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .login-type span {
            display: block;
            font-size: 14px;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 30px 20px;
            }
            
            .login-type {
                padding: 10px;
            }
            
            .login-type i {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card animate__animated animate__fadeIn">
            <div class="card-header">
                <h2>ZEROMAN</h2>
                <p>Multi-Shop Management System</p>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" id="loginForm">
                    <input type="hidden" name="login_type" id="login_type" value="admin">
                    
                    <div class="login-type-selector">
                        <div class="login-type active" onclick="selectLoginType('admin')" id="adminType">
                            <i class="fas fa-user-shield"></i>
                            <span>Admin</span>
                        </div>
                        <div class="login-type" onclick="selectLoginType('shop')" id="shopType">
                            <i class="fas fa-store"></i>
                            <span>Shop Owner</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="Email Address" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Password" required>
                            <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword()">
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-login w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none" style="color: #667eea;">Forgot Password?</a>
                    </div>

                    <div class="register-link">
                        <p class="mb-0">Don't have an account? <a href="register.php">Register your shop</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Select login type
        function selectLoginType(type) {
            document.getElementById('login_type').value = type;
            
            if (type === 'admin') {
                document.getElementById('adminType').classList.add('active');
                document.getElementById('shopType').classList.remove('active');
            } else {
                document.getElementById('shopType').classList.add('active');
                document.getElementById('adminType').classList.remove('active');
            }
        }

        // Toggle password visibility
        function togglePassword() {
            const password = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            
            if (password.type === 'password') {
                password.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Please fill in all fields');
            }
        });

        // Demo credentials
        console.log('Demo Credentials:');
        console.log('Admin - Email: admin@zeroman.com, Password: admin123');
        console.log('Shop - Email: john@electronics.com, Password: shop123');
    </script>
</body>
</html>