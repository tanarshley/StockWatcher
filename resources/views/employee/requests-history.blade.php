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

        @if(session('historyDeleted'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('historyDeleted') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                });
            </script>
        @endif

        @if(session('historyNotDeleted'))
        <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to delete request history',
                    text: '{{ session('historyNotDeleted') }}',
                    showConfirmButton: true,
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
                    <a href="{{ route('employee.requests-history') }}" class="nav_link active"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Requests History</span> </a>
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
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page shows all constituents medicine requests history.</p>
            <div class="summary-card">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total History</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $requestHistoryCounts }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Delivered</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $getAllDelivered->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Rejected</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $getAllRejected->count() }}</p>
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
                                                <h5 class="card-title text-white">Medicine Requests History</h5>
                                            </div>
                                            <div class="col text-end">
                                                <form action=" {{ route('pdf.request-history') }}" method="GET">
                                                    <button type="submit" class="btn btn-sm btn-outline-light">Export to PDF</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($requestHistory->count() <= 0)
                                <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">No Medicine Requests History!</h4>
                                        <p>There are currently no medicine requests history.</p>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-striped" id="medicines-table">
                                        <thead> 
                                            <tr class="text-center">
                                                <th>Household ID</th>
                                                <th>Name</th>
                                                <th>Medicine</th>
                                                <th>Processed By</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($requestHistory as $history)
                                                @foreach($requestHistoryMedicines as $medicine)
                                                    @foreach($requestHistoryConstituents as $constituent)
                                                        <tr class="text-center">
                                                            <td>{{ $history->household_id }}</td>
                                                            <td>{{ $constituent->constituent_name }}</td>
                                                            <td>{{ $medicine->medicine_name}} {{ $medicine->medicine_no_of_milligrams }}{{ $medicine->medicine_measurement }}</td>
                                                            <td>{{ $history->processed_by }}</td>
                                                            <td>
                                                                @if($history->request_status == 'Rejected')
                                                                    <span class="badge bg-danger">{{ $history->request_status }}</span>
                                                                @elseif($history->request_status == 'Delivered')
                                                                    <span class="badge bg-primary">{{ $history->request_status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewHistoryModal{{ $history->request_history_id }}">
                                                                    View
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRequestModal{{ $history->request_history_id }}">Delete</button>
                                                            </td>
                                                        </tr>
                                                        <!-- #viewHistoryModal{{ $history->request_history_id }} -->
                                                        <div class="modal fade" id="viewHistoryModal{{ $history->request_history_id }}" tabindex="-1" aria-labelledby="viewHistoryModal{{ $history->request_history_id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h5 class="modal-title" id="viewHistoryModal{{ $history->request_history_id }}Label">Request Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="constituentName">Name</label>
                                                                                <input type="text" class="form-control bg-white" id="constituentName" value="{{ $constituent->constituent_name }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="householdID">Household ID</label>
                                                                                <input type="text" class="form-control bg-white" id="householdID" value="{{ $constituent->household_id }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="medicineName">Medicine Name</label>
                                                                                <input type="text" class="form-control bg-white" id="medicineName" value="{{ $medicine->medicine_name }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="medicineDosage">Dosage</label>
                                                                                <input type="text" class="form-control bg-white" id="medicineDosage" value="{{ $medicine->medicine_no_of_milligrams }} {{ $medicine->medicine_measurement }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="medicineCategory">Category</label>
                                                                                <input type="text" class="form-control bg-white" id="medicineCategory" value="{{ $medicine->medicine_category }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="requestQuantity">Quantity</label>
                                                                                <input type="text" class="form-control bg-white" id="requestQuantity" value="{{ $history->quantity_of_request }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="medicineDescription">Description</label>
                                                                        <textarea class="form-control bg-white" id="medicineDescription" rows="3" disabled style="font-weight: 600;">{{ $medicine->medicine_description }}</textarea>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-3 mb-3">
                                                                                <label for="request_status">Request Status</label>
                                                                                <input type="text" class="form-control bg-white" id="request_status" value="{{ $history->request_status }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-3 mb-3">
                                                                                <label for="processed_by">Processed By</label>
                                                                                <input type="text" class="form-control bg-white" id="processed_by" value="{{ $history->processed_by }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer border-0">
                                                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- deleteRequestModal{{ $history->request_history_id }} -->
                                                    <div class="modal fade" id="deleteRequestModal{{ $history->request_history_id }}" tabindex="-1" aria-labelledby="deleteRequestModal{{ $history->request_history_id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h5 class="modal-title" id="deleteRequestModal{{ $history->request_history_id }}Label">Delete Request</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this request history of <strong>{{ $constituent->constituent_name }}</strong> for <strong>{{ $medicine->medicine_name }} ({{ $medicine->medicine_no_of_milligrams }}{{ $medicine->medicine_measurement }})</strong> with quantity of <strong>{{ $history->quantity_of_request }}</strong>?</p>
                                                                </div>
                                                                <div class="modal-footer border-0">
                                                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                                    <form action="{{ route('employee.delete-history', $history->request_history_id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger">Confirm Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-center">
                                        {{ $requestHistory->links() }}
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