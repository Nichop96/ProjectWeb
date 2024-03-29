@extends('layouts.user')

@section('title')
User edit
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card border-primary">
                <div id="card-body" class="card-body">
                    <br>
                    <h2 class="text-primary">{{__('indexes.update_sett')}}</h2>
                    <br>
                    <form id="formModule" class="pt-3" action="{{ route('user.user.update', ['user' => $user->id])}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}

                        <div id="form">
                            <div class="form-group">
                               <br>
                                <h4 for='name'>{{__('indexes.first')}}</h4>
                                 <br>
                                <input id="name" type="text" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name ?: '' ) }}" name="name" placeholder="{{$user->name}}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class='form-group'>
                                <br>
                                <h4 for='surname'>{{__('indexes.sur')}}</h4>
                                 <br>
                                <input id="surname" type="text" class="form-control form-control-lg {{ $errors->has('surname') ? ' is-invalid' : '' }}" value="{{ old('surname', $user->surname ?: '' ) }}" name="surname" placeholder="{{$user->surname}}" required>
                                @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class='form-group'>
                                <br>
                                <h4 for='username'>{{__('indexes.usern')}}</h4>
                                 <br>
                                <input id="username" type="text" class="form-control form-control-lg {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username', $user->username ?: '' ) }}" name="username" placeholder="{{$user->username}}" required>
                                @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class='form-group'>
                                <br>
                                <h4 for='email'>E-mail</h4>
                                 <br>
                                <input id="email" type="email" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email ?: '' ) }}" name="email" placeholder="{{$user->email}}" required>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <span id="emailInvalid" class="text-danger"></span>
                            </div>
                            <div class='form-group'>
                                <div class="card-body">
                                    <div class="row">
                                        <label class="form-check-label">    
                                            <input  id="keep" type="radio" class="form-check-input" name="changePassword" value="keep" required checked><p>{{__('indexes.keep')}}</p>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <label class="form-check-label">    
                                            <input id="change" type="radio" class="form-check-input" name="changePassword" value="change" required><p>{{__('indexes.change')}}</p>   
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="password" style="display: none;">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>                                
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <br>
                                        <h4 for='date'>{{__('indexes.bday')}}</h4>
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
                            </div>

                            <div class='row'>
                                <div class='col'><input type='submit'   class='btn btn-outline-primary btn-lg btn-block mb-3 ' value='{{__("indexes.submit")}}'></div>
                                <div class='col'><input type='reset' onclick ='settaDopo()' class='btn btn-outline-warning btn-lg btn-block mb-3 ' value='Reset'></div>
                                <div class='col'>
                                    <a href="{{route('user.index')}}">
                                        <input type='button' onclick="" class='btn btn-outline-danger btn-lg btn-block ' value='{{__("indexes.cancel")}}'>
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
    $(function () {
        $("#keep").click(function () {
            $("#password").hide();
        });

        $("#change").click(function () {
            $("#password").show();
        });
    });
    
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

