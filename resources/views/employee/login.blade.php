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
                <a class="navbar-brand" href="{{ route('stockwatcher.home') }}" style="font-weight: 500;">{!! $title !!} | <span class="text-muted">Employee</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="{{ route('stockwatcher.home') }}">{{__('Home')}}</a>
                        <a class="nav-link" href="{{ route('stockwatcher.about-us') }}">{{__('About Us')}}</a>
                        <a class="nav-link" href="{{ route('stockwatcher.contact-us') }}">{{__('Contact Us')}}</a>
                        <a class="nav-link active text-white" data-bs-toggle="modal" data-bs-target="#loginChoiceModal" style="cursor: pointer;">{{__('Sign In')}}</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end of navbar -->
        <div class="container-fluid">
            <!-- add about us content here -->
            <div class="row mt-5 justify-content-center">
                <div class="col-md-7 d-flex align-items-center">
                    <div class="container">
                        <h1>Welcome to StockWatcher | </h1>
                        <h1 class="text-muted">Employee</h1>
                        <p class="lead">Monitor your medicines supplies and stocks with ease using StockWatcher</p>
                    </div>
                </div>

                <div class="col-md-4 mt-5">
                    <div class="card border-0 p-1 shadow-sm">
                        <div class="card-body">
                            <div class="card-body">
                                <h3 class="card-title text-center mb-4">Welcome to StockWatcher</h3>
                                @if(session('notFound'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('notFound') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if(session('loginIncorrect'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('loginIncorrect') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <form action="{{ route('employee.employee-login') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="employee_username" class="mb-1">Username</label>
                                        <input type="text" name="employee_username" id="employee_username" class="form-control" placeholder="Enter your username">
                                    </div>
                                    <div class="form-group">
                                        <label for="employee_password" class="mb-1">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="employee_password" id="employee_password" class="form-control" placeholder="Enter your password" aria-describedby="helpId">
                                            <span class="input-group-text" id="basic-addon2" style="cursor: pointer;" onclick="showEmployeePassword()"><i class='bx bx-hide'></i></span>
                                        </div>
                                        <div class="text-end mt-1">
                                            <a type="small" id="helpId" href="{{ route('ForgetPasswordGet') }}" class="form-text">Forgot your password?</a>   
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-0 d-flex justify-content-center mb-2">
                                    <div class="d-grid gap-2 mx-auto col-12">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="d-flex flex-wrap justify-content-center align-items-center py-2 border-top" style="padding: 10px 20px 10px 20px; margin-top: 11.5%;">
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
        <script>
            function showEmployeePassword() {
                var x = document.getElementById("employee_password");
                if (x.type === "password") {
                    x.type = "text";
                    //change icon
                    document.getElementById("basic-addon2").innerHTML = "<i class='bx bx-show'></i>";
                } else {
                    x.type = "password";
                    //change icon
                    document.getElementById("basic-addon2").innerHTML = "<i class='bx bx-hide'></i>";
                }
            }
        </script>
    </body>
</html>