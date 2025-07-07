<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.all_ads') - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 100%);
            min-height: 100vh;
        }
        .dashboard-header {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .ad-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        .ad-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }
        .delete-btn {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .welcome-section {
            background: linear-gradient(45deg, rgba(0, 123, 255, 0.1), rgba(0, 86, 179, 0.1));
            border: 1px solid rgba(0, 123, 255, 0.2);
            border-radius: 15px;
        }
        .stats-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    

    <nav class="navbar navbar-expand-lg dashboard-header sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-collection text-primary me-2"></i>
                MyBoard
            </a>
            <div class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">
                <div class="btn-group" role="group">
                    <a href="{{ route('lang.switch','en') }}" class="btn btn-outline-light btn-sm">EN</a>
                    <a href="{{ route('lang.switch','pl') }}" class="btn btn-outline-light btn-sm">PL</a>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>@lang('messages.logout')
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="welcome-section p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="text-light mb-2">
                        <i class="bi bi-person-circle me-2"></i>
                        @lang('messages.welcome') {{ Auth::user()->name }}!
                    </h2>
                    <p class="text-muted mb-0">@lang('messages.manage')</p>
                </div>
                <div class="col-md-4 text-md-end">
    <div class="stats-card p-3 rounded d-inline-block">
        <h5 class="text-primary mb-1">{{ count($ads) }}</h5>
        <small class="text-muted">@lang('messages.ads_amount')</small>
    </div>
</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                    <a href="{{ route('add') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>@lang('messages.add_new_ad')
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-envelope me-2"></i>@lang('messages.contact_admin')
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="text-light mb-4">
                    <i class="bi bi-grid-3x3-gap me-2"></i>@lang('messages.all_ads')
                </h3>

                @if(count($ads) === 0)
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">No advertisements yet</h4>
                        <p class="text-muted">Be the first to create an advertisement!</p>
                        <a href="{{ route('add') }}" class="btn btn-primary btn-lg mt-3">
                            <i class="bi bi-plus-circle me-2"></i>Create Your First Ad
                        </a>
                    </div>
                @else
                    <div class="row">
                        @foreach($ads as $ad)
                            <div class="col-lg-6 col-xl-4 mb-4">
                                <div class="card ad-card h-100 position-relative">
                                    <div class="card-body">
                                        <h5 class="card-title text-light mb-3">
                                            <i class="bi bi-megaphone me-2"></i>
                                            {{ $ad->title }}
                                        </h5>
                                        
                                        <div class="card-text mb-3">
                                            {!! Str::limit(strip_tags($ad->content), 150) !!}
                                        </div>
                                        
                                        <div class="mt-auto">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="bi bi-person-circle me-2"></i>
                                                @lang('messages.author') {{ $ad->user->email }}
                                            </small>
                                            @if($ad->user_id === auth()->id())
                                                <span class="badge bg-success mt-2">
                                                    <i class="bi bi-check-circle me-1"></i>Your Ad
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($ad->user_id === auth()->id())
                                        <form action="{{ route('ads.destroy', $ad->id) }}" 
                                              method="POST" 
                                              class="delete-btn"
                                              onsubmit="return confirm('Are you sure you want to delete this ad?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Your Ad">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
