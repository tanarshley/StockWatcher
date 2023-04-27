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
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>

    <body id="body-pd">
        @if(session('medicineRequestCancelled'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('medicineRequestCancelled') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                });
            </script>
        @endif
        
        @if(session('medicineRequestNotCancelled'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('medicineRequestNotCancelled') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                });
            </script>
        @endif

        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header-text"> Hi, {{ $LoggedConstituent->constituent_name }} </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="{{ route('constituent.requests') }}" class="nav_logo"> <img src="{{ asset('StockWatcher-icon.png') }}" style="width: auto; height: 60px; margin-left: -44px; margin-right: -32px;"> <span class="nav_logo-name">StockWatcher</span> </a>
                        <div class="nav_list"> <a href="{{ route('constituent.requests') }}" class="nav_link"> <i class='bx bx-capsule nav_icon'></i> <span class="nav_name">Requests</span> 
                    </a> 
                    <a href="{{ route('constituent.request-medicine') }}" class="nav_link"> <i class='bx bx-user-voice nav_icon'></i> <span class="nav_name">Request Medicine</span> </a> 
                    <a href="{{ route('constituent.requests-history') }}" class="nav_link active"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Request History</span> </a>
                    <a href="{{ route('constituent.account-information') }}" class="nav_link"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Account</span> </a> 
                </div>
                </div> <a href="{{ route('constituent.logout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign Out</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100" style="padding-top: 65px;">
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page contains your requests.</p>

            <div class="table-list-expired-medicines mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Your Requests</h5>
                            </div>
                            @if($requestHistory->count() <= 0)
                                <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">You have no requests!</h4>
                                        <p>It seems like you have not requested any medicine yet. Click on the button below to request a medicine.</p>
                                        <a href="{{ route('constituent.request-medicine') }}" class="btn btn-sm btn-primary">Request Medicine</a>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-striped" id="expired-medicines-table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Medicine Name</th>
                                                <th>Quantity</th>
                                                <th>Requested at</th>
                                                <th>Request Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($requestHistory as $request)
                                                @foreach($requestMedicineInfo as $medicineInfo)
                                                    <tr class="text-center">
                                                        <td>{{ $medicineInfo->medicine_name }}</td>
                                                        <td>{{ $request->quantity_of_request }}</td>
                                                        <td>{{ date('d M Y', strtotime($request->created_at)) }}</td>
                                                        <td>
                                                            @if($request->request_status == 'Delivered')
                                                                <span class="badge bg-primary">{{ $request->request_status }}</span>
                                                            @elseif($request->request_status == 'Cancelled')
                                                                <span class="badge bg-danger">{{ $request->request_status }}</span>
                                                            @elseif($request->request_status == 'Rejected')
                                                                <span class="badge bg-danger">{{ $request->request_status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewRequest{{ $request->medicine_request_id }}">View</button>
                                                        </td>
                                                    </tr>
                                                    <!-- viewRequest{{ $request->medicine_request_id }} -->
                                                    <div class="modal fade" id="viewRequest{{ $request->medicine_request_id }}" tabindex="-1" aria-labelledby="viewRequest{{ $request->medicine_request_id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h5 class="modal-title" id="viewRequest{{ $request->medicine_request_id }}Label">Request Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="medicineName">Medicine Name</label>
                                                                                <input type="text" class="form-control bg-white" id="medicineName" value="{{ $medicineInfo->medicine_name }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="medicineDosage">Dosage</label>
                                                                                <input type="text" class="form-control bg-white" id="medicineDosage" value="{{ $medicineInfo->medicine_no_of_milligrams }} {{ $medicineInfo->medicine_measurement }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="medicineCategory">Category</label>
                                                                                <input type="text" class="form-control bg-white" id="medicineCategory" value="{{ $medicineInfo->medicine_category }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group mb-3">
                                                                                <label for="requestQuantity">Quantity</label>
                                                                                <input type="text" class="form-control bg-white" id="requestQuantity" value="{{ $request->quantity_of_request }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="medicineDescription">Description</label>
                                                                        <textarea class="form-control bg-white" id="medicineDescription" rows="3" disabled style="font-weight: 600;">{{ $medicineInfo->medicine_description }}</textarea>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-3 mb-3">
                                                                                <label for="created_at">Requested at</label>
                                                                                <input type="text" class="form-control bg-white" id="created_at" value="{{ date('d M Y', strtotime($request->created_at)) }}" disabled style="font-weight: 600;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-3 mb-3">
                                                                                <label for="request_status">Request Status</label>
                                                                                <input type="text" class="form-control bg-white" id="request_status" value="{{ $request->request_status }}" disabled style="font-weight: 600;">
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
                                                    <!-- cancelRequest{{ $request->medicine_request_id }} -->
                                                    <div class="modal fade" id="cancelRequest{{ $request->medicine_request_id }}" tabindex="-1" aria-labelledby="cancelRequest{{ $request->medicine_request_id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h5 class="modal-title" id="cancelRequest{{ $request->medicine_request_id }}Label">Cancel Request</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('constituent.medicine-request-cancel', $request->medicine_request_id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <h4 class="text-center">Are you sure you want to cancel this request?</h4>
                                                                </div>
                                                                <div class="modal-footer border-0">
                                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-sm btn-danger">Cancel Request</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
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