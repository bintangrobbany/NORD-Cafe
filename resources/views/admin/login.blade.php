<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | NORD Cafe</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Variabel Warna Tema */
        :root {
            --brown-dark: #3E2723;
            --brown-medium: #6D4C41;
            --brown-light: #D7CCC8;
            --background-color: #F5F5F5;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--background-color);
        }

        /* Bagian Kiri (Branding Image) */
        .branding-side {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1559925393-8be0ec4767c8?q=80&w=1991&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
        }

        .branding-side h1 {
            font-family: var(--font-serif);
            font-size: 3.5rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .branding-side p {
            font-size: 1.1rem;
            max-width: 400px;
            margin-top: 15px;
            opacity: 0.9;
        }

        /* Bagian Kanan (Form Login) */
        .login-form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            animation: slideIn 0.7s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header .icon {
            font-size: 2.5rem;
            color: var(--brown-dark);
        }

        .login-header h3 {
            color: var(--brown-dark);
            font-weight: 600;
            margin-top: 15px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: var(--brown-medium);
            box-shadow: 0 0 0 0.25rem rgba(62, 39, 35, 0.2);
        }

        .btn-custom-login {
            background-color: var(--brown-dark);
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-custom-login:hover {
            background-color: #261a18;
            color: white;
        }

        .alert-custom {
            background-color: #f8d7da;
            color: #721c24;
            border: none;
            border-left: 5px solid #d9534f;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <div class="container-fluid g-0">
        <div class="row g-0 min-vh-100">
            <!-- Bagian Kiri (Branding) -->
            <div class="col-lg-7 d-none d-lg-block">
                <div class="branding-side vh-100">
                    <div>
                        <h1>NORD Cafe</h1>
                        <p>Welcome to the heart of our operations. Manage products, track orders, and keep the coffee
                            flowing.</p>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan (Form Login) -->
            <div class="col-lg-5">
                <div class="login-form-container vh-100">
                    <div class="login-card">
                        <div class="login-header">
                            <i class="fas fa-mug-hot icon"></i>
                            <h3>Administrator Sign In</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-custom mb-3" role="alert">
                                    Email or password you entered is incorrect.
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-custom-login">
                                Sign In <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>