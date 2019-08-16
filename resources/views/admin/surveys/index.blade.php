@extends('layouts.admin')

@section('title')
Modules
@endsection

@section('content')
<!-- partial -->

<div class="content-wrapper">
    <div class="row">
        <div class='container-fluid'>
            <h1> Choose a model to start or create one from scratch </h1>
        </div>
        <div class="col-lg-3 grid-margin stretch-card">
            <div class="card">
                <a href="{{ url('admin/surveys/' .'-1' . '/create') }}">
                    <div class="card-body">
                        <h4 class="card-title"> from scratch</h4>  
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

                    <a href="{{ url('admin/surveys/' .$module->id . '/create') }}" class="float-left">
                        <button type="button" class="btn btn-success btn-sm">Start from here</button>
                    </a>                    
                   
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(sizeof($surveys))
        <div class="row">
            <div class='container-fluid'>
                <h1> Manage Surveys </h1>
            </div>
            @foreach($surveys  as $survey)
            <div class="col-lg-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" >
                        <h4 class="card-title">{{ $survey->name }}</h4> 
                        <h3 class="card-title">{{ $survey->description }}</h3>  

                        <a href="{{ route('admin.surveys.edit', $survey->id) }}" class="float-left">
                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                        </a>     
                        <a href="{{ route('admin.surveys.show', $survey->id) }}">
                            <button type="button" class="btn btn-success btn-sm">Show</button>
                        </a>  
                        <form action="{{route('admin.surveys.destroy', $survey->id)}}" method="POST" class="float-left">
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
    @endif
</div> 
@endsection