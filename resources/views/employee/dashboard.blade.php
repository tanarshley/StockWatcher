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
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>

    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header-text"> 
                Welcome, {{ $LoggedEmployee->employee_name }}
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="{{ route('employee.dashboard') }}" class="nav_logo"> <img src="{{ asset('StockWatcher-icon.png') }}" style="width: auto; height: 60px; margin-left: -44px; margin-right: -32px;"> <span class="nav_logo-name">StockWatcher</span> </a>
                        <div class="nav_list"> <a href="{{ route('employee.dashboard') }}" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> 
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
                    <a href="{{ route('employee.account-information') }}" class="nav_link"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Account</span> </a> 
                </div>
                </div> <a href="{{ route('employee.logout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign Out</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100" style="padding-top: 65px;">
            <!-- create  a script that auto open the modal if there are expired medicines today -->
            @if($allExpiredMedicinesToday->count() != 0)
                <script>
                    window.onload = function() {
                        $('#expiredMedicineModal').modal('show');
                    }
                </script>
            @endif
            <div class="modal fade" id="expiredMedicineModal" tabindex="-1" aria-labelledby="expiredMedicineModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="expiredMedicineModalLabel">Expired Medicines Today</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <h5> There are {{ $allExpiredMedicinesToday->count() }} expired medicine(s) today</h5>
                            <p class="text-muted">Please check the expired medicines for more information.</p>
                        </div>
                        <div class="modal-footer border-0 text-center">
                            <div class="d flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Later</button>
                                <a href="{{ route('employee.expired-medicines') }}" class="btn btn-sm btn-primary">Check Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page contains all summary information about the medicines and medicine requests.</p>
            <div class="summary-card">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Medicines</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allMedicines->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Expired Medicines</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allExpiredMedicines->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Release Medicines</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $totalReleasedMedicines->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Medicine Requests</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allMedicineRequests->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="upcoming-expired-medicines mt-3">
                <div class="row">
                    <div class="col-md-6">
                    <h4>Upcoming Expiry Medicines</h4>
                        @if($UpcomingExpiringMedicines->count() <= 0)
                        <div class="alert alert-info" role="alert">
                            There are currently no upcoming expiring medicines.
                        </div>
                        @else
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Medicine Name</th>
                                                <th scope="col">Medicine Category</th>
                                                <th scope="col">Medicine Quantity</th>
                                                <th scope="col">Medicine Expiry Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($UpcomingExpiringMedicines as $expiredMedicine)
                                            <tr>
                                                <td>{{ $expiredMedicine->medicine_name }}</td>
                                                <td>{{ $expiredMedicine->medicine_category }}</td>
                                                <td>{{ $expiredMedicine->medicine_quantity }}</td>
                                                <td>{{ date('d-m-Y', strtotime($expiredMedicine->medicine_date_of_expiry)) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                    <h4>Latest Medicine Requests</h4>
                        @if($latestMedicineRequests->count() <= 0)
                        <div class="alert alert-info" role="alert">
                            There are currently no medicine requests.
                        </div>
                        @else
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Constituent Name</th>
                                                <th scope="col">Medicine Name</th>
                                                <th scope="col">Medicine Quantity</th>
                                                <th scope="col">Requested at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($latestMedicineRequests as $latestRequests)
                                            @foreach($latestMedicineRequestsConstituents as $latestRequestsConstituents)
                                            @foreach($latestMedicineRequestsMedicines as $latestRequestsMedicines)
                                                <tr>
                                                    <td>{{ $latestRequestsConstituents->constituent_name }}</td>
                                                    <td>{{ $latestRequestsMedicines->medicine_name }}</td>
                                                    <td>{{ $latestRequests->quantity_of_request }} Tablets</td>
                                                    <td>{{ date('d-m-Y', strtotime($latestRequests->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer border-0 bg-transparent">
                                    <a class="float-end" href="{{ route('employee.medicine-requests') }}">View All</a>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    <!--Container Main end-->
        

        <!-- scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" 
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function (reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        </script>
        <script src="{{ asset('js/navbar.js') }}"></script>
        <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
    </body>
</html>