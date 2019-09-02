@extends('layouts.admin')
@section('title')
Groups
@endsection

@section('content')
<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5 ">
        <div>
            <h1 class="text-primary">Groups</h1>
            <br>
            <h3 class="mb-md-0">Manage groups: </h3>
            <br>
        </div>
        <div class="card align-content-center border-primary mb-3">
            <div class="card-header">
                <div class="float-left">
                    <form action="{{route('admin.groups.search')}}" method="POST" >
                        @csrf
                        <input type="text" id="search_key" name="search_key">
                        <button type="submit" class="btn btn-primary btn-sm" > Search    </button>
                    </form>
                </div>
                <a href="{{ route('admin.groups.create') }}" class="float-right">
                    <button type="button" class="btn btn-primary btn-sm">Add group</button>
                </a>
            </div>
            <div class="card-body">
                @isset ($message)
                @if($message=='insert')
                <div class="container-fluid" id="message">
                    <div class="alert alert-success" role="alert">
                        Group creation finished successfully!
                    </div>
                </div>
                @endif
                @if($message=='delete')
                <div class="container-fluid" id="message">
                    <div class="alert alert-success" role="alert">
                        Group deleted successfully!
                    </div>
                </div>
                @endif
                @if($message=='update')
                <div class="container-fluid" id="message">
                    <div class="alert alert-success" role="alert">
                        Group updated successfully!
                    </div>
                </div>
                @endif
                <script>
                    $("#message").delay(4000).slideUp(400);
                </script>
                @endisset
                <div class="row">
                    <div class="col-md-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="recent_surveys" class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-primary">Name</th>  
                                                <th class="text-primary">Description</th> 
                                                <th class="text-primary">Number of users</th>
                                                <th class="text-primary">Actions</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($groups as $group)
                                            <tr>
                                                <td>{{ $group->name }}</td>
                                                <td>{{ $group->description }}</td>
                                                <td>{{ $group->count }} </td>
                                                <td>
                                                    <a href="{{route('admin.groups.edit', $group->id)}}" class="float-left">
                                                        <button type="button" class="btn btn-outline-primary btn-sm mr-2 ml-4">Edit</button>
                                                    </a>

                                                    <form action="{{route('admin.groups.destroy', $group->id)}}" id='form-delete{{$group->id}}' method="POST" class="float-left">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <button type="button" onclick="conferma({{$group->id}})" class="btn btn-outline-danger btn-sm">
                                                            Delete
                                                        </button>           
                                                    </form>
                                                 
                                                </td>
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
            </div>
        </div>
    </div>
</div> 
<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script>
    function conferma(id) {
        if (confirm('Are you sure?')) {
            $('#form-delete'+id).submit();
        }
    }
</script>
@endsection

