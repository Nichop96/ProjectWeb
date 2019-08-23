@extends('layouts.user')
@section('title')
Groups
@endsection

@section('content')

<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
         <h1 class=" text-primary">Groups</h1>
        <br>
        <h3 class="mb-md-0">Manage your groups: </h3>
        <br>
            <div class="card border-primary mb-3">
                    <div class="float-left">
                        <!--<form action="{{url('user/groups/search')}}" method="POST" >
                            @csrf
                            <input type="text" id="search_key" name="search_key">
                            <button type="submit" class="btn btn-primary btn-sm" > Search    </button>
                        </form>-->
                    </div>                    
                <div class="card-body">
                    @isset ($message)                       
                        @if($message=='delete')
                            <div class="container-fluid" id="message">
                                <div class="alert alert-success" role="alert">
                                   Group deleted successfully!
                                </div>
                            </div>
                        @endif                         
                        <script>
                            $( "#message" ).delay(4000 ).slideUp( 400 );
                        </script>
                    @endisset
                    <div class="table-responsive">
                        <table class="table" id='table'>
                        <thead>
                            <tr>
                                <th scope="col" class="text-primary">Name</th>  
                                <th scope="col" class="text-primary">Description</th> 
                                <th scope="col" class="text-primary">Number of users</th>
                                <th scope="col" class="text-primary">Actions</th>   
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->description }}</td>
                                <td>{{ $group->count }} </td>
                                <td>                                  
                                    <form action="{{route('user.groups.destroy', $group->id)}}" method="POST" class="float-left">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            Delete
                                        </button>           
                                    </form>

                                </td>
                            </tr>    
                            @endforeach

                        </tbody>

                    </table>
                    </div>
                    @if(!isset($search))
                    {{ $groups->links() }}
                    @endif
                </div>
            </div>


    </div>

</div>
<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
@endsection
