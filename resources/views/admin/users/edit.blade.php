@extends('layouts.admin')

@section('title')
Edit user
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <h2 class="text-primary">Manage user: {{$user->name}} </h2>
                    <form id="formModule" class="pt-3" action="{{ route('admin.users.update', ['user' => $user->id])}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}

                        <div id="form">
                            <div class="form-group">
                                <br>
                                <h5 for='name'>First name</h5>
                                <br>
                                <input id="name" type="text" maxlength="255" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name ?: '' ) }}" name="name" placeholder="{{$user->name}}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class='form-group'>
                                <h5 for='surname'>Surname</h5>
                                <br>
                                <input id="surname" type="text" maxlength="255" class="form-control form-control-lg {{ $errors->has('surname') ? ' is-invalid' : '' }}" value="{{ old('surname', $user->surname ?: '' ) }}" name="surname" placeholder="{{$user->surname}}" required>
                                @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class='form-group'>
                                <h5 for='username'>Username</h5>
                                <br>
                                <input id="username" type="text" maxlength="255" class="form-control form-control-lg {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username', $user->username ?: '' ) }}" name="username" placeholder="{{$user->username}}" required>
                                @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class='form-group'>
                                <h5 for='email'>E-mail</h5>
                                <br>
                                <input id="email" type="email" maxlength="255" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email ?: '' ) }}" name="email" placeholder="{{$user->email}}" required>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <span id="emailInvalid" class="text-danger"></span>
                            </div>

                                <div class="col">
                                    <div class="form-group">
                                        <h5 for='date'>Birth date</h5>
                                        <br>
                                        <input type='date' class="form-control form-control-lg datepicker {{ $errors->has('birth_date') ? ' is-invalid' : '' }}" id="date_birth" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" required>

                                        <script>
                                            function settadata() {
                                                var dateControl = document.querySelector('input[type="date"]');
                                                var data = '{{$user->birth_date}}';
                                                var res = data.split("-");
                                                var anno = res[0];
                                                var mese = res[1];
                                                var giorno = res[2].split(" ");
                                                var finale = anno + '-' + mese + '-' + giorno[0];

                                                dateControl.value = finale;
                                            }

                                            settadata();

                                            function settaDopo() {
                                                setTimeout(function () {
                                                    settadata();
                                                }, 0);
                                            }
                                        </script>

                                        @if ($errors->has('birth_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birth_date') }}</strong>
                                        </span>
                                        @endif
                                        <span id="dateInvalid" class="text-danger"></span>
                                    </div>
                                </div>
                                


                            <div class='row'>
                                <div class="col"><input type='submit'   class='btn btn-outline-primary btn-lg btn-block mb-3 ' value='Submit'></div>
                                <div class="col"><input type='reset' onclick ='settaDopo()' class='btn btn-outline-warning btn-lg btn-block mb-3' value='Reset'></div>
                                <div class="col">
                                    <a href="{{route('admin.users.index')}}">
                                        <input type='button' onclick="" class='btn btn-outline-danger btn-lg btn-block ' value='Cancel'>
                                    </a>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    function checkDate() {
    $('#dateInvalid').html('');
    var dateControl = new Date($('#date_birth').val());
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
$("#formModule").submit(function (event) {
    
    if (checkDate() & validateEmail()) {
        
        return;
    }
    event.preventDefault();
});
</script>
@endsection

