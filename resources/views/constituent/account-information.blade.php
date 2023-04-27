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
        @if(session('constituentUpdated'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('constituentUpdated') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                });
            </script>
        @endif

        @if(session('constituentNotUpdated'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Failed to update profile',
                    text: '{{ session('constituentNotUpdated') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif

        @if(session('constituentPasswordUpdated'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('constituentPasswordUpdated') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                });
            </script>
        @endif

        @if(session('constituentPasswordNotUpdated'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Failed to update password',
                    text: '{{ session('constituentPasswordNotUpdated') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif

        @if(session('constituentIncorrectCurrentPassword'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect current password',
                    text: '{{ session('constituentIncorrectCurrentPassword') }}',
                    showConfirmButton: true,
                });
            </script>
        @endif

        @if($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed. Please check your inputs.',
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
                    <a href="{{ route('constituent.request-medicine') }}" class="nav_link"> <i class='bx bx-user-voice nav_icon'></i> <span class="nav_name">Request Medicine</span> </a> 
                    <a href="{{ route('constituent.requests-history') }}" class="nav_link"> <i class='bx bx-history nav_icon'></i> <span class="nav_name">Request History</span> </a>
                    <a href="{{ route('constituent.account-information') }}" class="nav_link"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Account</span> </a> 
                </div>
                </div> <a href="{{ route('constituent.logout') }}" class="nav_link active"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sign Out</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100" style="padding-top: 65px;">
            <h4 style="padding-top: 12px;">{!! $title !!}</h4>
            <p class="text-muted">Manage your account information.</p>
            <div class="card mx-auto border-0 shadow-sm">
                <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="household_id" placeholder="Household ID" value="{{ $LoggedConstituent->household_id }}" readonly>
                                <label for="household_id">Household ID</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="constituent_name" placeholder="Constituent Name" value="{{ $LoggedConstituent->constituent_name }}" readonly>
                                <label for="constituent_name">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="employee_email" placeholder="Employee Email" value="{{ $LoggedConstituent->constituent_email }}" readonly>
                                <label for="employee_email">Email Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="constituent_birthdate" placeholder="Constituent Birthdate" value="{{ $LoggedConstituent->constituent_birthdate }}" readonly>
                                <label for="constituent_birthdate">Birthdate</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="employee_phone" placeholder="Employee Phone" value="{{ $LoggedConstituent->constituent_phone }}" readonly>
                                <label for="employee_phone">Phone Number</label>
                            </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="constituent_address" placeholder="Constituent Address" value="{{ $LoggedConstituent->constituent_address }}" readonly>
                        <label for="constituent_address">Address</label>
                    </div>
                </div>
                <div class="card-footer border-0 bg-white mb-3">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#changePasswordModal{{ $LoggedConstituent->constituent_id }}">Change Password</button>
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#changeInformationModal{{ $LoggedConstituent->constituent_id }}">Change Information</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="changePasswordModal{{ $LoggedConstituent->constituent_id }}" tabindex="-1" aria-labelledby="changePasswordModal{{ $LoggedConstituent->constituent_id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="changePasswordModal{{ $LoggedConstituent->constituent_id }}Label">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('constituent.edit-account-password', $LoggedConstituent->constituent_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control{{ $errors->has('constituent_password') ? ' is-invalid' : '' }}" id="constituent_password" placeholder="Old Password" name="constituent_password">
                                        <label for="constituent_password">Old Password</label>
                                        @if($errors->has('constituent_password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('constituent_password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" id="new_password" placeholder="New Password" name="new_password">
                                        <label for="new_password">New Password</label>
                                        @if($errors->has('new_password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('new_password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation">
                                        <label for="password_confirmation">Confirm Password</label>
                                        @if($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-white">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="changeInformationModal{{ $LoggedConstituent->constituent_id }}" tabindex="-1" aria-labelledby="changeInformationModal{{ $LoggedConstituent->constituent_id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="changeInformationModal{{ $LoggedConstituent->constituent_id }}Label">Change Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('constituent.edit-account-information', $LoggedConstituent->constituent_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control{{ $errors->has('household_id') ? ' is-invalid' : '' }}" id="household_id" value="{{ $LoggedConstituent->household_id }}" name="household_id" disabled>
                                        <label for="household_id">Household ID</label>
                                        @if($errors->has('household_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('household_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control{{ $errors->has('constituent_name') ? ' is-invalid' : '' }}" id="constituent_name" value="{{ $LoggedConstituent->constituent_name }}" name="constituent_name" disabled>
                                        <label for="constituent_name">Full Name</label>
                                        @if($errors->has('constituent_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('constituent_name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control{{ $errors->has('constituent_birthdate') ? ' is-invalid' : '' }}" id="constituent_birthdate" value="{{ $LoggedConstituent->constituent_birthdate }}" name="constituent_birthdate" disabled>
                                        <label for="constituent_birthdate">Birthdate</label>
                                        @if($errors->has('constituent_birthdate'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('constituent_birthdate') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control{{ $errors->has('constituent_phone') ? ' is-invalid' : '' }}" id="constituent_phone" value="{{ $LoggedConstituent->constituent_phone }}" name="constituent_phone" required>
                                        <label for="constituent_phone">Phone Number</label>
                                        @if($errors->has('constituent_phone'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('constituent_phone') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control{{ $errors->has('constituent_email') ? ' is-invalid' : '' }}" id="constituent_email" placeholder="Enter Email Address" value="{{ $LoggedConstituent->constituent_email }}" name="constituent_email" required>
                                        <label for="constituent_email">Email Address</label>
                                        @if($errors->has('constituent_email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('constituent_email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control{{ $errors->has('constituent_address') ? ' is-invalid' : '' }}" id="constituent_address" placeholder="Enter Address" value="{{ $LoggedConstituent->constituent_address }}" name="constituent_address" required>
                                        <label for="constituent_address">Address</label>
                                        @if($errors->has('constituent_address'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('constituent_address') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-white">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--Container Main end-->
        

        <!-- scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>
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