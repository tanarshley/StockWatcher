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
        @if(session('requestApproved'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Request Approved',
                    text: '{{ session('requestApproved') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                });
            </script>
        @endif

        @if(session('requestNotApproved'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to Approve Request',
                    text: '{{ session('requestNotApproved') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif

        @if(session('requestRejected'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('requestRejected') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                });
            </script>
        @endif

        @if(session('requestNotRejected'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Failed to Reject Request',
                    text: '{{ session('requestNotRejected') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif
        
        @if(session('requestDelivered'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('requestDelivered') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                });
            </script>
        @endif

        @if(session('requestNotDelivered'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Failed to Deliver Request',
                    text: '{{ session('requestNotDelivered') }}',
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
                    <a href="{{ route('employee.medicine-requests') }}" class="nav_link active"> <i class='bx bx-user-voice nav_icon'></i> <span class="nav_name">Medicine Requests <span class="badge bg-danger">@if($getAllPending->count() != 0) {{ $getAllPending->count() }} @endif</span> </a>
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
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page shows all medicine requests from constituents.</p>
            <div class="summary-card">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Medicine Requests</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $requestsCounts }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Approved Requests</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $getAllApproved->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Pending Requests</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $getAllPending->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-list-expired-medicines mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <div class="row">
                                    <div class="col-9 text-start">
                                        <h5 class="card-title text-white">Medicine Requests</h5>
                                    </div>
                                    <div class="col text-end">
                                        <form action=" {{ route('pdf.medicine-requests') }}" method="GET">
                                            <button type="submit" class="btn btn-sm btn-outline-light">Export to PDF</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if($allMedicineRequests->count() <= 0)
                                <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">No Medicine Requests!</h4>
                                        <p>There are currently no medicine requests from constituents.</p>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-striped" id="expired-medicines-table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Name</th>
                                                <th>Medicine</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allMedicineRequests as $medicineRequest)
                                                @foreach($allMedicineRequestsConstituents as $constituentInfo)
                                                    @foreach($allMedicineRequestsMedicines as $medicineInfo)
                                                        <tr class="text-center">
                                                            <td>{{ $constituentInfo->constituent_name }}</td>
                                                            <td>{{ $medicineInfo->medicine_name }}</td>
                                                            <td>{{ $medicineRequest->quantity_of_request }} Tablets</td>
                                                            <td>{{ $medicineRequest->request_status }}</td>
                                                            <td>
                                                                @if($medicineRequest->request_status == 'Pending')
                                                                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#viewMedicineRequestModal{{ $medicineRequest->medicine_request_id }}">View</button>
                                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approveMedicineRequestModal{{ $medicineRequest->medicine_request_id }}">Approve</button>
                                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectMedicineRequestModal{{ $medicineRequest->medicine_request_id }}">Reject</button>
                                                                @elseif($medicineRequest->request_status == 'Approved')
                                                                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#viewMedicineRequestModal{{ $medicineRequest->medicine_request_id }}">View</button>
                                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deliveredMedicineRequestModal{{ $medicineRequest->medicine_request_id }}">Mark as Delivered</button>
                                                                @elseif($medicineRequest->request_status == 'Rejected')
                                                                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#viewMedicineRequestModal{{ $medicineRequest->medicine_request_id }}">View</button>
                                                                @elseif($medicineRequest->request_status == 'Delivered')
                                                                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#viewMedicineRequestModal{{ $medicineRequest->medicine_request_id }}">View</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <!-- View Medicine Request Modal -->
                                                        <div class="modal fade" id="viewMedicineRequestModal{{ $medicineRequest->medicine_request_id }}" tabindex="-1" aria-labelledby="viewMedicineRequestModalLabel{{ $medicineRequest->medicine_request_id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header border-0">
                                                                        <h5 class="modal-title" id="viewMedicineRequestModalLabel{{ $medicineRequest->medicine_request_id }}">Medicine Request Details</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <h4>Constituent Information</h4>
                                                                                <div class="mb-3">
                                                                                    <label for="constituentName" class="form-label">Name</label>
                                                                                    <input type="text" class="form-control bg-white" id="constituentName" value="{{ $constituentInfo->constituent_name }} ({{ $constituentInfo->household_id }})" disabled>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="constituentAddress" class="form-label">Address</label>
                                                                                    <input type="text" class="form-control bg-white" id="constituentAddress" value="{{ $constituentInfo->constituent_address }}" disabled>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="constituentContactNumber" class="form-label">Contact Number</label>
                                                                                    <input type="text" class="form-control bg-white" id="constituentContactNumber" value="{{ $constituentInfo->constituent_phone }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>Request Information</h4>
                                                                                <div class="mb-3">
                                                                                    <label for="medicineName" class="form-label">Medicine</label>
                                                                                    <input type="text" class="form-control bg-white" id="medicineName" value="{{ $medicineInfo->medicine_name }} ({{ $medicineInfo->medicine_no_of_milligrams }}{{ $medicineInfo->medicine_measurement }})" disabled>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="medicineQuantity" class="form-label">Quantity</label>
                                                                                    <input type="text" class="form-control bg-white" id="medicineQuantity" value="{{ $medicineRequest->quantity_of_request }} Tablets" disabled>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="medicineRequestStatus" class="form-label">Request Status</label>
                                                                                    <input type="text" class="form-control bg-white" id="medicineRequestStatus" value="{{ $medicineRequest->request_status }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approveMedicineRequestModal{{ $medicineRequest->medicine_request_id }}">Approve</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Approve Medicine Request Modal -->
                                                        <div class="modal fade" id="approveMedicineRequestModal{{ $medicineRequest->medicine_request_id }}" tabindex="-1" aria-labelledby="approveMedicineRequestModalLabel{{ $medicineRequest->medicine_request_id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header border-0">
                                                                        <h5 class="modal-title" id="approveMedicineRequestModalLabel{{ $medicineRequest->medicine_request_id }}">Approve Medicine Request</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('employee.approve-medicine-request', $medicineRequest->medicine_request_id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <h5 class="text-center">Are you sure you want to approve this request?</h5>
                                                                            <p class="text-center">You are about to approve the request of <strong>{{ $constituentInfo->constituent_name }}</strong> for <strong>{{ $medicineInfo->medicine_name }} ({{ $medicineInfo->medicine_no_of_milligrams }}{{ $medicineInfo->medicine_measurement }})</strong> with a quantity of <strong>{{ $medicineRequest->quantity_of_request }}</strong> tablets.</p>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Later</button>
                                                                        <button type="submit" class="btn btn-primary btn-sm">Approve Request</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Rejec Medicine Request Modal -->
                                                        <div class="modal fade" id="rejectMedicineRequestModal{{ $medicineRequest->medicine_request_id }}" tabindex="-1" aria-labelledby="rejectMedicineRequestModalLabel{{ $medicineRequest->medicine_request_id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header border-0">
                                                                        <h5 class="modal-title" id="rejectMedicineRequestModalLabel{{ $medicineRequest->medicine_request_id }}">Reject Medicine Request</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('employee.reject-medicine-request', $medicineRequest->medicine_request_id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <h5 class="text-center">Are you sure you want to reject this request?</h5>
                                                                            <p class="text-center">You are about to reject the request of <strong>{{ $constituentInfo->constituent_name }}</strong> for <strong>{{ $medicineInfo->medicine_name }} ({{ $medicineInfo->medicine_no_of_milligrams }}{{ $medicineInfo->medicine_measurement }})</strong> with a quantity of <strong>{{ $medicineRequest->quantity_of_request }}</strong> tablets.</p>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">No</button>
                                                                        <button type="submit" class="btn btn-danger btn-sm">Reject Request</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- markAsDelivered Medicine Request Modal -->
                                                        <div class="modal fade" id="deliveredMedicineRequestModal{{ $medicineRequest->medicine_request_id }}" tabindex="-1" aria-labelledby="deliveredMedicineRequestModal{{ $medicineRequest->medicine_request_id }}Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header border-0">
                                                                        <h5 class="modal-title" id="deliveredMedicineRequestModal{{ $medicineRequest->medicine_request_id }}Label">Mark as Delivered</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('employee.delivered-medicine-request', $medicineRequest->medicine_request_id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <h5 class="text-center">Mark as Delivered?</h5>
                                                                            <p class="text-center">You are about to mark as delivered the request of <strong>{{ $constituentInfo->constituent_name }}</strong> for <strong>{{ $medicineInfo->medicine_name }} ({{ $medicineInfo->medicine_no_of_milligrams }}{{ $medicineInfo->medicine_measurement }})</strong> with a quantity of <strong>{{ $medicineRequest->quantity_of_request }}</strong> tablets.</p>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Later</button>
                                                                        <button type="submit" class="btn btn-primary btn-sm">Mark as Delivered</button>
                                                                    </div>
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
                                        {{ $allMedicineRequests->links() }}
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