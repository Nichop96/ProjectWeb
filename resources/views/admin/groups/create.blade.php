@extends('layouts.admin')

@section('title')
Create group
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <h2 class="text-primary">Create group</h2>                    
                    <form id="formModule" class="pt-3" action="{{ route('admin.groups.store') }}" method="POST">
                        @csrf 
                        <input type='hidden' name='ids' id='ids' />
                        <div id="form">
                            <div class="form-group">
                                <h5 for='name'>Group name</h5>
                                <br>
                                <input id="name" type="text" maxlength="255" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="name" placeholder="Group name" required>
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
                                <input id="description" type="text" maxlength="255" class="form-control form-control-lg{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description') }}" name="description" placeholder="Group's description" required>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                                <br>
                            </div>


                            <div class="row justify-content">
                                <div class="col-md-12">
                                    <div class="card border-primary">
                                        <div class="card-header">
                                            <br>
                                            <h5>Chose the users to populate the group:</h5>
                                        </div>

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table" id='table' name='table'>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-primary">Name</th>
                                                            <th class="text-primary">Email</th>  
                                                            <th class="text-primary">Role</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($userlist as $user)
                                                        <tr onclick="selezionato({{$user->id}})" id='{{$user->id}}'>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ implode(', ',$user->roles()->get()->pluck('name')->toArray()) }}</td>

                                                        </tr>    
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class='row'>
                            <div class='col'><input type='submit' onclick='validazione()' class='btn btn-outline-primary btn-lg btn-block mb-3' value="Submit"></div>
                            <div class='col'><input type='reset' onclick='resetta()' class='btn btn-outline-warning btn-lg btn-block mb-3' value="Reset"></div>
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
<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>


<script>
    function selezionato(id){
    var element = document.getElementById(id).classList.toggle("bg-primary");
    }
    
    function resetta(){
        var table = document.getElementById("table");
        var r=0;
        while(row=table.rows[r++]){
            row.classList.remove("bg-primary");
        }
    }
    function validazione(){
        var tmp = [];
        var table = document.getElementById("table");
        var users = document.getElementById("ids");
        var r=0;
        while(row=table.rows[r++]){
            if(row.classList.contains("bg-primary")){
                tmp.push(row.id);
            }
        }
        
        users.value = tmp;
    }
</script>
@endsection