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
            <a href="{{ url('admin/surveys/' .'-1' . '/create') }}">
                <div class="card border-primary mb-3">
                    <div height="120px">
                        <img src="{{ asset('/images/components/plus.jpg')}}"  class='card-img-top w-100' style="max-height: 120px;" alt="Responsive image">                
                    </div>
                    <div class="card-body" >   
                        <div class="row">
                            <div class="col-10">
                                <h4>New Survey</h4>                    
                            </div>                        
                        </div>                       
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
        <a href="{{ url('admin/surveys/' .$module->id . '/create') }}" class="dropdown-item">
            <button type="button" class="btn btn-outline-primary btn-sm col-12">Use as model</button>
        </a>                   
        @endslot
        @endcomponent
        @endforeach
    </div>
    @if(sizeof($surveys))
    <div class="row">
        <div class='container-fluid'>
            <h3 class="mb-md-0">Manage surveys:</h3>
            <br>
        </div>
        @foreach($surveys  as $survey)
        @component('components.myCard')
        @slot('image')
        @if(isset($survey->image))
        <img src="/images/surveys/{{ $survey->image }}" class='card-img-top w-100' style="max-height: 120px;" alt="Responsive image" />
        @endif 
        @endslot

        @slot('name')
        {{ $survey->name }}
        @endslot

        @slot('buttons')
        @if(isset($survey->editable) && $survey->editable == true)
        <a href="{{ route('admin.surveys.edit', $survey->id) }}" class="dropdown-item">
            <button type="button" class="btn btn-outline-primary btn-sm mr-2 col-12">Edit</button>
        </a>     
        @endif
        @if(isset($survey->fillable))
        @if($survey->fillable == true)
        <a href="{{ route('admin.surveys.closeSurvey', $survey->id) }}" class="dropdown-item">
            <button type="button" class="btn btn-outline-info btn-sm mr-2 col-12">Close</button>
        </a> 
        @else
        <a href="{{ route('admin.surveys.closeSurvey', $survey->id) }}" class="dropdown-item">
            <button type="button" class="btn btn-outline-warning btn-sm mr-2  col-12">Open</button>
        </a> 
        @endif                        
        @endif
        <a href="{{ route('admin.surveys.show', $survey->id) }}" class="dropdown-item">
            <button type="button" class="btn btn-outline-success btn-sm mr-2 col-12">Show</button>
        </a>  
        <form action="{{route('admin.surveys.destroy', $survey->id)}}" method="POST" class="dropdown-item">
            @csrf
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-outline-danger btn-sm  mr-2 col-12">
                Delete
            </button>           
        </form>
        @endslot

        @endcomponent
        @endforeach
    </div>
    @endif
</div> 
@endsection
