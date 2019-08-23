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
            <div class="card border-primary mb-3">
                <a href="{{ route('admin.modules.create') }}">
                    <div class="card-body">
                        <h4 class="text-black">New module</h4>  
                        <div class="col-8">
                            <br>
                            <img src="{{ asset('images/components/piu11.jpg')}}" class="img-fluid" alt="Responsive image">    
                        </div>
                    </div>
                </a>
            </div>
        </div>

        @foreach($modules  as $module)
        <div class="col-lg-3 col-md-3 col-sm-1 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="card-body" >
                    @if(isset($module->image))
                    <img src="/images/modules/{{ $module['image'] }}" height="75px" alt="Responsive image" />
                    @endif
                    <h4>{{ $module->name }}</h4> 
                    <br>
                    <h6>{{ $module->description }}</h6>  
                    <br>
                    <div class="row">
                        <div>
                            <a href="{{ route('admin.modules.edit', $module->id) }}" class="float-left">
                                <button type="button" class="btn btn-outline-primary btn-sm">Edit</button>
                            </a>   
                        </div>
                        <div class="left-padding">
                            <form action="{{route('admin.modules.destroy', $module->id)}}" method="POST" class="float-left">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Delete
                                </button>           
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div> 
@endsection