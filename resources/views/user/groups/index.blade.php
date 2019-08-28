@extends('layouts.user')
@section('title')
Groups
@endsection

@section('content')

<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
        <h1 class=" text-primary">{{__('indexes.groups')}}</h1>
        <br>
        <h3 class="mb-md-0">{{__('indexes.manage_g')}}</h3>
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
                    $("#message").delay(4000).slideUp(400);
                </script>
                @endisset
                <div class="table-responsive">
                    <table class="table" id='table'>
                        <thead>
                            <tr>
                                <th scope="col" class="text-primary">{{__('indexes.name')}}</th>  
                                <th scope="col" class="text-primary">{{__('indexes.descr')}}</th> 
                                <th scope="col" class="text-primary">{{__('indexes.numb_u')}}</th>
                                <th scope="col" class="text-primary">{{__('indexes.action')}}</th>   
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->description }}</td>
                                <td>{{ $group->count }} </td>
                                <td>        
                                    @if(!isset($group->hidden) && !$group->hidden)
                                    <form action="{{route('user.groups.destroy', $group->id)}}" id='form-delete{{$group->id}}' method="POST" class="float-left">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="button" onclick='conferma({{$group->id}})' class="btn btn-outline-danger btn-sm">
                                            {{__('indexes.unsign')}}
                                        </button>           
                                    </form> 
                                    @endif
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
<script>
    function conferma(id) {
        if (confirm('Are you sure?')) {
            $('#form-delete'+id).submit();
        }
    }
</script>
@endsection
