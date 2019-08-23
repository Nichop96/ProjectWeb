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
                                <input id="name" type="text" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name ?: '' ) }}" name="name" placeholder="{{$user->name}}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class='form-group'>
                                <h5 for='surname'>Surname</h5>
                                <br>
                                <input id="surname" type="text" class="form-control form-control-lg {{ $errors->has('surname') ? ' is-invalid' : '' }}" value="{{ old('surname', $user->surname ?: '' ) }}" name="surname" placeholder="{{$user->surname}}">
                                @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class='form-group'>
                                <h5 for='username'>Username</h5>
                                <br>
                                <input id="username" type="text" class="form-control form-control-lg {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username', $user->username ?: '' ) }}" name="username" placeholder="{{$user->username}}">
                                @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class='form-group'>
                                <h5 for='email'>E-mail</h5>
                                <br>
                                <input id="email" type="text" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email ?: '' ) }}" name="email" placeholder="{{$user->email}}">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                                <div class="col">
                                    <div class="form-group">
                                        <h5 for='date'>Birth date</h5>
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
                                <div class="col">
                                    <div class="form-check">
                                        <div class="row">
                                            <h5 for='roles'>Roles</h5>
                                            <legend class="col-form-label col-sm-2 pt-0"></legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    @foreach($roles as $role)
                                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->hasAnyRole($role->name)? 'checked':'' }}>
                                                    <label>{{ $role->name }}</label>
                                                    <br>
                                                    @endforeach

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <div class='row'>
                                <div class="col"><input type='submit'   class='btn btn-outline-primary btn-lg btn-block ' value='Submit'></div>
                                <div class="col"><input type='reset' onclick ='settaDopo()' class='btn btn-outline-warning btn-lg btn-block ' value='Reset'></div>
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
@endsection

