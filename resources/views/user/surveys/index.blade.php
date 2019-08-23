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
        <div class="col-lg-3 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="card-body" >
                    <h4>Title: {{ $survey->name }}</h4> 
                    <h6>Descr: {{ $survey->description }}</h6> 

                    <a href="{{ url('user/surveys/' .$survey->id . '/create') }}" class="float-left">
                        <button type="button" class="btn btn-outline-primary btn-sm">Complete</button>
                    </a>
                                          

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(sizeof($completedSurveys))
    <div class="row">
        <div class='container-fluid'>
            <h4>Completed surveys:</h4>
            <br>
        </div>
        @foreach($completedSurveys  as $completedSurvey)
        <div class="col-lg-3 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="card-body" >
                    <h4>Title: {{ $completedSurvey->name }}</h4> 
                    <h6>Descr: {{ $completedSurvey->description }}</h6>  

                    <a href="{{ url('user/surveys/' .$completedSurvey->completed_id . '/show') }}" class="float-left">
                        <button type="button" class="btn btn-outline-success btn-sm">Show</button>
                    </a> 
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div> 
@endsection
