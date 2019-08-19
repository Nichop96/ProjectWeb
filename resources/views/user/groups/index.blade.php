@extends('layouts.user')
@section('title')
Groups
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        Manage groups
                        <!--<form action="{{url('user/groups/search')}}" method="POST" >
                            @csrf
                            <input type="text" id="search_key" name="search_key">
                            <button type="submit" class="btn btn-primary btn-sm" > Search    </button>
                        </form>-->
                    </div>                    
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
                    <table class="table">
                        <thead class='thead-light'>
                            <tr>
                                <th scope="col">Name</th>  
                                <th scope="col">Description</th> 
                                <th scope="col">Number of users</th>
                                <!--<th scope="col">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr>
                                <th>{{ $group->name }}</th>
                                <th>{{ $group->description }}</th>
                                <th>{{ $group->count }} </th>
                                <!--<th>                                  
                                    <form action="{{route('user.groups.destroy', $group->id)}}" method="POST" class="float-left">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>           
                                    </form>

                                </th>-->
                            </tr>    
                            @endforeach

                        </tbody>

                    </table>
                    @if(!isset($search))
                    {{ $groups->links() }}
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>
@endsection