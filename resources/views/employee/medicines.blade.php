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
        @if(session('medicineAdded'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('medicineAdded') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif
        
        @if(session('medicineNotAdded'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('medicineNotAdded') }}',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif

        @if(session('medicineReleased'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('medicineReleased') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('medicineNotReleased'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('medicineNotReleased') }}',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif

        @if(session('medicineDeleted'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('medicineDeleted') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('medicineNotDeleted'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('medicineNotDeleted') }}',
                    showConfirmButton: false,
                    timer: 2000,
                });
            </script>
        @endif

        @if(session('medicineUpdated'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('medicineUpdated') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                });
            </script>
        @endif

        @if(session('medicineNotUpdated'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('medicineNotUpdated') }}',
                    showConfirmButton: false,
                    timer: 2000,
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
                    <a href="{{ route('employee.medicines') }}" class="nav_link active"> <i class='bx bx-capsule nav_icon'></i> <span class="nav_name">Medicines</span> </a> 
                    <a href="{{ route('employee.expired-medicines') }}" class="nav_link" id="expired-medicine"> <i class='bx bx-calendar-x nav_icon'></i> <span class="nav_name">Expired Medicines <span class="badge bg-danger">@if($expiredToday->count() != 0) {{ $expiredToday->count() }} @endif</span></span> </a>
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
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">This page contains all the medicines and upcoming expiry medicines.</p>
            <div class="summary-card">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Medicines</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allMedicineCounts }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Upcoming Expiry Medicines</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $UpcomingExpiringMedicines->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add search bar for medicines -->
            <form action="{{ route('employee.medicines.search') }}" method="GET">
                <label for="exampleDataList" class="form-label">Search for a medicine</label>
                <input class="form-control" list="datalistOptions" id="exampleDataList" name="search_medicine" placeholder="Type to search...">
                <button type="submit" name="search" class="btn btn-sm btn-primary mt-2">Search</button>
            </form>

            <!-- show tables where search results will be displayed -->
            @if(isset($searchedMedicines))
                <div class="medicines-table-list mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-primary border-0">
                                    <div class="row">
                                        <div class="col text-start">
                                            <h5 class="card-title text-white">Medicines</h5>
                                        </div>
                                        <div class="col text-end">
                                            <a href="{{ route('employee.medicines') }}" class="btn btn-sm btn-outline-light">Back</a>
                                            <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addMedicineModal">Add Medicine</button>
                                        </div>
                                    </div>
                                </div>
                                @if($searchedMedicines->count() <= 0)
                                    <div class="card-body">
                                        <p class="card-text">No medicines found.</p>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Dosage</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Expiry Date</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($searchedMedicines as $medicine)
                                                    <tr class="text-center">
                                                        <td>{{ $medicine->medicine_name }}</td>
                                                        <td>{{ $medicine->medicine_category }}</td>
                                                        <td>{{ $medicine->medicine_no_of_milligrams }} {{ $medicine->medicine_measurement }}</td>
                                                        <td>{{ $medicine->medicine_quantity }}</td>
                                                        @if($medicine->medicine_date_of_expiry <= date('Y-m-d', strtotime('+7 days')))
                                                        <td> <span class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="right" title="This medicine is about to expire soon." style="font-size: 14px;">{{ date('d-m-Y', strtotime($medicine->medicine_date_of_expiry)) }} </span></td>
                                                        @else
                                                            <td>{{ date('d-m-Y', strtotime($medicine->medicine_date_of_expiry)) }}</td>
                                                        @endif
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#releaseMedicineModal{{ $medicine->medicine_id }}">Release</button>
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewMedicineModal{{ $medicine->medicine_id }}">View</button>
                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMedicineModal{{ $medicine->medicine_id }}">Delete</button>
                                                        </td>
                                                    </tr>
                                                
                                            <div class="modal fade" id="releaseMedicineModal{{ $medicine->medicine_id }}" tabindex="-1" aria-labelledby="releaseMedicineModal{{ $medicine->medicine_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="releaseMedicineModal{{ $medicine->medicine_id }}Label">Releasing Medicine</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('employee.release-medicine', $medicine->medicine_id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="medicine_id" value="{{ $medicine->medicine_id }}">
                                                                <input type="hidden" name="employee_id" value="{{ $LoggedEmployee->employee_id }}">
                                                                <p class="">You are about to release <strong>{{ $medicine->medicine_name }}</strong> with dosage of <strong>{{ $medicine->medicine_no_of_milligrams }} {{ $medicine->medicine_measurement }}</strong> from <strong>{{ $medicine->medicine_category }}</strong> category.</p>
                                                                <p>Note that this release will be recorded in the system and cannot be undone.</p>
                                                                <div class="form-group mb-3">
                                                                    <label for="medicineQuantity">Release Quantity</label>
                                                                    <input type="number" class="form-control" id="medicineQuantity" name="release_quantity" placeholder="Enter quantity to release" required>
                                                                    <span class="text-muted">Quantity available: {{ $medicine->medicine_quantity }}</span>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer border-0">
                                                                    <button type="submit" class="btn btn-sm btn-primary">Confirm Release</button>
                                                                </div>
                                                            </form>
                                                        <div>
                                                    </div>
                                                </div>
                                            </div>
                                                </div>
                                                <div class="modal fade" id="deleteMedicineModal{{ $medicine->medicine_id }}" tabindex="-1" aria-labelledby="deleteMedicineModal{{ $medicine->medicine_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-white border-0">
                                                            <h5 class="modal-title" id="deleteMedicineModal{{ $medicine->medicine_id }}Label">Delete Medicine</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('employee.delete-medicine', $medicine->medicine_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <h4>{{ $medicine->medicine_name }}</h4>
                                                                <p>Are you sure you want to delete this medicine?</p>
                                                            </div>
                                                            <div class="modal-footer bg-white border-0">
                                                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-sm btn-danger">Delete Medicine</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="viewMedicineModal{{ $medicine->medicine_id }}" aria-labelledby="viewMedicineModalLabel{{ $medicine->medicine_id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="viewMedicineModalLabel{{ $medicine->medicine_id}}">Medicine Information</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_name" class="form-label">Medicine Name</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_name') ? ' is-invalid' : '' }}" id="medicine_name" name="medicine_name" value="{{ $medicine->medicine_name }}" placeholder="Enter Medicine Name" required disabled>
                                                                            @if ($errors->has('medicine_name'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_name') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_brand" class="form-label">Medicine Brand</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_brand') ? ' is-invalid' : '' }}" id="medicine_brand" name="medicine_brand" value="{{ $medicine->medicine_brand }}" placeholder="Enter Medicine Brand" required disabled>
                                                                            @if ($errors->has('medicine_brand'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_brand') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_category" class="form-label">Medicine Category</label>
                                                                            <select class="form-select{{ $errors->has('medicine_category') ? ' is-invalid' : '' }}" id="medicine_category" name="medicine_category" required disabled>
                                                                                <option value="Tablet" {{ $medicine->medicine_category == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                                                                <option value="Capsule" {{ $medicine->medicine_category == 'Capsule' ? 'selected' : '' }}>Capsule</option>
                                                                                <option value="Syrup" {{ $medicine->medicine_category == 'Syrup' ? 'selected' : '' }}>Syrup</option>
                                                                                <option value="Injection" {{ $medicine->medicine_category == 'Injection' ? 'selected' : '' }}>Injection</option>
                                                                            </select>
                                                                            @if ($errors->has('medicine_category'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_category') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_quantity" class="form-label">Medicine Quantity</label>
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_quantity') ? ' is-invalid' : '' }}" id="medicine_quantity" name="medicine_quantity" value="{{ $medicine->medicine_quantity }}" placeholder="Enter Medicine Quantity" required disabled>
                                                                            @if ($errors->has('medicine_quantity'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_quantity') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_no_of_milligrams" class="form-label">Dosage</label>
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_no_of_milligrams') ? ' is-invalid' : '' }}" id="medicine_no_of_milligrams" name="medicine_no_of_milligrams" value="{{ $medicine->medicine_no_of_milligrams }}" placeholder="Enter Dosage" required disabled>
                                                                            @if ($errors->has('medicine_no_of_milligrams'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_no_of_milligrams') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_measurement" class="form-label">Measurement</label>
                                                                            <select class="form-select{{ $errors->has('medicine_measurement') ? ' is-invalid' : '' }}" id="medicine_measurement" name="medicine_measurement" required disabled>
                                                                                <option value="mg" {{ $medicine->medicine_measurement == 'mg' ? 'selected' : '' }}>mg</option>
                                                                                <option value="g" {{ $medicine->medicine_measurement == 'g' ? 'selected' : '' }}>g</option>
                                                                                <option value="ml" {{ $medicine->medicine_measurement == 'ml' ? 'selected' : '' }}>ml</option>
                                                                            </select>
                                                                            @if ($errors->has('medicine_measurement'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_measurement') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_lot_number" class="form-label">Lot Number</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_lot_number') ? ' is-invalid' : '' }}" id="medicine_lot_number" name="medicine_lot_number" value="{{ $medicine->medicine_lot_number }}" placeholder="Enter Lot Number" required disabled>
                                                                            @if ($errors->has('medicine_lot_number'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_lot_number') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_date_of_manufacture" class="form-label">Date of Manufacture</label>
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_manufacture') ? ' is-invalid' : '' }}" id="medicine_date_of_manufacture" name="medicine_date_of_manufacture" value="{{ $medicine->medicine_date_of_manufacture }}" placeholder="Enter Date of Manufacture" required disabled>
                                                                            @if ($errors->has('medicine_date_of_manufacture'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_date_of_manufacture') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_date_of_expiry" class="form-label">Date of Expiry</label>
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_expiry') ? ' is-invalid' : '' }}" id="medicine_date_of_expiry" name="medicine_date_of_expiry" value="{{ $medicine->medicine_date_of_expiry }}" placeholder="Enter Date of Expiry" required disabled>
                                                                            @if ($errors->has('medicine_date_of_expiry'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_date_of_expiry') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="request_availability" class="form-label">Request Availability</label>
                                                                            <select class="form-select{{ $errors->has('request_availability') ? ' is-invalid' : '' }}" id="request_availability" name="request_availability" required disabled>
                                                                                <option value="Yes" {{ $medicine->request_availability == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                <option value="No" {{ $medicine->request_availability == 'No' ? 'selected' : '' }}>No</option>
                                                                            </select>
                                                                            @if ($errors->has('request_availability'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('request_availability') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_picture" class="form-label">Picture</label>
                                                                            <input class="form-control" type="file" id="medicine_picture" name="medicine_picture" accept="image/*" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="medicine_description" class="form-label">Description</label>
                                                                    <textarea class="form-control{{ $errors->has('medicine_description') ? ' is-invalid' : '' }}" id="medicine_description" name="medicine_description" rows="3" placeholder="Enter Description" disabled required>{{ $medicine->medicine_description }}</textarea>
                                                                    @if ($errors->has('medicine_description'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('medicine_description') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </form>
                                                            <div class="button-group float-end mb-3">
                                                                <!-- disable button if LoggedEmployee->employee_role == 'Admin' -->
                                                                @if ($LoggedEmployee->employee_role == 'Admin')
                                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-target="#editMedicineModal{{ $medicine->medicine_id }}" data-bs-toggle="modal">Edit Medicine Information</button>
                                                                @else
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-target="#editMedicineModal{{ $medicine->medicine_id }}" data-bs-toggle="modal" disabled>Edit Medicine Information</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- editMedicineModal{{ $medicine->medicine_id }} -->
                                            <div class="modal fade" id="editMedicineModal{{ $medicine->medicine_id }}" aria-labelledby="editMedicineModalLabel{{ $medicine->medicine_id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="editMedicineModalLabel{{ $medicine->medicine_id}}">Medicine Information</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('employee.edit-medicine', $medicine->medicine_id) }}" id="myForm" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_name" class="form-label">Medicine Name</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_name') ? ' is-invalid' : '' }}" id="medicine_name" name="medicine_name" value="{{ $medicine->medicine_name }}" placeholder="Enter Medicine Name" required>
                                                                            @if ($errors->has('medicine_name'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_name') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_brand" class="form-label">Medicine Brand</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_brand') ? ' is-invalid' : '' }}" id="medicine_brand" name="medicine_brand" value="{{ $medicine->medicine_brand }}" placeholder="Enter Medicine Brand" required>
                                                                            @if ($errors->has('medicine_brand'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_brand') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_category" class="form-label">Medicine Category</label>
                                                                            <select class="form-select{{ $errors->has('medicine_category') ? ' is-invalid' : '' }}" id="medicine_category" name="medicine_category" required>
                                                                                <option value="Tablet" {{ $medicine->medicine_category == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                                                                <option value="Capsule" {{ $medicine->medicine_category == 'Capsule' ? 'selected' : '' }}>Capsule</option>
                                                                                <option value="Syrup" {{ $medicine->medicine_category == 'Syrup' ? 'selected' : '' }}>Syrup</option>
                                                                                <option value="Injection" {{ $medicine->medicine_category == 'Injection' ? 'selected' : '' }}>Injection</option>
                                                                            </select>
                                                                            @if ($errors->has('medicine_category'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_category') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_quantity" class="form-label">Medicine Quantity</label>
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_quantity') ? ' is-invalid' : '' }}" id="medicine_quantity" name="medicine_quantity" value="{{ $medicine->medicine_quantity }}" placeholder="Enter Medicine Quantity" required>
                                                                            @if ($errors->has('medicine_quantity'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_quantity') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_no_of_milligrams" class="form-label">Dosage</label>
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_no_of_milligrams') ? ' is-invalid' : '' }}" id="medicine_no_of_milligrams" name="medicine_no_of_milligrams" value="{{ $medicine->medicine_no_of_milligrams }}" placeholder="Enter Dosage" required>
                                                                            @if ($errors->has('medicine_no_of_milligrams'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_no_of_milligrams') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_measurement" class="form-label">Measurement</label>
                                                                            <select class="form-select{{ $errors->has('medicine_measurement') ? ' is-invalid' : '' }}" id="medicine_measurement" name="medicine_measurement" required>
                                                                                <option value="mg" {{ $medicine->medicine_measurement == 'mg' ? 'selected' : '' }}>mg</option>
                                                                                <option value="g" {{ $medicine->medicine_measurement == 'g' ? 'selected' : '' }}>g</option>
                                                                                <option value="ml" {{ $medicine->medicine_measurement == 'ml' ? 'selected' : '' }}>ml</option>
                                                                            </select>
                                                                            @if ($errors->has('medicine_measurement'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_measurement') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_lot_number" class="form-label">Lot Number</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_lot_number') ? ' is-invalid' : '' }}" id="medicine_lot_number" name="medicine_lot_number" value="{{ $medicine->medicine_lot_number }}" placeholder="Enter Lot Number" required>
                                                                            @if ($errors->has('medicine_lot_number'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_lot_number') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_date_of_manufacture" class="form-label">Date of Manufacture</label>
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_manufacture') ? ' is-invalid' : '' }}" id="medicine_date_of_manufacture" name="medicine_date_of_manufacture" value="{{ $medicine->medicine_date_of_manufacture }}" placeholder="Enter Date of Manufacture" required>
                                                                            @if ($errors->has('medicine_date_of_manufacture'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_date_of_manufacture') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_date_of_expiry" class="form-label">Date of Expiry</label>
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_expiry') ? ' is-invalid' : '' }}" id="medicine_date_of_expiry" name="medicine_date_of_expiry" value="{{ $medicine->medicine_date_of_expiry }}" placeholder="Enter Date of Expiry" required>
                                                                            @if ($errors->has('medicine_date_of_expiry'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_date_of_expiry') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="request_availability" class="form-label">Request Availability</label>
                                                                            <select class="form-select{{ $errors->has('request_availability') ? ' is-invalid' : '' }}" id="request_availability" name="request_availability" required>
                                                                                <option value="Yes" {{ $medicine->request_availability == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                <option value="No" {{ $medicine->request_availability == 'No' ? 'selected' : '' }}>No</option>
                                                                            </select>
                                                                            @if ($errors->has('request_availability'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('request_availability') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_picture" class="form-label">Picture</label>
                                                                            <input class="form-control" type="file" id="medicine_picture" name="medicine_picture" accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="medicine_description" class="form-label">Description</label>
                                                                    <textarea class="form-control{{ $errors->has('medicine_description') ? ' is-invalid' : '' }}" id="medicine_description" name="medicine_description" rows="3" placeholder="Enter Description" required>{{ $medicine->medicine_description }}</textarea>
                                                                    @if ($errors->has('medicine_description'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('medicine_description') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            <div class="modal-footer bg-white border-0">
                                                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-sm btn-primary">Update Medicine</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row justify-content-center">
                                            {{ $searchedMedicines->links() }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="medicines-table-list mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <div class="row">
                                    <div class="col-9 text-start">
                                        <h5 class="card-title text-white">Medicines</h5>
                                    </div>
                                    <div class="col text-end">
                                        <form action=" {{ route('pdf.medicines') }}" method="GET">
                                            <button type="submit" class="btn btn-sm btn-outline-light">Export to PDF</button>
                                        </form>
                                    </div>
                                    <div class="col text-start">
                                        <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addMedicineModal">Add Medicine</button>
                                    </div>
                                </div>
                            </div>
                            @if($allMedicines->count() <= 0)
                                <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">No Medicines Found!</h4>
                                        <p>There are no medicines in the system. Please add some medicines to view them here.</p>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-striped" id="medicines-table">
                                        <thead> 
                                            <tr class="text-center">
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Dosage</th>
                                                <th>Quantity</th>
                                                <th>Expiry Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allMedicines as $medicine)
                                            <tr class="text-center">
                                                <td>{{ $medicine->medicine_name }}</td>
                                                <td>{{ $medicine->medicine_category }}</td>
                                                <td>{{ $medicine->medicine_no_of_milligrams }} {{ $medicine->medicine_measurement }}</td>
                                                <td>{{ $medicine->medicine_quantity }}</td>
                                                <!-- check if medicine_date_of_expiry is near expiry date 7 days a head -->
                                                @if($medicine->medicine_date_of_expiry <= date('Y-m-d', strtotime('+7 days')))
                                                 <td> <span class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="right" title="This medicine is about to expire soon." style="font-size: 14px;">{{ date('d-m-Y', strtotime($medicine->medicine_date_of_expiry)) }} </span></td>
                                                @else
                                                    <td>{{ date('d-m-Y', strtotime($medicine->medicine_date_of_expiry)) }}</td>
                                                @endif
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#releaseMedicineModal{{ $medicine->medicine_id }}">Release</button>
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewMedicineModal{{ $medicine->medicine_id }}">View</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMedicineModal{{ $medicine->medicine_id }}">Delete</button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="releaseMedicineModal{{ $medicine->medicine_id }}" tabindex="-1" aria-labelledby="releaseMedicineModal{{ $medicine->medicine_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="releaseMedicineModal{{ $medicine->medicine_id }}Label">Releasing Medicine</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('employee.release-medicine', $medicine->medicine_id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="medicine_id" value="{{ $medicine->medicine_id }}">
                                                                <input type="hidden" name="employee_id" value="{{ $LoggedEmployee->employee_id }}">
                                                                <p class="">You are about to release <strong>{{ $medicine->medicine_name }}</strong> with dosage of <strong>{{ $medicine->medicine_no_of_milligrams }} {{ $medicine->medicine_measurement }}</strong> from <strong>{{ $medicine->medicine_category }}</strong> category.</p>
                                                                <p>Note that this release will be recorded in the system and cannot be undone.</p>
                                                                <div class="form-group mb-3">
                                                                    <label for="medicineQuantity">Release Quantity</label>
                                                                    <input type="number" class="form-control" id="medicineQuantity" name="release_quantity" placeholder="Enter quantity to release" required>
                                                                    <span class="text-muted">Quantity available: {{ $medicine->medicine_quantity }}</span>
                                                                </div>
                                                            </div>
                                                                <div class="modal-footer border-0">
                                                                    <button type="submit" class="btn btn-sm btn-primary">Confirm Release</button>
                                                                </div>
                                                            </form>
                                                        <div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="modal fade" id="deleteMedicineModal{{ $medicine->medicine_id }}" tabindex="-1" aria-labelledby="deleteMedicineModal{{ $medicine->medicine_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-white border-0">
                                                            <h5 class="modal-title" id="deleteMedicineModal{{ $medicine->medicine_id }}Label">Delete Medicine</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('employee.delete-medicine', $medicine->medicine_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <h4>{{ $medicine->medicine_name }}</h4>
                                                                <p>Are you sure you want to delete this medicine?</p>
                                                            </div>
                                                            <div class="modal-footer bg-white border-0">
                                                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-sm btn-danger">Delete Medicine</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- viewMedicineModal{{ $medicine->medicine_id }} -->
                                            <div class="modal fade" id="viewMedicineModal{{ $medicine->medicine_id }}" aria-labelledby="viewMedicineModalLabel{{ $medicine->medicine_id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="viewMedicineModalLabel{{ $medicine->medicine_id}}">Medicine Information</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_name" class="form-label">Medicine Name</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_name') ? ' is-invalid' : '' }}" id="medicine_name" name="medicine_name" value="{{ $medicine->medicine_name }}" placeholder="Enter Medicine Name" required disabled>
                                                                            @if ($errors->has('medicine_name'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_name') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_brand" class="form-label">Medicine Brand</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_brand') ? ' is-invalid' : '' }}" id="medicine_brand" name="medicine_brand" value="{{ $medicine->medicine_brand }}" placeholder="Enter Medicine Brand" required disabled>
                                                                            @if ($errors->has('medicine_brand'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_brand') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_category" class="form-label">Medicine Category</label>
                                                                            <select class="form-select{{ $errors->has('medicine_category') ? ' is-invalid' : '' }}" id="medicine_category" name="medicine_category" required disabled>
                                                                                <option value="Tablet" {{ $medicine->medicine_category == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                                                                <option value="Capsule" {{ $medicine->medicine_category == 'Capsule' ? 'selected' : '' }}>Capsule</option>
                                                                                <option value="Syrup" {{ $medicine->medicine_category == 'Syrup' ? 'selected' : '' }}>Syrup</option>
                                                                                <option value="Injection" {{ $medicine->medicine_category == 'Injection' ? 'selected' : '' }}>Injection</option>
                                                                            </select>
                                                                            @if ($errors->has('medicine_category'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_category') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_quantity" class="form-label">Medicine Quantity</label>
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_quantity') ? ' is-invalid' : '' }}" id="medicine_quantity" name="medicine_quantity" value="{{ $medicine->medicine_quantity }}" placeholder="Enter Medicine Quantity" required disabled>
                                                                            @if ($errors->has('medicine_quantity'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_quantity') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_no_of_milligrams" class="form-label">Dosage</label>
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_no_of_milligrams') ? ' is-invalid' : '' }}" id="medicine_no_of_milligrams" name="medicine_no_of_milligrams" value="{{ $medicine->medicine_no_of_milligrams }}" placeholder="Enter Dosage" required disabled>
                                                                            @if ($errors->has('medicine_no_of_milligrams'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_no_of_milligrams') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_measurement" class="form-label">Measurement</label>
                                                                            <select class="form-select{{ $errors->has('medicine_measurement') ? ' is-invalid' : '' }}" id="medicine_measurement" name="medicine_measurement" required disabled>
                                                                                <option value="mg" {{ $medicine->medicine_measurement == 'mg' ? 'selected' : '' }}>mg</option>
                                                                                <option value="g" {{ $medicine->medicine_measurement == 'g' ? 'selected' : '' }}>g</option>
                                                                                <option value="ml" {{ $medicine->medicine_measurement == 'ml' ? 'selected' : '' }}>ml</option>
                                                                            </select>
                                                                            @if ($errors->has('medicine_measurement'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_measurement') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_lot_number" class="form-label">Lot Number</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_lot_number') ? ' is-invalid' : '' }}" id="medicine_lot_number" name="medicine_lot_number" value="{{ $medicine->medicine_lot_number }}" placeholder="Enter Lot Number" required disabled>
                                                                            @if ($errors->has('medicine_lot_number'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_lot_number') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_date_of_manufacture" class="form-label">Date of Manufacture</label>
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_manufacture') ? ' is-invalid' : '' }}" id="medicine_date_of_manufacture" name="medicine_date_of_manufacture" value="{{ $medicine->medicine_date_of_manufacture }}" placeholder="Enter Date of Manufacture" required disabled>
                                                                            @if ($errors->has('medicine_date_of_manufacture'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_date_of_manufacture') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_date_of_expiry" class="form-label">Date of Expiry</label>
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_expiry') ? ' is-invalid' : '' }}" id="medicine_date_of_expiry" name="medicine_date_of_expiry" value="{{ $medicine->medicine_date_of_expiry }}" placeholder="Enter Date of Expiry" required disabled>
                                                                            @if ($errors->has('medicine_date_of_expiry'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_date_of_expiry') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="request_availability" class="form-label">Request Availability</label>
                                                                            <select class="form-select{{ $errors->has('request_availability') ? ' is-invalid' : '' }}" id="request_availability" name="request_availability" required disabled>
                                                                                <option value="Yes" {{ $medicine->request_availability == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                <option value="No" {{ $medicine->request_availability == 'No' ? 'selected' : '' }}>No</option>
                                                                            </select>
                                                                            @if ($errors->has('request_availability'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('request_availability') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_picture" class="form-label">Picture</label>
                                                                            <input class="form-control" type="file" id="medicine_picture" name="medicine_picture" accept="image/*" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="medicine_description" class="form-label">Description</label>
                                                                    <textarea class="form-control{{ $errors->has('medicine_description') ? ' is-invalid' : '' }}" id="medicine_description" name="medicine_description" rows="3" placeholder="Enter Description" disabled required>{{ $medicine->medicine_description }}</textarea>
                                                                    @if ($errors->has('medicine_description'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('medicine_description') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </form>
                                                            <div class="button-group float-end mb-3">
                                                                @if ($LoggedEmployee->employee_role == 'Admin')
                                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-target="#editMedicineModal{{ $medicine->medicine_id }}" data-bs-toggle="modal">Edit Medicine Information</button>
                                                                @else
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-target="#editMedicineModal{{ $medicine->medicine_id }}" data-bs-toggle="modal" disabled>Edit Medicine Information</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- editMedicineModal{{ $medicine->medicine_id }} -->
                                            <div class="modal fade" id="editMedicineModal{{ $medicine->medicine_id }}" aria-labelledby="editMedicineModalLabel{{ $medicine->medicine_id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="editMedicineModalLabel{{ $medicine->medicine_id}}">Medicine Information</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('employee.edit-medicine', $medicine->medicine_id) }}" id="myForm" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_name" class="form-label">Medicine Name</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_name') ? ' is-invalid' : '' }}" id="medicine_name" name="medicine_name" value="{{ $medicine->medicine_name }}" placeholder="Enter Medicine Name" required>
                                                                            @if ($errors->has('medicine_name'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_name') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_brand" class="form-label">Medicine Brand</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_brand') ? ' is-invalid' : '' }}" id="medicine_brand" name="medicine_brand" value="{{ $medicine->medicine_brand }}" placeholder="Enter Medicine Brand" required>
                                                                            @if ($errors->has('medicine_brand'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_brand') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_category" class="form-label">Medicine Category</label>
                                                                            <select class="form-select{{ $errors->has('medicine_category') ? ' is-invalid' : '' }}" id="medicine_category" name="medicine_category" required>
                                                                                <option value="Tablet" {{ $medicine->medicine_category == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                                                                <option value="Capsule" {{ $medicine->medicine_category == 'Capsule' ? 'selected' : '' }}>Capsule</option>
                                                                                <option value="Syrup" {{ $medicine->medicine_category == 'Syrup' ? 'selected' : '' }}>Syrup</option>
                                                                                <option value="Injection" {{ $medicine->medicine_category == 'Injection' ? 'selected' : '' }}>Injection</option>
                                                                            </select>
                                                                            @if ($errors->has('medicine_category'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_category') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_quantity" class="form-label">Medicine Quantity</label>
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_quantity') ? ' is-invalid' : '' }}" id="medicine_quantity" name="medicine_quantity" value="{{ $medicine->medicine_quantity }}" placeholder="Enter Medicine Quantity" required>
                                                                            @if ($errors->has('medicine_quantity'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_quantity') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_no_of_milligrams" class="form-label">Dosage</label>
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_no_of_milligrams') ? ' is-invalid' : '' }}" id="medicine_no_of_milligrams" name="medicine_no_of_milligrams" value="{{ $medicine->medicine_no_of_milligrams }}" placeholder="Enter Dosage" required>
                                                                            @if ($errors->has('medicine_no_of_milligrams'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_no_of_milligrams') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_measurement" class="form-label">Measurement</label>
                                                                            <select class="form-select{{ $errors->has('medicine_measurement') ? ' is-invalid' : '' }}" id="medicine_measurement" name="medicine_measurement" required>
                                                                                <option value="mg" {{ $medicine->medicine_measurement == 'mg' ? 'selected' : '' }}>mg</option>
                                                                                <option value="g" {{ $medicine->medicine_measurement == 'g' ? 'selected' : '' }}>g</option>
                                                                                <option value="ml" {{ $medicine->medicine_measurement == 'ml' ? 'selected' : '' }}>ml</option>
                                                                            </select>
                                                                            @if ($errors->has('medicine_measurement'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_measurement') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_lot_number" class="form-label">Lot Number</label>
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_lot_number') ? ' is-invalid' : '' }}" id="medicine_lot_number" name="medicine_lot_number" value="{{ $medicine->medicine_lot_number }}" placeholder="Enter Lot Number" required>
                                                                            @if ($errors->has('medicine_lot_number'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_lot_number') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_date_of_manufacture" class="form-label">Date of Manufacture</label>
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_manufacture') ? ' is-invalid' : '' }}" id="medicine_date_of_manufacture" name="medicine_date_of_manufacture" value="{{ $medicine->medicine_date_of_manufacture }}" placeholder="Enter Date of Manufacture" required>
                                                                            @if ($errors->has('medicine_date_of_manufacture'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_date_of_manufacture') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_date_of_expiry" class="form-label">Date of Expiry</label>
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_expiry') ? ' is-invalid' : '' }}" id="medicine_date_of_expiry" name="medicine_date_of_expiry" value="{{ $medicine->medicine_date_of_expiry }}" placeholder="Enter Date of Expiry" required>
                                                                            @if ($errors->has('medicine_date_of_expiry'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('medicine_date_of_expiry') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="request_availability" class="form-label">Request Availability</label>
                                                                            <select class="form-select{{ $errors->has('request_availability') ? ' is-invalid' : '' }}" id="request_availability" name="request_availability" required>
                                                                                <option value="Yes" {{ $medicine->request_availability == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                <option value="No" {{ $medicine->request_availability == 'No' ? 'selected' : '' }}>No</option>
                                                                            </select>
                                                                            @if ($errors->has('request_availability'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('request_availability') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="medicine_picture" class="form-label">Picture</label>
                                                                            <input class="form-control" type="file" id="medicine_picture" name="medicine_picture" accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="medicine_description" class="form-label">Description</label>
                                                                    <textarea class="form-control{{ $errors->has('medicine_description') ? ' is-invalid' : '' }}" id="medicine_description" name="medicine_description" rows="3" placeholder="Enter Description" required>{{ $medicine->medicine_description }}</textarea>
                                                                    @if ($errors->has('medicine_description'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('medicine_description') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            <div class="modal-footer bg-white border-0">
                                                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-sm btn-primary">Update Medicine</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-center">
                                        {{ $allMedicines->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- addMedicineModal -->
        <div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="addMedicineModalLabel">Add Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employee.add-medicine') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_name" class="form-label">Medicine Name</label>
                                        <input type="text" class="form-control{{ $errors->has('medicine_name') ? ' is-invalid' : '' }}" id="medicine_name" name="medicine_name" value="{{ old('medicine_name') }}" placeholder="Enter Medicine Name" required>
                                        @if ($errors->has('medicine_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_brand" class="form-label">Medicine Brand</label>
                                        <input type="text" class="form-control{{ $errors->has('medicine_brand') ? ' is-invalid' : '' }}" id="medicine_brand" name="medicine_brand" value="{{ old('medicine_brand') }}" placeholder="Enter Medicine Brand" required>
                                        @if ($errors->has('medicine_brand'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_brand') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_category" class="form-label">Medicine Category</label>
                                        <select class="form-select{{ $errors->has('medicine_category') ? ' is-invalid' : '' }}" id="medicine_category" name="medicine_category" required>
                                            <option value="Tablet">Tablet</option>
                                            <option value="Capsule">Capsule</option>
                                            <option value="Syrup">Syrup</option>
                                        </select>
                                        @if ($errors->has('medicine_category'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_category') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_quantity" class="form-label">Medicine Quantity</label>
                                        <input type="number" class="form-control{{ $errors->has('medicine_quantity') ? ' is-invalid' : '' }}" id="medicine_quantity" name="medicine_quantity" value="{{ old('medicine_quantity') }}" placeholder="Enter Medicine Quantity" required>
                                        @if ($errors->has('medicine_quantity'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_quantity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_no_of_milligrams" class="form-label">Dosage</label>
                                        <input type="number" class="form-control{{ $errors->has('medicine_no_of_milligrams') ? ' is-invalid' : '' }}" id="medicine_no_of_milligrams" name="medicine_no_of_milligrams" value="{{ old('medicine_no_of_milligrams') }}" placeholder="Enter Dosage" required>
                                        @if ($errors->has('medicine_no_of_milligrams'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_no_of_milligrams') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_measurement" class="form-label">Measurement</label>
                                        <select class="form-select{{ $errors->has('medicine_measurement') ? ' is-invalid' : '' }}" id="medicine_measurement" name="medicine_measurement" required>
                                            <option value="mg">mg</option>
                                            <option value="g">g</option>
                                            <option value="ml">ml</option>
                                        </select>
                                        @if ($errors->has('medicine_measurement'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_measurement') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_lot_number" class="form-label">Lot Number</label>
                                        <input type="number" class="form-control{{ $errors->has('medicine_lot_number') ? ' is-invalid' : '' }}" id="medicine_lot_number" name="medicine_lot_number" value="{{ old('medicine_lot_number') }}" placeholder="Enter Lot Number" required>
                                        @if ($errors->has('medicine_lot_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_lot_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_date_of_manufacture" class="form-label">Date of Manufacture</label>
                                        <input type="date" class="form-control{{ $errors->has('medicine_date_of_manufacture') ? ' is-invalid' : '' }}" id="medicine_date_of_manufacture" name="medicine_date_of_manufacture" value="{{ old('medicine_date_of_manufacture') }}" placeholder="Enter Date of Manufacture" required>
                                        @if ($errors->has('medicine_date_of_manufacture'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_date_of_manufacture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_date_of_expiry" class="form-label">Date of Expiry</label>
                                        <input type="date" class="form-control{{ $errors->has('medicine_date_of_expiry') ? ' is-invalid' : '' }}" id="medicine_date_of_expiry" name="medicine_date_of_expiry" value="{{ old('medicine_date_of_expiry') }}" placeholder="Enter Date of Expiry" required>
                                        @if ($errors->has('medicine_date_of_expiry'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_date_of_expiry') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="request_availability" class="form-label">Request Availability</label>
                                        <select class="form-select{{ $errors->has('request_availability') ? ' is-invalid' : '' }}" id="request_availability" name="request_availability" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        @if ($errors->has('request_availability'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('request_availability') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="medicine_picture" class="form-label">Picture</label>
                                        <input class="form-control{{ $errors->has('medicine_picture') ? ' is-invalid' : '' }}" type="file" id="medicine_picture" name="medicine_picture" accept="image/*">
                                        @if ($errors->has('medicine_picture'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medicine_picture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="medicine_description" class="form-label">Description</label>
                                <textarea class="form-control{{ $errors->has('medicine_description') ? ' is-invalid' : '' }}" id="medicine_description" name="medicine_description" rows="3" placeholder="Enter Description" required>{{ old('medicine_description') }}</textarea>
                                @if ($errors->has('medicine_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('medicine_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer bg-white border-0">
                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Add Medicine</button>
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