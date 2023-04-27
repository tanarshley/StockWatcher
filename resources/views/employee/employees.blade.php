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
        @if(session('employeeAdded'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('employeeAdded') }}',
                showConfirmButton: false,
                timer: 2000,
                toast: true,
            });
            </script>
        @endif

        @if(session('employeeNotAdded'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{ session('employeeNotAdded') }}',
                showConfirmButton: false,
                timer: 2000,
                toast: true,
            });
            </script>
        @endif

        @if(session('passwordNotMatch'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('passwordNotMatch') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('employeeDeleted'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('employeeDeleted') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('employeeNotDeleted'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('employeeNotDeleted') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        <!-- show alert if has @errors -->
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
                    <div class="nav_list"> 
                        <a href="{{ route('employee.dashboard') }}" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                        <a href="{{ route('employee.medicines') }}" class="nav_link"> <i class='bx bx-capsule nav_icon'></i> <span class="nav_name">Medicines</span> </a> 
                        <a href="{{ route('employee.expired-medicines') }}" class="nav_link" id="expired-medicine"> <i class='bx bx-calendar-x nav_icon'></i> <span class="nav_name">Expired Medicines <span class="badge bg-danger">@if($allExpiredMedicinesToday->count() != 0) {{ $allExpiredMedicinesToday->count() }} @endif</span></span> </a>
                        <a href="{{ route('employee.medicine-requests') }}" class="nav_link"> <i class='bx bx-user-voice nav_icon'></i> <span class="nav_name">Medicine Requests <span class="badge bg-danger">@if($getAllPending->count() != 0) {{ $getAllPending->count() }} @endif</span> </a>
                        <a href="{{ route('employee.requests-history') }}" class="nav_link"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Requests History</span> </a>
                        <a href="{{ route('employee.release-history') }}" class="nav_link"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Release History</span> </a>
                        @if($LoggedEmployee->employee_role == 'Admin') 
                            <a href="{{ route('employee.employees') }}" class="nav_link active"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Employees</span> </a>
                        @else
                            <a href="{{ route('employee.employees') }}" class="nav_link" style="display: none;"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Employees</span> </a>
                        @endif
                        @if($LoggedEmployee->employee_role == 'Admin') 
                        <a href="{{ route('employee.constituents-list') }}" class="nav_link"> <i class='bx bx-user-pin nav_icon'></i> <span class="nav_name">Constituents</span> </a>
                        @else
                            <a href="{{ route('employee.constituents-list') }}" class="nav_link" style="display: none;"> <i class='bx bx-user-pin nav_icon'></i> <span class="nav_name">Constituents</span> </a>
                        @endif
                        <a href="{{ route('employee.account-information') }}" class="nav_link"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Account</span> </a>
                    </div>
                </div>
                <a href="{{ route('employee.logout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign Out</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100" style="padding-top: 65px;">
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page shows all the employees.</p>
            <div class="summary-card">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Employees</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $overallAllEmployees->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Admins</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allAdmins->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Employees</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allEmployees->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-list-of-overall-employees mt-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary border-0 text-white">
                        <div class="row">
                            <div class="col text-start">
                                <div class="row">
                                    <div class="col-9 text-start">
                                        <h5 class="card-title">List of Employees</h5>
                                    </div>
                                    <div class="col text-end">
                                        <form action=" {{ route('pdf.employees') }}" method="GET">
                                            <button type="submit" class="btn btn-sm btn-outline-light">Export to PDF</button>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($overallAllEmployees->count() <= 0)
                        <div class="alert alert-danger" role="alert">
                            No employees found. Please add employees.
                        </div>
                    @else
                        <div class="row m-3">
                            @foreach($overallAllEmployees as $employee)
                                <div class="col-md-4 mb-3">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header bg-info border-0">
                                            <h5 class="card-title text-white">{{ $employee->employee_name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col text-center">
                                                @if($employee->employee_picture == 'uploads/employee/default-picture.png' || $employee->employee_picture == null)
                                                    <img src="{{ asset('uploads/employee/default-picture.png') }}" class="img-fluid" alt="Responsive image" style="width: auto; height: 100px; border-radius: 50%;">
                                                @else
                                                    <img src="{{ asset('uploads/employee/'.$employee->employee_picture) }}" class="img-fluid" alt="Responsive image" style="width: 100px; height: 100px; border-radius: 50%;">
                                                @endif
                                                </div>
                                                <div class="col">
                                                    <p class="card-text">Email: {{ $employee->employee_email }}</p>
                                                    <p class="card-text">Role: {{ $employee->employee_role }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end border-0 bg-white mb-3">
                                            @if($LoggedEmployee->employee_id == $employee->employee_id)
                                                <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#viewEmployee{{ $employee->employee_id }}">View Employee</button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#deleteEmployee{{ $employee->employee_id }}">Delete Employee</button>
                                                <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#viewEmployee{{ $employee->employee_id }}">View Employee</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="viewEmployee{{ $employee->employee_id }}" tabindex="-1" aria-labelledby="viewEmployee{{ $employee->employee_id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="viewEmployee{{ $employee->employee_id }}Label">Viewing {{ $employee->employee_name }}'s Profile</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body mb-3">
                                            <div class="row">
                                                <div class="col text-center">
                                                    @if($employee->employee_picture == 'uploads/employee/default-picture.png' || $employee->employee_picture == null)
                                                        <img src="{{ asset('uploads/employee/default-picture.png') }}" class="img-fluid" alt="Responsive image" style="width: auto; height: 150px; border-radius: 50%;">
                                                    @else
                                                        <img src="{{ asset('uploads/employee/'.$employee->employee_picture) }}" class="img-fluid" alt="Responsive image" style="width: 150px; height: 150px; border-radius: 50%;">
                                                    @endif
                                                </div>
                                                <div class="col">
                                                    <p class="card-text">Name: {{ $employee->employee_name }}</p>
                                                    <p class="card-text">Email: {{ $employee->employee_email }}</p>
                                                    <p class="card-text">Role: {{ $employee->employee_role }}</p>
                                                    <p class="card-text">Phone: {{ $employee->employee_phone }}</p>
                                                    <p class="card-text">Date created: {{ date('d M Y', strtotime($employee->created_at)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- deleteEmployeeModal{{ $employee->employee_id }} -->
                            <div class="modal fade" id="deleteEmployee{{ $employee->employee_id }}" tabindex="-1" aria-labelledby="deleteEmployee{{ $employee->employee_id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="deleteEmployee{{ $employee->employee_id }}Label">Delete Employee</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete employee {{ $employee->employee_name }}?</p>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('employee.delete-employee', $employee->employee_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- addEmployeeModal -->
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employee.add-employee') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="employeeName" class="form-label">Name</label>
                                        <input type="text" class="form-control{{ $errors->has('employee_name') ? ' is-invalid' : '' }}" id="employeeName" name="employee_name" placeholder="Employee Name" required>
                                        @if ($errors->has('employee_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employee_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="employeeUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control{{ $errors->has('employee_username') ? ' is-invalid' : '' }}" id="employeeUsername" name="employee_username" placeholder="Employee Username" required>
                                        @if ($errors->has('employee_username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employee_username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="employeeEmail" class="form-label">Email Address</label>
                                        <input type="email" class="form-control{{ $errors->has('employee_email') ? ' is-invalid' : '' }}" id="employeeEmail" name="employee_email" placeholder="Employee Email" required>
                                        @if ($errors->has('employee_email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employee_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="employeePhone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control{{ $errors->has('employee_phone') ? ' is-invalid' : '' }}" id="employeePhone" name="employee_phone" placeholder="Employee Phone" required>
                                        @if ($errors->has('employee_phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employee_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="employeePassword" class="form-label">Password</label>
                                        <input type="password" class="form-control{{ $errors->has('employee_password') ? ' is-invalid' : '' }}" id="employeePassword" name="employee_password" placeholder="Password" required>
                                        @if ($errors->has('employee_password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employee_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="employee_confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control{{ $errors->has('employee_confirm_password') ? ' is-invalid' : '' }}" id="employee_confirm_password" name="employee_confirm_password" placeholder="Confirm Password" required>
                                        @if ($errors->has('employee_confirm_password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('employee_confirm_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="employeeRole" class="form-label">Employee Role</label>
                                <select class="form-select" id="employeeRole" name="employee_role" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Employee">Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-white">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Container Main end-->
        

        <!-- scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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