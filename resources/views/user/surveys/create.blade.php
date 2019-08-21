@extends('layouts.user')

@section('title')
Answer Survey
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <h4 class="card-title">{{ $survey->name }}</h4>                      
                    <h4 class="card-title">{{ $survey->description }}</h4>                      
                    <form class="pt-3" action="{{ route('user.surveys.store') }}" method="POST">
                        @csrf                        
                        @foreach($questions as $question)                  
                        <input type="hidden" name='question_id{{ $loop->iteration }}' value='{{$question->id}}'>
                        <input type="hidden" name='id' value='{{$survey->id}}'>
                        <div class="card border-primary mb-3">
                            <div class="card-header">{{ $question->name }}</div>
                            <div class="card-body">                                                 
                                <div class="row"> 
                                    <div class="col-1 form-check"></div>
                                    @for ($j = 1; $j <= $question->max_rate; $j++)
                                    <div class="col-2">
                                        {{ $j }}
                                    </div>
                                    @endfor                                
                                </div>
                                <div class="row">   
                                    <div class="col-1 form-check"></div>
                                    @for ($j = 1; $j <= $question->max_rate; $j++)
                                    <div class="col-2 form-check">
                                        <label class="form-check-label">                                       
                                            <input type="radio" class="form-check-input" name="answer{{ $loop->iteration }}" value="{{ $j }}" required>                                           
                                        </label> 
                                    </div>
                                    @endfor
                                </div>
                                <div class="row">
                                    <div class="col-6 form-check">
                                        <label class="form-check-label"> 
                                            <p id="label_left_show" class='float-left'>{{ $question->label_left }}</p>
                                        </label>
                                    </div>
                                    <div class="col-6 form-check">
                                        <label class="form-check-label"> 
                                            <p id="label_left_show" class='float-right'>{{ $question->label_right }}</p>
                                        </label>
                                    </div>
                                </div>                                
                            </div>
                        </div>                                   
                        @endforeach
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                    </form> 
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

