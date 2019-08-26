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
        @component('components.myCard')
            @slot('image')
                @if(isset($module->image))
                <img src="/images/modules/{{ $module['image'] }}"  class='card-img-top w-100' style="max-height: 120px;" alt="Responsive image" />
                @endif
            @endslot
            
            @slot('name')
                    {{ $module->name }}
            @endslot
            
            @slot('description')
                  {{ $module->description }}
            @endslot
            
            @slot('buttons')     
                     <a href="{{ route('admin.modules.edit', $module->id) }}" class="dropdown-item">
                        <button type="button" class="btn btn-outline-primary btn-sm col-12">Edit</button>
                    </a>   
                    <form action="{{route('admin.modules.destroy', $module->id)}}" method="POST" class="dropdown-item">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-outline-danger btn-sm col-12">
                            Delete
                        </button>           
                    </form>
            @endslot
        @endcomponent      
        @endforeach
    </div>
</div> 
@endsection
