<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel – All Ads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 100%);
            min-height: 100vh;
        }
        .admin-header {
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg admin-header sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-shield-check text-danger me-2"></i>
                Admin Panel
            </a>
            <div class="navbar-nav ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-light mb-0">
                        <i class="bi bi-collection me-2"></i>All Advertisements
                    </h2>
                    <span class="badge bg-primary fs-6">{{ count($ads) }} Total Ads</span>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(count($ads) === 0)
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">No advertisements found</h4>
                        <p class="text-muted">There are currently no ads in the system.</p>
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
                                                Author: {{ $ad->user->email }}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('admin.ads.destroy', $ad->id) }}" 
                                          class="delete-btn"
                                          onsubmit="return confirm('Are you sure you want to delete this ad?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Ad">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
