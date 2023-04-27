<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/stockwatcher.css') }}">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>    

    </head>
<body>
        <nav class="navbar navbar-expand-lg bg-none py-1 mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('stockwatcher.home') }}" style="font-weight: 500;">StockWatcher</a>
                <button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active text-white" aria-current="page" href="{{ route('stockwatcher.home') }}">{{__('Home')}}</a>
                        <a class="nav-link" href="{{ route('stockwatcher.about-us') }}">{{__('About Us')}}</a>
                        <a class="nav-link" href="{{ route('stockwatcher.contact-us') }}">{{__('Contact Us')}}</a>
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginChoiceModal" style="cursor: pointer;">{{__('Sign In')}}</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="loginChoiceModal" tabindex="-1" aria-labelledby="loginChoiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="loginChoiceModalLabel">Login as</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center justify-content-center align-items-center">
                            <h5 class="card-text mb-3">Who are you logging in as?</h5>
                            <div class="col-sm-6 mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-lg btn-light border-0 p-4" onclick="window.location.href='{{ route('constituent.login') }}'">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <i class='bx bx-user-pin bx-lg'></i>
                                            </div>
                                            <a href="{{ route('constituent.login') }}">Constituent</a>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-lg btn-light border-0 p-4" onclick="window.location.href='{{ route('employee.login') }}'">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <i class='bx bx-user-circle bx-lg'></i>
                                            </div>
                                            <a href="{{ route('employee.login') }}">Employee</a>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" 
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
        </script>
@yield('content')
     
</body>
</html>