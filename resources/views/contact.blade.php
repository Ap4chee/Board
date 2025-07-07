<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
        }
        .contact-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .lang-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .contact-icon {
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

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card contact-card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="contact-icon display-4 mb-3">
                                <i class="bi bi-envelope-heart"></i>
                            </h1>
                            <h2 class="text-light">@lang('messages.contact_admin')</h2>
                            <p class="text-muted">@lang('messages.send_to')</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <ul class="mb-0 list-unstyled">
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.send') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="subject" class="form-label">
                                    <i class="bi bi-chat-square-text me-2"></i>@lang('messages.title')
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="subject" 
                                       name="subject" 
                                       placeholder="Enter the subject of your message" 
                                       value="{{ old('subject') }}" 
                                       required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="message" class="form-label">
                                    <i class="bi bi-chat-dots me-2"></i>@lang('messages.message')
                                </label>
                                <textarea class="form-control" 
                                          id="message" 
                                          name="message" 
                                          rows="6" 
                                          placeholder="Write your message here..." 
                                          required>{{ old('message') }}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="bi bi-send me-2"></i>@lang('messages.send')
                            </button>
                        </form>

                        <div class="text-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-light">
                                <i class="bi bi-arrow-left me-2"></i>@lang('messages.back')
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
