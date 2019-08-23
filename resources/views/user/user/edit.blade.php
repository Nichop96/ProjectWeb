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
                    <h2 class="text-primary">Update settings</h2>
                    <br>
                    <form id="formModule" class="pt-3" action="{{ route('user.user.update', ['user' => $user->id])}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}

                        <div id="form">
                            <div class="form-group">
                               <br>
                                <h4 for='name'>First name</h4>
                                 <br>
                                <input id="name" type="text" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name ?: '' ) }}" name="name" placeholder="{{$user->name}}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class='form-group'>
                                <br>
                                <h4 for='surname'>Surname</h4>
                                 <br>
                                <input id="surname" type="text" class="form-control form-control-lg {{ $errors->has('surname') ? ' is-invalid' : '' }}" value="{{ old('surname', $user->surname ?: '' ) }}" name="surname" placeholder="{{$user->surname}}">
                                @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class='form-group'>
                                <br>
                                <h4 for='username'>Username</h4>
                                 <br>
                                <input id="username" type="text" class="form-control form-control-lg {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username', $user->username ?: '' ) }}" name="username" placeholder="{{$user->username}}">
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
                                <input id="email" type="text" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email ?: '' ) }}" name="email" placeholder="{{$user->email}}">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class='form-group'>
                                <div class="card-body">
                                    <div class="row">
                                        <label class="form-check-label">    
                                            <input  id="keep" type="radio" class="form-check-input" name="changePassword" value="keep" required checked><p>Keep old password</p>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <label class="form-check-label">    
                                            <input id="change" type="radio" class="form-check-input" name="changePassword" value="change" required><p>Change password</p>   
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
                                        <h4 for='date'>Birth date</h4>
                                         <br>
                                        <input type='date' class="form-control form-control-lg datepicker {{ $errors->has('birth_date') ? ' is-invalid' : '' }}" id="date_birth" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" >

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
                                    </div>
                                </div>                                
                            </div>

                            <div class='row'>
                                <div class='col'><input type='submit'   class='btn btn-outline-primary btn-lg btn-block ' value='Submit'></div>
                                <div class='col'><input type='reset' onclick ='settaDopo()' class='btn btn-outline-warning btn-lg btn-block ' value='Reset'></div>
                                <div class='col'>
                                    <a href="{{route('user.index')}}">
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
    $(function () {
        $("#keep").click(function () {
            $("#password").hide();
        });

        $("#change").click(function () {
            $("#password").show();
        });
    });
</script>
@endsection

