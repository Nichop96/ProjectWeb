@extends('layouts.admin')

@section('title')
Surveys
@endsection

@section('content')
<!-- partial -->

<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
        <h1 class=" text-primary">Surveys</h1>
        <br>
        <h3 class="mb-md-0">Use an old survey or create a new one: </h3>
        <br>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-1 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <a href="{{ url('admin/surveys/' .'-1' . '/create') }}">
                    <div class="card-body">
                        <h4 class="text-black">New survey</h4>  
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
                    <a href="{{ url('admin/surveys/' .$module->id . '/edit') }}" class="float-left">
                        <button type="button" class="btn btn-outline-primary btn-sm">Use as model</button>
                    </a>                    

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(sizeof($surveys))
    <div class="row">
        <div class='container-fluid'>
            <h3 class="mb-md-0">Manage surveys:</h3>
            <br>
        </div>
        @foreach($surveys  as $survey)
        <div class="col-lg-3 col-md-3 col-sm-1 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="card-body" >
                    @if(isset($survey->image))
                    <img src="/images/surveys/{{ $survey['image'] }}" height="75px" alt="Responsive image" />
                    @endif
                    <h4>{{ $survey->name }}</h4> 
                    <br>
                    <h6>{{ $survey->description }}</h6>  
                    <br>
                    <div class="row">
                        <a href="{{ route('admin.surveys.edit', $survey->id) }}" class="float-left">
                            <button type="button" class="btn btn-outline-primary btn-sm">Edit</button>
                        </a>     
                        <a href="{{ route('admin.surveys.show', $survey->id) }}">
                            <button type="button" class="btn btn-outline-success btn-sm">Show</button>
                        </a>  
                        <form action="{{route('admin.surveys.destroy', $survey->id)}}" method="POST" class="float-left">
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
        @endforeach
    </div>
    @endif
</div> 
@endsection
