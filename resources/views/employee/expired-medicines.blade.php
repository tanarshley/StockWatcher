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
    @if(session('expiredMedicineDeleted'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('expiredMedicineDeleted') }}',
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top-end',
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
                    <a href="{{ route('employee.expired-medicines') }}" class="nav_link active" id="expired-medicine"> <i class='bx bx-calendar-x nav_icon'></i> <span class="nav_name">Expired Medicines <span class="badge bg-danger">@if($allExpiredMedicinesToday->count() != 0) {{ $allExpiredMedicinesToday->count() }} @endif</span></span> </a>
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
            <p class="text-muted">This page contains all the expired medicines.</p>
            <div class="summary-card">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary border-0">
                                <h5 class="card-title text-white">Total Expired Medicines</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $allExpiredMedicines->count() }}</p>
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
                                        <h5 class="card-title text-white">Expired Medicines</h5>
                                    </div>
                                    <div class="col text-end">
                                        <form action=" {{ route('pdf.expired-medicines') }}" method="GET">
                                            <button type="submit" class="btn btn-sm btn-outline-light">Export to PDF</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if($allExpiredMedicines->count() <= 0)
                                <div class="card-body">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">No Expired Medicines!</h4>
                                        <p>There are no currently expired medicines in the system. We will notify you when there are expired medicines.</p>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-striped" id="expired-medicines-table">
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
                                            @foreach($allExpiredMedicines as $expiredMedicine)
                                            <tr class="text-center">
                                                <td>{{ $expiredMedicine->medicine_name }}</td>
                                                <td>{{ $expiredMedicine->medicine_category }}</td>
                                                <td>{{ $expiredMedicine->medicine_no_of_milligrams }} {{ $expiredMedicine->medicine_measurement }}</td>
                                                <td>{{ $expiredMedicine->medicine_quantity }}</td>
                                                <td>{{ date('d-m-Y', strtotime($expiredMedicine->medicine_date_of_expiry)) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewExpiredMedicineModal{{ $expiredMedicine->expired_medicine_id }}">View</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteExpiredMedicineModal{{ $expiredMedicine->expired_medicine_id }}">Delete</button>
                                                </td>
                                            </tr>
                                             <!-- viewMedicineModal{{ $expiredMedicine->medicine_id }} -->
                                            <div class="modal fade" id="viewExpiredMedicineModal{{ $expiredMedicine->expired_medicine_id }}" aria-labelledby="viewExpiredMedicineModalLabel{{ $expiredMedicine->expired_medicine_id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="viewExpiredMedicineModalLabel{{ $expiredMedicine->expired_medicine_id}}">Medicine Information <span class="badge bg-danger">Expired</span></h5>
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
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_name') ? ' is-invalid' : '' }}" id="medicine_name" name="medicine_name" value="{{ $expiredMedicine->medicine_name }}" placeholder="Enter Medicine Name" required disabled>
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
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_brand') ? ' is-invalid' : '' }}" id="medicine_brand" name="medicine_brand" value="{{ $expiredMedicine->medicine_brand }}" placeholder="Enter Medicine Brand" required disabled>
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
                                                                                <option value="Tablet" {{ $expiredMedicine->medicine_category == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                                                                <option value="Capsule" {{ $expiredMedicine->medicine_category == 'Capsule' ? 'selected' : '' }}>Capsule</option>
                                                                                <option value="Syrup" {{ $expiredMedicine->medicine_category == 'Syrup' ? 'selected' : '' }}>Syrup</option>
                                                                                <option value="Injection" {{ $expiredMedicine->medicine_category == 'Injection' ? 'selected' : '' }}>Injection</option>
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
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_quantity') ? ' is-invalid' : '' }}" id="medicine_quantity" name="medicine_quantity" value="{{ $expiredMedicine->medicine_quantity }}" placeholder="Enter Medicine Quantity" required disabled>
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
                                                                            <input type="number" class="form-control{{ $errors->has('medicine_no_of_milligrams') ? ' is-invalid' : '' }}" id="medicine_no_of_milligrams" name="medicine_no_of_milligrams" value="{{ $expiredMedicine->medicine_no_of_milligrams }}" placeholder="Enter Dosage" required disabled>
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
                                                                                <option value="mg" {{ $expiredMedicine->medicine_measurement == 'mg' ? 'selected' : '' }}>mg</option>
                                                                                <option value="g" {{ $expiredMedicine->medicine_measurement == 'g' ? 'selected' : '' }}>g</option>
                                                                                <option value="ml" {{ $expiredMedicine->medicine_measurement == 'ml' ? 'selected' : '' }}>ml</option>
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
                                                                            <input type="text" class="form-control{{ $errors->has('medicine_lot_number') ? ' is-invalid' : '' }}" id="medicine_lot_number" name="medicine_lot_number" value="{{ $expiredMedicine->medicine_lot_number }}" placeholder="Enter Lot Number" required disabled>
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
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_manufacture') ? ' is-invalid' : '' }}" id="medicine_date_of_manufacture" name="medicine_date_of_manufacture" value="{{ $expiredMedicine->medicine_date_of_manufacture }}" placeholder="Enter Date of Manufacture" required disabled>
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
                                                                            <input type="date" class="form-control{{ $errors->has('medicine_date_of_expiry') ? ' is-invalid' : '' }}" id="medicine_date_of_expiry" name="medicine_date_of_expiry" value="{{ $expiredMedicine->medicine_date_of_expiry }}" placeholder="Enter Date of Expiry" required disabled>
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
                                                                                <option value="Yes" {{ $expiredMedicine->request_availability == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                <option value="No" {{ $expiredMedicine->request_availability == 'No' ? 'selected' : '' }}>No</option>
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
                                                                            <input class="form-control" type="file" id="medicine_picture" name="medicine_picture" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="medicine_description" class="form-label">Description</label>
                                                                    <textarea class="form-control{{ $errors->has('medicine_description') ? ' is-invalid' : '' }}" id="medicine_description" name="medicine_description" rows="3" placeholder="Enter Description" disabled required>{{ $expiredMedicine->medicine_description }}</textarea>
                                                                    @if ($errors->has('medicine_description'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('medicine_description') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="deleteExpiredMedicineModal{{ $expiredMedicine->expired_medicine_id }}" tabindex="-1" aria-labelledby="deleteExpiredMedicineModal{{ $expiredMedicine->expired_medicine_id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-white border-0">
                                                            <h5 class="modal-title" id="deleteExpiredMedicineModal{{ $expiredMedicine->expired_medicine_id }}Label">Delete Medicine</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('employee.delete-expired-medicine', $expiredMedicine->expired_medicine_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <h4>{{ $expiredMedicine->medicine_name }}</h4>
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
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-center">
                                        {{ $allExpiredMedicines->links() }}
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