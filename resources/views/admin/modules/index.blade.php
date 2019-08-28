@extends('layouts.admin')

@section('title')
Modules
@endsection

@section('content')
<!-- partial -->

<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
        <h1 class=" text-primary">Modules</h1>
        <br>
        <h3 class="mb-md-0">Use an old module or create a new one: </h3>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-1 grid-margin stretch-card">
            <a href="{{ route('admin.modules.create') }}">
                <div class="card border-primary mb-3">
                    <div height="120px">
                        <img src="{{ asset('/images/components/plus.jpg')}}"  class='card-img-top w-100' style="max-height: 120px;" alt="Responsive image">                
                    </div>               
                    <div class="card-body" >   
                        <div class="row">
                            <div class="col-10">
                                <h4>New Module</h4>                    
                            </div>                        
                        </div> 
                        <h6>Create a new Module</h6>
                    </div>               
                </div>
            </a>
        </div>  

        @foreach($modules  as $module)
        @component('components.myCard')
        @slot('image')
        @if(isset($module->image))
        <img src="/images/modules/{{ $module->image }}"  class='card-img-top w-100' style="max-height: 120px;" alt="Responsive image" />
        @endif
        @endslot

        @slot('name')
        {{ $module->name }}
        @endslot

        @slot('buttons')     
        <a href="{{ route('admin.modules.edit', $module->id) }}" class="dropdown-item">
            <button type="button" class="btn btn-outline-primary btn-sm col-12">Edit</button>
        </a>   
        <form action="{{route('admin.modules.destroy', $module->id)}}"  id='form-delete{{$module->id}}' method="POST" class="dropdown-item">
            @csrf
            {{method_field('DELETE')}}
            <button type="button" onclick='conferma({{$module->id}})' class="btn btn-outline-danger btn-sm col-12">
                Delete
            </button>           
        </form>
        
        
        @endslot
        @endcomponent      
        @endforeach
    </div>
</div> 
<script>
    function conferma(id) {
        if (confirm('Are you sure?')) {
            $('#form-delete'+id).submit();
        }
    }          
</script>
@endsection