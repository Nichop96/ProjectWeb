@extends('layouts.admin')

@section('title')
Modules
@endsection

@section('content')
<!-- partial -->

<div class="content-wrapper">
    <div class="row">

        <div class="col-lg-3 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('admin.modules.create') }}">
                    <div class="card-body">
                        <h4 class="card-title">New module</h4>  
                        <img src="{{ asset('images/components/plus_little.jpg')}}" class="img-fluid" alt="Responsive image">                      
                    </div>
                </a>
            </div>
        </div>
        
        @foreach($modules  as $module)
        <div class="col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" >
                    <h4 class="card-title">{{ $module->name }}</h4> 
                    <h3 class="card-title">{{ $module->description }}</h3>  
                    
                    <a href="{{ route('admin.modules.edit', $module->id) }}" class="float-left">
                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                    </a>                    
                    <form action="{{route('admin.modules.destroy', $module->id)}}" method="POST" class="float-left">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger btn-sm">
                            Delete
                        </button>           
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div> 
@endsection