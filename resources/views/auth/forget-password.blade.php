@extends('auth.layout')

@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card border-0 shadow-sm p-3 mb-5 bg-white rounded">
                  <div class="card-header bg-transparent border-0" style="font-weight: 500;">Reset Password</div>
                  <div class="card-body">
  
                    @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
  
                      <form action="{{ route('ForgetPasswordPost') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="employee_email" required autofocus>
                                  @if ($errors->has('employee_email'))
                                      <span class="text-danger">{{ $errors->first('employee_email') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary mt-3">
                                  Send Reset Password Link
                              </button>
                          </div>
                            <div class="mt-4 text-center text-muted">
                                <strong>Note:</strong> Please check your email for the reset password link. Only the email address that you used to register in the system will be accepted.
                            </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection