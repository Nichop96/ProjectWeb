@extends('layouts.user')

@section('title')
Surveys
@endsection

@section('content')
<!-- partial -->

<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
        <h1 class=" text-primary">Surveys</h1>
        <br>
        <h4 class="mb-md-0">New surveys: </h4>
        <br>
    </div>
    <div class="row">
        @foreach($surveys  as $survey)        
        @component('components.myCard')
            @slot('image')
                @if(isset($survey->image))
                <img src="/images/surveys/{{ $survey->image }}"  class='card-img-top w-100' style="max-height: 120px;" alt="Responsive image" />
                @endif
            @endslot
            
            @slot('name')
                    {{ $survey->name }}
            @endslot
            
            @slot('description')
                  {{ $survey->description }}
            @endslot
            
            @slot('buttons') 
                    <a href="{{ url('user/surveys/' .$survey->id . '/create') }}" class="dropdown-item">
                        <button type="button" class="btn btn-outline-primary btn-sm col-12">Complete</button>
                    </a>                     
            @endslot
        @endcomponent 
        @endforeach
    </div>
    @if(sizeof($completedSurveys))
    <div class="row">
        <div class='container-fluid'>
            <h4>Completed surveys:</h4>
            <br>
        </div>
        @foreach($completedSurveys  as $completedSurvey)
        @component('components.myCard')
            @slot('image')
                @if(isset($completedSurvey->image))
                <img src="/images/surveys/{{ $survey->image }}"  class='card-img-top w-100' style="max-height: 120px;" alt="Responsive image" />
                @endif
            @endslot
            
            @slot('name')
                    {{ $completedSurvey->name }}
            @endslot
            
            @slot('description')
                  {{ $completedSurvey->description }}
            @endslot
            
            @slot('buttons') 
                    <a href="{{ url('user/surveys/' .$survey->id . '/show') }}" class="dropdown-item">
                        <button type="button" class="btn btn-outline-success btn-sm col-12">Show</button>
                    </a>                     
            @endslot
        @endcomponent           
        @endforeach
    </div>
    @endif
</div> 
@endsection
