<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.login')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
        }
        .auth-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .lang-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .brand-title {
            background: linear-gradient(45deg, #007bff, #0056b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body>
    <div class="lang-switcher">
        <div class="btn-group" role="group">
            <a href="{{ route('lang.switch','en') }}" class="btn btn-outline-light btn-sm">EN</a>
            <a href="{{ route('lang.switch','pl') }}" class="btn btn-outline-light btn-sm">PL</a>
        </div>
    </div>

    <div class="container-fluid d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card auth-card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="brand-title fw-bold mb-3">
                                <i class="bi bi-shield-lock"></i> MyBoard
                            </h1>
                            <h4 class="text-light">@lang('messages.login')</h4>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <ul class="mb-0 list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </label>
                                <input class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock me-2"></i>@lang('messages.password')
                                </label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>@lang('messages.login')
                            </button>
                        </form>

                        <div class="text-center">
                            <p class="text-muted mb-0">Don't have an account?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-light">
                                <i class="bi bi-person-plus me-2"></i>@lang('messages.register')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
