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
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>

    <body id="body-pd">
        @if(session('medicineRequested'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Medicine Requested Successfully!',
                    text: 'Please wait for the approval.',
                    showConfirmButton: true,
                });
            </script>
        @endif

        @if(session('medicineNotRequested'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Medicine Request Failed!',
                    text: 'Please try again.',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif

        @if(session('requestLimitExceeded'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Request Limit Exceeded!',
                    text: '{{ session('requestLimitExceeded') }}',
                    showConfirmButton: true,
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
                    <a href="{{ route('constituent.request-medicine') }}" class="nav_link active"> <i class='bx bx-user-voice nav_icon'></i> <span class="nav_name">Request Medicine</span> </a> 
                    <a href="{{ route('constituent.requests-history') }}" class="nav_link"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Request History</span> </a>
                    <a href="{{ route('constituent.account-information') }}" class="nav_link"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Account</span> </a> 
                </div>
                </div> <a href="{{ route('constituent.logout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign Out</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100" style="padding-top: 65px;">
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">Shows all medicines that are available for request in the Health Center.</p>

            <div class="table-list-expired-medicines mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                            <div class="row">
                            <div class="col text-start">
                                <h5 class="card-title text-light">Lists of Available Medicines</h5>
                            </div>
                            <div class="col text-end">
                                <span class="text-white">Request Limit: {{ $LoggedConstituent->request_limit }}</span> &nbsp;
                                <!--<button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#requestDifferentMedicineModal">Request Other Medicine</button>-->
                            </div>
                        </div>
                            </div>
                            @if($allMedicines->count() <= 0)
                                <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">No Medicine Available!</h4>
                                        <p>It seems like there are no medicines available for request in the Health Center. Please try again later.</p>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-striped" id="expired-medicines-table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Medicine Name</th>
                                                <th>Dosage</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allMedicines as $medicines)
                                            <tr class="text-center">
                                                <td>{{ $medicines->medicine_name }}</td>
                                                <td>{{ $medicines->medicine_no_of_milligrams }} {{ $medicines->medicine_measurement }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#viewMedicineModal{{ $medicines->medicine_id }}">View</button>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestMedicineModal{{ $medicines->medicine_id }}">Request</button>
                                                </td>
                                            </tr>
                                            <!-- viewMedicineModal{{ $medicines->medicine_id }} -->
                                            <div class="modal fade" id="viewMedicineModal{{ $medicines->medicine_id }}" tabindex="-1" aria-labelledby="viewMedicineModal{{ $medicines->medicine_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="viewMedicineModal{{ $medicines->medicine_id }}Label">Medicine Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="medicineName">Medicine Name</label>
                                                                <input type="text" class="form-control bg-white" id="medicineName" value="{{ $medicines->medicine_name }}" disabled style="font-weight: 600;">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="medicineDosage">Dosage</label>
                                                                    <input type="text" class="form-control bg-white" id="medicineDosage" value="{{ $medicines->medicine_no_of_milligrams }} {{ $medicines->medicine_measurement }}" disabled style="font-weight: 600;">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="medicineCategory">Category</label>
                                                                <input type="text" class="form-control bg-white" id="medicineCategory" value="{{ $medicines->medicine_category }}" disabled style="font-weight: 600;">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="medicineDescription">Description</label>
                                                                <textarea class="form-control bg-white" id="medicineDescription" rows="3" disabled style="font-weight: 600;">{{ $medicines->medicine_description }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#requestMedicineModal{{ $medicines->medicine_id }}">Request this medicine</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="requestMedicineModal{{ $medicines->medicine_id }}" tabindex="-1" aria-labelledby="requestMedicineModal{{ $medicines->medicine_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="requestMedicineModal{{ $medicines->medicine_id }}Label">Requesting Medicine</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('constituent.request-medicine-post', $LoggedConstituent->constituent_id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="household_id" value="{{ $LoggedConstituent->household_id }}">
                                                                <input type="hidden" name="medicine_id" value="{{ $medicines->medicine_id }}">
                                                                <p class="">You are about to request <strong>{{ $medicines->medicine_name }}</strong> with dosage of <strong>{{ $medicines->medicine_no_of_milligrams }} {{ $medicines->medicine_measurement }}</strong> from <strong>{{ $medicines->medicine_category }}</strong> category.</p>
                                                                <p>Note that this is a request and not a purchase. The medicine you will request is free.</p>
                                                                <div class="form-group mb-3">
                                                                    <label for="medicineQuantity">Request Quantity</label>
                                                                    <select class="form-select" id="medicineQuantity" name="quantity_of_request" required>
                                                                        <option value="10">10 Tablets</option>
                                                                        <option value="20">20 Tablets</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer border-0">
                                                                    <button type="submit" class="btn btn-sm btn-primary">Confirm Request</button>
                                                                </div>
                                                            </form>
                                                        <div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- requestDifferentMedicineModal -->
            <div class="modal fade" id="requestDifferentMedicineModal" tabindex="-1" aria-labelledby="requestDifferentMedicineModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="requestDifferentMedicineModalLabel">Requesting Medicine</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('constituent.request-medicine-post', $LoggedConstituent->constituent_id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="household_id" value="{{ $LoggedConstituent->household_id }}">
                                <div class="form-group">
                                    <label for="medicineName">Upload Prescription</label>
                                    <input type="file" class="form-control" id="medicineName" name="prescription" required>
                                </div>
                            </div>
                                <div class="modal-footer border-0">
                                    <button type="submit" class="btn btn-sm btn-primary">Confirm Request</button>
                                </div>
                            </form>
                        <div>
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