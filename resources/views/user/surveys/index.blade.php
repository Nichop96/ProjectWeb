@extends('layouts.user')

@section('title')
Surveys
@endsection

@section('content')
<!-- partial -->

<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
        <div class="row">
            <div class="col-9">
                <h1 class=" text-primary">{{__('indexes.surveys')}}</h1>
            </div>
            <div class="col-3">
                <form action="{{route('user.surveys.search')}}" method="POST" >
                    <div class="row">
                        <div class="col-9">
                            @csrf
                            <input id="search" type="text" maxlength="255" class="form-control border-primary" name="search" placeholder="{{__('indexes.search')}}">

                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary" >{{__('indexes.search')}}</button>     
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br>
        @if(sizeof($surveys))
        <h4 class="mb-md-0">{{__('indexes.new_sur')}}:</h4>
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

        @slot('buttons') 
        <a href="{{ url('user/surveys/' .$survey->id . '/create') }}" class="dropdown-item">
            <button type="button" class="btn btn-outline-primary btn-sm col-12">{{__('indexes.complete')}}</button>
        </a>                     
        @endslot
        @endcomponent 
        @endforeach        
    </div>
    @else
    <h4 class="mb-md-0 text-info">{{__('indexes.no_surveys')}}</h4>
    <br>
    @endif
    @if(sizeof($completedSurveys))
    <div class="row" id="complete">
        <div class='container-fluid'>
            <h4>{{__('indexes.completed_surveys')}}:</h4>
            <br>
        </div>
        @foreach($completedSurveys  as $completedSurvey)
        @component('components.myCard')
        @slot('image')
        @if(isset($completedSurvey->image))
        <img src="/images/surveys/{{ $completedSurvey->image }}"  class='card-img-top w-100' style="max-height: 120px;" alt="Responsive image" />
        @endif
        @endslot

        @slot('name')
        {{ $completedSurvey->name }}
        @endslot

        @slot('description')
        {{ $completedSurvey->description }}
        @endslot

        @slot('buttons') 
        <a href="{{ url('user/surveys/' .$completedSurvey->completed_id . '/show') }}" class="dropdown-item">
            <button type="button" class="btn btn-outline-success btn-sm col-12">{{__('indexes.show')}}</button>
        </a>                     
        @endslot
        @endcomponent           
        @endforeach
    </div>
    @else
    <h4 class="mb-md-0 text-info">{{__('indexes.no_complet')}}</h4>
    @endif
</div> 
@endsection
