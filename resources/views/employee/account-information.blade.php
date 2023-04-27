<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{!! $title !!}</title>
        <!-- PWA  -->
        <meta name="theme-color" content="#6777ef"/>
        <link rel="apple-touch-icon" href="{{ asset('icons/stockwatcher-icon.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>

    <body id="body-pd">
        @if(session('employeeUpdated'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('employeeUpdated') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('employeeNotUpdated'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('employeeNotUpdated') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('employeePasswordUpdated'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('employeePasswordUpdated') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('employeePasswordNotUpdated'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('employeePasswordNotUpdated') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('employeeIncorrectCurrentPassword'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('employeeIncorrectCurrentPassword') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed. Please check your inputs.',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header-text"> Welcome, {{ $LoggedEmployee->employee_name }}</div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="{{ route('employee.dashboard') }}" class="nav_logo"> <img src="{{ asset('StockWatcher-icon.png') }}" style="width: auto; height: 60px; margin-left: -44px; margin-right: -32px;"> <span class="nav_logo-name">StockWatcher</span> </a>
                        <div class="nav_list"> <a href="{{ route('employee.dashboard') }}" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> 
                    </a> 
                    <a href="{{ route('employee.medicines') }}" class="nav_link"> <i class='bx bx-capsule nav_icon'></i> <span class="nav_name">Medicines</span> </a> 
                    <a href="{{ route('employee.expired-medicines') }}" class="nav_link" id="expired-medicine"> <i class='bx bx-calendar-x nav_icon'></i> <span class="nav_name">Expired Medicines <span class="badge bg-danger">@if($allExpiredMedicinesToday->count() != 0) {{ $allExpiredMedicinesToday->count() }} @endif</span></span> </a>
                    <a href="{{ route('employee.medicine-requests') }}" class="nav_link"> <i class='bx bx-user-voice nav_icon'></i> <span class="nav_name">Medicine Requests <span class="badge bg-danger">@if($getAllPending->count() != 0) {{ $getAllPending->count() }} @endif</span> </a>
                    <a href="{{ route('employee.requests-history') }}" class="nav_link"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Requests History</span> </a>
                    <a href="{{ route('employee.release-history') }}" class="nav_link"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Release History</span> </a>
                    @if($LoggedEmployee->employee_role == 'Admin') 
                        <a href="{{ route('employee.employees') }}" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Employees</span> </a>
                    @else
                        <a href="{{ route('employee.employees') }}" class="nav_link" style="display: none;"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Employees</span> </a>
                    @endif
                    @if($LoggedEmployee->employee_role == 'Admin') 
                        <a href="{{ route('employee.constituents-list') }}" class="nav_link"> <i class='bx bx-user-pin nav_icon'></i> <span class="nav_name">Constituents</span> </a>
                    @else
                        <a href="{{ route('employee.constituents-list') }}" class="nav_link" style="display: none;"> <i class='bx bx-user-pin nav_icon'></i> <span class="nav_name">Constituents</span> </a>
                    @endif
                    <a href="{{ route('employee.account-information') }}" class="nav_link active"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Account</span> </a> 
                </div>
                </div> <a href="{{ route('employee.logout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign Out</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100" style="padding-top: 65px;">
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page contains your account information.</p>
            <!--create a center card-->
            <div class="card mx-auto border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Account Information</h5>
                    <div class="row justify-content-center mb-3">
                        @if($LoggedEmployee->employee_picture == 'uploads/employee/default-picture.png' || $LoggedEmployee->employee_picture == null)
                            <img src="{{ asset('uploads/employee/default-picture.png') }}" class="img-fluid" alt="Responsive image" style="width: auto; height: 100px; border-radius: 50%;">
                            @else
                            <img src="{{ asset('uploads/employee/'.$LoggedEmployee->employee_picture) }}" class="img-fluid" alt="Responsive image" style="width: 130px; height: 100px; border-radius: 50%;">
                        @endif
                        <span class="text-center mb-3">{{ $LoggedEmployee->employee_username }}</span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="employee_name" placeholder="Employee Name" value="{{ $LoggedEmployee->employee_name }}" readonly>
                                <label for="employee_name">Full Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="employee_email" placeholder="Employee Email" value="{{ $LoggedEmployee->employee_email }}" readonly>
                                <label for="employee_email">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="employee_phone" placeholder="Employee Phone" value="{{ $LoggedEmployee->employee_phone }}" readonly>
                                <label for="employee_phone">Phone Number</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="employee_role" placeholder="Employee Role" value="{{ $LoggedEmployee->employee_role }}" readonly>
                                <label for="employee_role">Role</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0 bg-white mb-3">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#changePasswordModal{{ $LoggedEmployee->employee_id }}">Change Password</button>
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#changeInformationModal{{ $LoggedEmployee->employee_id }}">Change Information</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="changeInformationModal{{ $LoggedEmployee->employee_id }}" tabindex="-1" aria-labelledby="changeInformationModal{{ $LoggedEmployee->employee_id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="changeInformationModal{{ $LoggedEmployee->employee_id }}Label">Change Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('employee.edit-account-information', $LoggedEmployee->employee_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control{{ $errors->has('employee_name') ? ' is-invalid' : '' }}" id="employee_name" placeholder="Employee Name" value="{{ $LoggedEmployee->employee_name }}" name="employee_name">
                                        <label for="employee_name">Full Name</label>
                                        @if($errors->has('employee_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('employee_name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control{{ $errors->has('employee_username') ? ' is-invalid' : '' }}" id="employee_username" placeholder="Employee Username" value="{{ $LoggedEmployee->employee_username }}" name="employee_username">
                                        <label for="employee_username">Username</label>
                                        @if($errors->has('employee_username'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('employee_username') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control{{ $errors->has('employee_email') ? ' is-invalid' : '' }}" id="employee_email" placeholder="Employee Email" value="{{ $LoggedEmployee->employee_email }}" name="employee_email">
                                        <label for="employee_email">Email Address</label>
                                        @if($errors->has('employee_email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('employee_email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control{{ $errors->has('employee_phone') ? ' is-invalid' : '' }}" id="employee_phone" placeholder="Employee Phone" value="{{ $LoggedEmployee->employee_phone }}" name="employee_phone">
                                        <label for="employee_phone">Phone Number</label>
                                        @if($errors->has('employee_phone'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('employee_phone') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control{{ $errors->has('employee_role') ? ' is-invalid' : '' }}" id="employee_role" placeholder="Employee Role" value="{{ $LoggedEmployee->employee_role }}" name="employee_role">
                                        <label for="employee_role">Role</label>
                                        @if($errors->has('employee_role'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('employee_role') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="file" class="form-control{{ $errors->has('employee_picture') ? ' is-invalid' : '' }}" id="employee_picture" placeholder="Employee Picture" value="{{ $LoggedEmployee->employee_picture }}" name="employee_picture">
                                        <label for="employee_picture">Picture</label>
                                        @if($errors->has('employee_picture'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('employee_picture') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-white">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="changePasswordModal{{ $LoggedEmployee->employee_id }}" tabindex="-1" aria-labelledby="changePasswordModal{{ $LoggedEmployee->employee_id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="changePasswordModal{{ $LoggedEmployee->employee_id }}Label">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('employee.edit-account-password', $LoggedEmployee->employee_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control{{ $errors->has('employee_password') ? ' is-invalid' : '' }}" id="employee_password" placeholder="Old Password" name="employee_password">
                                        <label for="employee_password">Old Password</label>
                                        @if($errors->has('employee_password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('employee_password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" id="new_password" placeholder="New Password" name="new_password">
                                        <label for="new_password">New Password</label>
                                        @if($errors->has('new_password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('new_password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation">
                                        <label for="password_confirmation">Confirm Password</label>
                                        @if($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-white">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Container Main end-->
        

        <!-- scripts -->
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
        <script src="{{ asset('js/navbar.js') }}"></script>
    </body>
</html>