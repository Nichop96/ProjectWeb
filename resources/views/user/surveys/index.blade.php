@extends('layouts.user')

@section('title')
Surveys
@endsection

@section('content')
<!-- partial -->

<div class="content-wrapper">
    <div class="row">
        <div class='container-fluid'>
            <h1>New surveys</h1>
        </div>


        @foreach($surveys  as $survey)
        <div class="col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" >
                    <h4 class="card-title">{{ $survey->name }}</h4> 
                    

                    <a href="{{ url('user/surveys/' .$survey->id . '/create') }}" class="float-left">
                        <button type="button" class="btn btn-success btn-sm">Answer</button>
                    </a>
                                          

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(sizeof($completedSurveys))
    <div class="row">
        <div class='container-fluid'>
            <h1> Surveys completed </h1>
        </div>
        @foreach($completedSurveys  as $completedSurvey)
        <div class="col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" >
                    <h4 class="card-title">{{ $completedSurvey->name }}</h4> 
                    <h3 class="card-title">{{ $completedSurvey->description }}</h3>  

                    <a href="{{ url('user/surveys/' .$completedSurvey->completed_id . '/show') }}" class="float-left">
                        <button type="button" class="btn btn-primary btn-sm">Show</button>
                    </a> 
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div> 
@endsection