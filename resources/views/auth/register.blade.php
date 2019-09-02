<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ORC Register</title>
        <link rel="shortcut icon" href="{{asset('public-part/img/logos/logo_transparent.png')}}">
        <!-- plugins:css -->
        <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../../css/style.css">
        <!-- endinject -->
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <div class="brand-logo">
                                    <center> 
                                        <a href="{{route('index')}}">
                                            <img src="../public-part/img/logos/logo_transparent.png" alt="logo">
                                        </a>
                                    </center>
                                </div>
                                <form method="POST" id="myform" action="{{ route('register') }}">
                                    @csrf

                                    <h4>{{__('register.new')}}</h4>
                                    <h6 class="font-weight-light">{{__('register.sign_up')}}</h6>
                                    <form class="pt-3" action="{{ route('register') }}" method="POST">
                                        @csrf 
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="name" placeholder="{{__('register.name')}}" required>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg{{ $errors->has('surname') ? ' is-invalid' : '' }}" value="{{ old('surname') }}" name="surname"  placeholder="{{__('register.surname')}}" required>
                                            @if ($errors->has('surname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('surname') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="{{__('register.email')}}" placeholder="Email" required>
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                            <span >
                                                <strong id="emailInvalid" class="text-danger"></strong>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <input id="bday" type="date" class="form-control form-control-lg{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" value="{{ old('birth_date') }}" name="birth_date" required>
                                            @if ($errors->has('birth_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </span>
                                            @endif
                                            <span >
                                                <strong id="dateInvalid" class="text-danger"></strong>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="{{__('register.username')}}" required>
                                            @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" placeholder="{{__('register.password')}}" required>
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="{{__('register.confirm_pass')}}" required>
                                            @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <!--<div class="mb-4">
                                            <div class="form-check">
                                                <label class="form-check-label text-muted">
                                                    <input type="checkbox" class="form-check-input">
                                                    I agree to all Terms & Conditions
                                                </label>
                                            </div>
                                        </div>-->

                                        <div class="form-group">

                                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                                {{__('register.sign')}}
                                            </button>

                                        </div>

                                        <div class="text-center mt-4 font-weight-light">
                                            {{__('register.already')}}<a href="{{asset('login')}}" class="text-primary">Login</a>
                                        </div>

                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../../vendors/base/vendor.bundle.base.js"></script>
            <!-- endinject -->
            <!-- inject:js -->
            <script src="../../js/off-canvas.js"></script>
            <script src="../../js/hoverable-collapse.js"></script>
            <script src="../../js/template.js"></script>
            <!-- endinject -->
    </body>

</html>

<script>
function checkDate() {
    $('#dateInvalid').html('');
    var dateControl = new Date($('#bday').val());
    var data = new Date();
    var currentYear = data.getFullYear();
    var year = dateControl.getFullYear();

    if ((currentYear - year) < 15) {
        $('#dateInvalid').html('You have to be 15 or more.');
    }
    return ((currentYear - year) >= 15);
}
 function validateEmail() {
     $('#emailInvalid').html('');
    var email=$('#email').val();
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( email ) ) {
        $('#emailInvalid').html('Email format is incorrect');
        return false;
    } else {
        return true;
    }
}
$("#myform").submit(function (event) {
    
    if (checkDate() & validateEmail()) {
        
        return;
    }
    event.preventDefault();
     
});


</script>