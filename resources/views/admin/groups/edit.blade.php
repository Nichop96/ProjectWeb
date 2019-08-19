@extends('layouts.admin')

@section('title')
Group edit
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <h4 class="card-title">Edit of a group</h4>
                    <form id="formModule" class="pt-3" action="{{ route('admin.groups.update', ['group' => $group->id])}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }} 
                        <input type='hidden' name='ids' id='ids' />
                        <div id="form">
                            <div class="form-group">
                                <label for='name'>Group name</label>
                                <input id="name" type="text" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $group->name ?: '' ) }}" name="name" placeholder="{{$group->name}}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <br>
                            </div>
                            <div class='form-group'>
                                <label for='description'>Group description</label>
                                <input id="description" type="text" class="form-control form-control-lg{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description', $group->description ?: '' ) }}" name="description" placeholder="{{$group->description}}">
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                                <br>
                            </div>

                            <div class="row justify-content">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Chose the users to populate the group:</h4>
                                            
                                        </div>

                                        <div class="card-body">
                                            <table class="table" id='table' name='table'>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>  
                                                        <th scope="col">Role</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($userlist as $user)
                                                        <tr onclick="selezionato({{$user->id}})" id='{{$user->id}}'>
                                                            <th>{{ $user->name }}</th>
                                                            <th>{{ $user->email }}</th>
                                                            <th>{{ implode(', ',$user->roles()->get()->pluck('name')->toArray()) }}</th>
                                                        </tr>
                                                        @foreach($selectedUsers as $selected)
                                                            @if($user->id == $selected->id  )
                                                                <script>
                                                                    selezionato({{$user-> id}});
                                                                </script>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if(!isset($search))
                                                {{ $userlist->links() }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'><input type='submit' onclick='validazione()' class='btn btn-primary btn-lg btn-block ' value='Invia modifiche'></div>
                            <div class='col'><input type='reset' onclick='resetta()' class='btn btn-primary btn-lg btn-block ' value='Resetta campi'></div>
                            <div class='col'>
                                    <a href="{{route('admin.groups.index')}}">
                                        <input type='button' onclick="" class='btn btn-primary btn-lg btn-block ' value='Cancel'>
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
<script>
    function selezionato(id){
        var element = document.getElementById(id).classList.toggle("bg-success");
    }

    function resetta(){
    var table = document.getElementById("table");
    var r = 0;
    while (row = table.rows[r++]){u
    row.classList.remove("bg-success");
    }
    }
    function validazione(){
    var tmp = [];
    var table = document.getElementById("table");
    var users = document.getElementById("ids");
    var r = 0;
    while (row = table.rows[r++]){
    if (row.classList.contains("bg-success")){
    tmp.push(row.id);
    }
    }

    users.value = tmp;
    }
</script>