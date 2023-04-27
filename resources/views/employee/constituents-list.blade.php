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
        @if(session('constituentAdded'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('constituentAdded') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif
        
        @if(session('constituentNotAdded'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('constituentNotAdded') }}',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif

        @if(session('constituentRemoved'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('constituentRemoved') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('constituentNotRemoved'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('constituentNotRemoved') }}',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif

        @if(session('constituentDeleted'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('constituentDeleted') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('constituentNotDeleted'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Failed to delete constituent',
                    text: '{{ session('constituentNotDeleted') }}',
                    showConfirmButton: true,
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
                        <a href="{{ route('employee.constituents-list') }}" class="nav_link active"> <i class='bx bx-user-pin nav_icon'></i> <span class="nav_name">Constituents</span> </a>
                    @else
                        <a href="{{ route('employee.constituents-list') }}" class="nav_link" style="display: none;"> <i class='bx bx-user-pin nav_icon'></i> <span class="nav_name">Constituents</span> </a>
                    @endif
                    <a href="{{ route('employee.account-information') }}" class="nav_link"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Account</span> </a> 
                </div>
                </div> <a href="{{ route('employee.logout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign Out</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100" style="padding-top: 65px;">
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page contains all constituents that can request for medicines.</p>
            <div class="summary-card">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Constituents</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allConstituentsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="medicines-table-list mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <div class="row">
                                    <div class="col text-start">
                                        <div class="row">
                                            <div class="col-9 text-start">
                                                <h5 class="card-title text-white">Constituents</h5>
                                            </div>
                                            <div class="col text-end">
                                                <form action=" {{ route('pdf.constituents') }}" method="GET">
                                                    <button type="submit" class="btn btn-sm btn-outline-light">Export to PDF</button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addConstituentModal">Add Constituent</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($allConstituents->count() <= 0)
                                <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">No Constituents Found!</h4>
                                        <p>There are no constituents that can request for medicines. Please add a constituent first.</p>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-striped" id="medicines-table">
                                        <thead> 
                                            <tr class="text-center">
                                                <th>Household ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allConstituents as $constituent)
                                            <tr class="text-center">
                                                <td>{{ $constituent->household_id }}</td>
                                                <td>{{ $constituent->constituent_name }}</td>
                                                <td>{{ $constituent->constituent_address }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewConstituentModal{{ $constituent->constituent_id }}">View</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConstituentModal{{ $constituent->constituent_id }}">Remove</button>
                                                </td>
                                            </tr>
                                            <!-- viewConstituentModal{{ $constituent->constituent_id }} -->
                                            <div class="modal fade" id="viewConstituentModal{{ $constituent->constituent_id }}" tabindex="-1" aria-labelledby="viewConstituentModal{{ $constituent->constituent_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="viewConstituentModal{{ $constituent->constituent_id }}Label">Viewing {{ $constituent->constituent_name }}'s Profile</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mb-3">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p class="card-text">Household ID: {{ $constituent->household_id }}</p>
                                                                    <p class="card-text">Name: {{ $constituent->constituent_name }}</p>
                                                                    <p class="card-text">Birthdate: {{ date('d M Y', strtotime($constituent->constituent_birthdate)) }}</p>
                                                                    <p class="card-text">Email: {{ $constituent->constituent_email }}</p>
                                                                    <p class="card-text">Phone: {{ $constituent->constituent_phone }}</p>
                                                                    <p class="card-text">Address: {{ $constituent->constituent_address }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- deleteConstituentModal{{ $constituent->constituent_id }} -->
                                            <div class="modal fade" id="deleteConstituentModal{{ $constituent->constituent_id }}" tabindex="-1" aria-labelledby="deleteConstituentModal{{ $constituent->constituent_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="deleteConstituentModal{{ $constituent->constituent_id }}Label">Remove {{ $constituent->constituent_name }}?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to remove {{ $constituent->constituent_name }} from the list of constituents?</p>
                                                            <p class="text-danger">This action cannot be undone. The constituent will not be able to login as constituent once the account is removed.</p>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('employee.delete-constituent', $constituent->constituent_id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-center">
                                        {{ $allConstituents->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- addConstituentModal -->
        <div class="modal fade" id="addConstituentModal" tabindex="-1" aria-labelledby="addConstituentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="addConstituentModalLabel">Add Constituent</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('employee.add-constituent') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="household_id" class="form-label">Household ID</label>
                                <input type="text" class="form-control{{ $errors->has('household_id') ? ' is-invalid' : '' }}" id="householdId" name="household_id" placeholder="Enter Household ID" required>
                                @if ($errors->has('household_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('household_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="constituentFirstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control{{ $errors->has('constituent_firstName') ? ' is-invalid' : '' }}" id="constituentFirstName" name="constituent_firstName" placeholder="Enter First Name" required>
                                        @if ($errors->has('constituent_firstName'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('constituent_firstName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="constituentMiddleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control{{ $errors->has('constituent_middleName') ? ' is-invalid' : '' }}" id="constituentMiddleName" name="constituent_middleName" placeholder="Enter Middle Name" required>
                                        @if ($errors->has('constituent_middleName'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('constituent_middleName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="constituentLastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control{{ $errors->has('constituent_lastName') ? ' is-invalid' : '' }}" id="constituentLastName" name="constituent_lastName" placeholder="Enter Last Name" required>
                                        @if ($errors->has('constituent_lastName'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('constituent_lastName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="constituentBirthdate" class="form-label">Birthdate</label>
                                        <input type="date" class="form-control{{ $errors->has('constituent_birthdate') ? ' is-invalid' : '' }}" id="constituentBirthdate" name="constituent_birthdate" placeholder="Enter Birthdate" required>
                                        @if ($errors->has('constituent_birthdate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('constituent_birthdate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="constituentAddress" class="form-label">Address</label>
                                        <input type="text" class="form-control{{ $errors->has('constituent_address') ? ' is-invalid' : '' }}" id="constituentAddress" name="constituent_address" placeholder="Enter Address" required>
                                        @if ($errors->has('constituent_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('constituent_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="constituentEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control{{ $errors->has('constituent_email') ? ' is-invalid' : '' }}" id="constituentEmail" name="constituent_email" placeholder="Enter Email" required>
                                        @if ($errors->has('constituent_email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('constituent_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="constituentPhone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control{{ $errors->has('constituent_phone') ? ' is-invalid' : '' }}" id="constituentPhone" name="constituent_phone" placeholder="Enter Phone Number" required>
                                        @if ($errors->has('constituent_phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('constituent_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Add Constituent</button>
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