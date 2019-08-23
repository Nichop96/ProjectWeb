@extends('layouts.admin')

@section('title')
Edit group
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <br>
                    <h2 class="text-primary">Edit group</h2>
                    <br>
                    <form id="formModule" class="pt-3" action="{{ route('admin.groups.update', ['group' => $group->id])}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }} 
                        <input type='hidden' name='ids' id='ids' />
                        <div id="form">
                            <div class="form-group">
                                <h5 for='name'>Group name</h5>
                                <br>
                                <input id="name" type="text" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $group->name ?: '' ) }}" name="name" placeholder="{{$group->name}}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <br>
                            </div>
                            <div class='form-group'>
                                <h5 for='description'>Group description</h5>
                                <br>
                                <input id="description" type="text" class="form-control form-control-lg{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description', $group->description ?: '' ) }}" name="description" placeholder="{{$group->description}}">
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                                <br>
                            </div>
                            <h5>Select the users to populate the group:</h5>
                            <br>
                            <div class="row justify-content">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table-responsive" id='table' name='table'>
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-primary">Name</th>
                                                        <th scope="col" class="text-primary">Email</th>  
                                                        <th scope="col" class="text-primary">Role</th>
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
                        <br>
                        <div class='row'>
                            <div class='col'><input type='submit' onclick='validazione()' class='btn btn-outline-primary btn-lg btn-block ' value='Submit'></div>
                            <div class='col'><input type='reset' onclick='resetta()' class='btn btn-outline-warning btn-lg btn-block ' value='Reset'></div>
                            <div class='col'>
                                    <a href="{{route('admin.groups.index')}}">
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
