<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.register')</title>
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
            <div class="col-md-6 col-lg-5">
                <div class="card auth-card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="brand-title fw-bold mb-3">
                                <i class="bi bi-person-plus-fill"></i> @lang('messages.join_us')
                            </h1>
                            <h4 class="text-light">@lang('messages.register')</h4>
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

                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person me-2"></i>@lang('messages.name')
                                </label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Enter your full name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock me-2"></i>@lang('messages.password')
                                </label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Create a password" required>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill me-2"></i>@lang('messages.confirm_pas')
                                </label>
                                <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-lg w-100 mb-3">
                                <i class="bi bi-person-check me-2"></i>@lang('messages.register')
                            </button>
                        </form>

                        <div class="text-center">
                            <p class="text-muted mb-0">@lang('messages.have_account')</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-light">
                                <i class="bi bi-box-arrow-in-right me-2"></i>@lang('messages.login')
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
