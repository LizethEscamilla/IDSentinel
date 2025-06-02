<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IDSentinel - Control de Acceso</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        :root {
            --primary-color: #9D2449;
            --primary-light: #C12F5D;
            --primary-dark: #801A3A;
            --secondary-color: #2D4B73;
            --accent-color: #F2B705;
            --text-light: #ffffff;
            --text-dark: #1f2937;
            --gray-light: #f8fafc;
            --gray: #e5e7eb;
            --gray-dark: #6b7280;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--gray-light), #f1f5f9);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            line-height: 1.5;
        }

        .container {
            background-color: white;
            padding: 3rem;
            border-radius: 1.5rem;
            box-shadow: var(--shadow-xl);
            text-align: center;
            max-width: 480px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border-radius: 50%;
            font-size: 2rem;
            font-weight: 700;
            box-shadow: var(--shadow-md);
        }

        h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .subtitle {
            font-size: 1.1rem;
            color: var(--gray-dark);
            margin-bottom: 2.5rem;
            max-width: 320px;
            margin-left: auto;
            margin-right: auto;
        }

        .auth-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }

        .auth-link {
            padding: 0.9rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            text-align: center;
            box-shadow: var(--shadow-sm);
        }

        .login {
            background-color: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .login:hover {
            background-color: var(--primary-color);
            color: var(--text-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .register {
            background-color: var(--primary-color);
            color: var(--text-light);
            border: 2px solid transparent;
        }

        .register:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin: 2rem 0;
            text-align: left;
        }

        .feature {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--gray-dark);
        }

        .feature-icon {
            color: var(--primary-color);
            font-weight: bold;
            margin-top: 0.1rem;
        }

        footer {
            margin-top: 2rem;
            font-size: 0.8rem;
            color: var(--gray-dark);
        }

        @media (min-width: 640px) {
            .auth-links {
                flex-direction: row;
                justify-content: center;
            }
            
            .auth-link {
                min-width: 160px;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .logo {
            animation: fadeIn 0.6s ease-out 0.2s both;
        }

        h1 {
            animation: fadeIn 0.6s ease-out 0.3s both;
        }

        .subtitle {
            animation: fadeIn 0.6s ease-out 0.4s both;
        }

        .auth-links {
            animation: fadeIn 0.6s ease-out 0.5s both;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">IDS</div>
        
        <h1>Bienvenido(a) a IDSentinel</h1>
        <p class="subtitle">Plataforma administrativa de control de acceso</p>

        <div class="features">
            <div class="feature">
                <span class="feature-icon">✓</span>
                <span>Accesos en tiempo real</span>
            </div>
            <div class="feature">
                <span class="feature-icon">✓</span>
                <span>Estadísticas</span>
            </div>
            <div class="feature">
                <span class="feature-icon">✓</span>
                <span>Gestión de usuarios</span>
            </div>
            <div class="feature">
                <span class="feature-icon">✓</span>
                <span>Reportes detallados</span>
            </div>
        </div>

        @if (Route::has('login'))
            <div class="auth-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="auth-link login">
                        Ir al Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="auth-link login">
                        Iniciar Sesión
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="auth-link register">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        @endif

        <footer>
            © {{ date('Y') }} IDSentinel - Todos los derechos reservados
        </footer>
    </div>
</body>
</html>
</html>
