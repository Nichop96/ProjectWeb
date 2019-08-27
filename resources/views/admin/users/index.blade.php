@extends('layouts.admin')

@section('title')
Users
@endsection

@section('content')
<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5 ">
        <div>
            <h1 class="text-primary">Users</h1>
            <br>
            <h3 class="mb-md-0">Manage users: </h3>
            <br>
        </div>
        <div class="card border-primary">
            <div class="card-header">
                <div class="float-left">

                    <form action="{{route('admin.users.search')}}" method="POST">
                        @csrf
                        <input type="text" id="search_key" name="search_key">
                        <button type="submit" class="btn btn-primary btn-sm" >Search</button>
                    </form>

                </div>
            </div>
                                       
                @isset ($message)
                    @if($message == 'ok_delete')
                            <div class="container-fluid" id="message">
                                <div class="alert alert-success" role="alert">
                                   User deleted successfully!
                                </div>
                            </div>
                    @endif
                    @if($message == 'no_ok_delete')
                            <div class="container-fluid" id="message">
                                <div class="alert alert-danger" role="alert">
                                   User can not be deleted!
                                </div>
                            </div>
                    @endif
                    
                         @if($message=='update')
                            <div class="container-fluid" id="message">
                                <div class="alert alert-success" role="alert">
                                   User updated successfully!
                                </div>
                            </div>
                        @endif
                        <script>
                            $( "#message" ).delay(4000).slideUp( 400 );
                        </script>
                    @endisset
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id='table'>
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-primary">Name</th>
                                        <th scope="col" class="text-primary">Email</th>  
                                        <th scope="col" class="text-primary">Role</th> 
                                        <th scope="col" class="text-primary">Actions</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ implode(', ',$user->roles()->get()->pluck('name')->toArray()) }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                                <button type="button" class="btn btn-outline-primary btn-sm mr-2 ml-5">Edit</button>
                                            </a>
                                            <a href="{{ route('admin.impersonate', $user->id) }}" class="float-left">
                                                <button type="button" class="btn btn-outline-success btn-sm mr-2">
                                                    Impersonate
                                                </button>
                                            </a>
                                            <form action="{{route('admin.users.destroy', $user->id)}}" id='form-delete' method="POST" class="float-left">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="button" onclick='conferma()' class="btn btn-outline-danger btn-sm">
                                                    Delete
                                                </button>           
                                            </form>
                                            <!-- 
                                                        tengo qui? -->
                                                    <script>
                                                         function conferma(){
                                                             if(confirm('Are you sure?')){
                                                                 $('#form-delete').submit();
                                                            }
                                                        }
                                                       
                                                    </script>
                                        </td>
                                    </tr>    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                   @if(!isset($search))
                    {{ $users->links() }}
                   @endif
                    </div>
        </div>
    </div>
</div>

<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
@endsection
