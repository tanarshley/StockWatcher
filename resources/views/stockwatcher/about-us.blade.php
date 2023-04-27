<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{!! $title !!}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/stockwatcher.css') }}">
        <!-- PWA  -->
        <meta name="theme-color" content="#6777ef"/>
        <link rel="apple-touch-icon" href="{{ asset('StockWatcher-icon.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">  

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>    
    </head>

    <body>
        <!-- create modal for login choice -->
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
        <!-- start of navbar -->
        <nav class="navbar navbar-expand-lg bg-none py-1">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('stockwatcher.home') }}" style="font-weight: 500;">{!! $title !!}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="{{ route('stockwatcher.home') }}">{{__('Home')}}</a>
                        <a class="nav-link active text-white" aria-current="page" href="{{ route('stockwatcher.about-us') }}">{{__('About Us')}}</a>
                        <a class="nav-link" href="{{ route('stockwatcher.contact-us') }}">{{__('Contact Us')}}</a>
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginChoiceModal" style="cursor: pointer;">{{__('Sign In')}}</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end of navbar -->
        <div class="container-fluid">
            <!-- add about us content here -->
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-center mt-5">About Us</h1>
                    <img src="{{ asset('icons/stockwatcher-icon.png') }}" alt="StockWatcher Logo" class="img-fluid mx-auto d-block mt-5" style="width: 300px;">
                    <p class="lead">Barangay Old Cabalan is a barangay in the city of Olongapo Zambales, Philippines. According to 2020 <a href="https://www.philatlas.com/luzon/r03/olongapo/old-cabalan.html" target="blank" style="color: rgb(39, 118, 255);">Census</a>, Old Cabalan has a population of 23,401 people. This represented 8.99% of the total population of Olongapo.</p>
                </div>
            </div>

            <footer class="d-flex flex-wrap justify-content-center align-items-center py-2 border-top" style="padding: 10px 20px 10px 20px; margin-top: 19%;">
                <p class="col-md-4 mb-0 text-muted"><!-- get the current year -->
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>

                <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                </a>

                <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item text-muted">Purok 11 Narra Lane Olongapo City, Zambales Philippines 2200</li>
                </ul>
            </footer>
        </div>
        

        <!-- scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" 
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
        </script>
        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function (reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        </script>
    </body>
</html>