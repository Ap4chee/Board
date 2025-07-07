<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Advertisement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
        }
        .add-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .lang-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .add-icon {
            background: linear-gradient(45deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .ck-editor__editable {
            min-height: 200px;
        }
        .ck.ck-editor {
            background: transparent;
        }
        .ck.ck-editor__main > .ck-editor__editable {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
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
            <div class="col-md-10 col-lg-8">
                <div class="card add-card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="add-icon display-4 mb-3">
                                <i class="bi bi-plus-circle-fill"></i>
                            </h1>
                            <h2 class="text-light">@lang('messages.add_new_ad')</h2>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-2 list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="bi bi-dot"></i> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('ads.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="title" class="form-label">
                                    <i class="bi bi-card-heading me-2"></i>@lang('messages.title')
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="title" 
                                       name="title" 
                                       placeholder="Sprzedam opla" 
                                       value="{{ old('title') }}"
                                       required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="editor" class="form-label">
                                    <i class="bi bi-file-text me-2"></i>@lang('messages.content')
                                </label>
                                <textarea name="content" 
                                          id="editor" 
                                          placeholder="Opel Corsa D 2012 1.4 Benzyna 100KM          
Silnik 4 cylindrowy na łańcuszku, super jednostka
Wersja na 150 lecie Opla, świetne miejskie auto z niskim spalaniem 
W jednych rękach przez 6 lat, olej z filtrami wymieniany co 10 tys
Przebieg 116 tys km 
Zrobiony pełen serwis klimatyzacji 
Widoczne pekniecie skóry na fotelu, auto zadbane i garażowane 
Zapraszam do kontaktu ">{{ old('content') }}</textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg me-md-2">
                                    <i class="bi bi-arrow-left me-2"></i>@lang('messages.back')
                                </a>
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>@lang('messages.add')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                }
            })
            .catch(error => { 
                console.error('CKEditor initialization error:', error); 
            });
    </script>
</body>
</html>
