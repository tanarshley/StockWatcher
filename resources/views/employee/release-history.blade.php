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
                    <a href="{{ route('employee.release-history') }}" class="nav_link active"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Release History</span> </a>
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
                    <a href="{{ route('employee.account-information') }}" class="nav_link"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Account</span> </a> 
                </div>
                </div> <a href="{{ route('employee.logout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign Out</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100" style="padding-top: 65px;">
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page shows all release medicines history.</p>
            <div class="summary-card">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Release</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allReleaseMedicineHistory->count() }}</p>
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
                                                <h5 class="card-title text-white">Release Medicines History</h5>
                                            </div>
                                            <div class="col text-end">
                                                <form action=" {{ route('pdf.release-history') }}" method="GET">
                                                    <button type="submit" class="btn btn-sm btn-outline-light">Export to PDF</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($allReleaseMedicineHistory->count() <= 0)
                                <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">No Release Medicines History!</h4>
                                        <p>There are currently no release medicines history.</p>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-striped" id="medicines-table">
                                        <thead> 
                                            <tr class="text-center">
                                                <th>Release #</th>
                                                <th>Medicine Name</th>
                                                <th>Release Quantity</th>
                                                <th>Processed By</th>
                                                <th>Processed At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allReleaseMedicineHistory as $releaseMedicine)
                                                @foreach($medicineInfo as $medicine_info)
                                                    @foreach($employeeInfo as $employee_info)
                                                        <tr class="text-center">
                                                            <td>{{ $releaseMedicine->release_history_id }}</td>
                                                            <td>{{ $medicine_info->medicine_name }} ({{ $medicine_info->medicine_no_of_milligrams }} {{ $medicine_info->medicine_measurement }})</td>
                                                            <td>{{ $releaseMedicine->release_quantity}}</td>
                                                            <td>{{ $employee_info->employee_name }}</td>
                                                            <td>{{ date('F d, Y', strtotime($releaseMedicine->created_at)) }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $releaseMedicine->release_history_id }}">
                                                                    View
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $releaseMedicine->release_history_id }}">Delete</button>
                                                            </td>
                                                        </tr>

                                                        <!-- create view modal -->
                                                        <div class="modal fade" id="viewModal{{ $releaseMedicine->release_history_id }}" tabindex="-1" aria-labelledby="viewModal{{ $releaseMedicine->release_history_id }}Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                                <div class="modal-content">
                                                                    <div class="modal-header border-0">
                                                                        <h5 class="modal-title" id="viewModal{{ $releaseMedicine->release_history_id }}Label">Release Details</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group mb-3">
                                                                                    <label for="medicine">Medicine</label>
                                                                                    <input type="text" class="form-control bg-white" id="medicine" value="{{ $medicine_info->medicine_name }} ({{ $medicine_info->medicine_no_of_milligrams }} {{ $medicine_info->medicine_measurement }})" disabled style="font-weight: 600;">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="form-group mb-3">
                                                                                    <label for="releaseqty">Release Quantity</label>
                                                                                    <input type="number" class="form-control bg-white" id="releaseqty" value="{{ $releaseMedicine->release_quantity }}" disabled style="font-weight: 600;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group mb-3">
                                                                                    <label for="employee">Processed By</label>
                                                                                    <input type="text" class="form-control bg-white" id="employee" value="{{ $employee_info->employee_name }}" disabled style="font-weight: 600;">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="form-group mb-3">
                                                                                    <label for="date">Processed At</label>
                                                                                    <input type="text" class="form-control bg-white" id="date" value="{{ date('F d, Y h:i A', strtotime($releaseMedicine->created_at)) }}" disabled style="font-weight: 600;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-center">
                                        {{ $allReleaseMedicineHistory->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
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