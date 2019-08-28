@extends('layouts.user')

@section('title')
Survey
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <br>
                    <h2 class="text-primary">{{ $survey->name }}</h2> 
                    <br>
                    <h4>{{ $survey->description }}</h4>           
                    <br>   
                    <form class="pt-3" action="{{ route('user.surveys.store') }}" method="POST">
                        @csrf                        
                        @foreach($questions as $question)                  
                        <input type="hidden" name='question_id{{ $loop->iteration }}' value='{{$question->id}}'>
                        <input type="hidden" name='id' value='{{$survey->id}}'>
                        <div class="card border-primary mb-3">
                            <div class="card-header">
                                <br>
                                <h5>{{ $question->name }}</h5>
                            </div>
                            <div class="card-body">                                                 
                                    @php
                                     $max = $question->max_rate;
                                     @endphp
                                    @for ($t = 0; $t < $question->max_rate; $t=$t+5)                                 
                                    @php $tmp = min(5,($max)); @endphp
                                    <div class="row"> 
                                        <div class="col-1 form-check"></div>
                                        @for ($j = 1; $j <= $tmp; $j++)
                                        <div class="col-2">                                           
                                            {{$j +$t}}                                            
                                        </div>
                                        @endfor                                
                                    </div>
                                    <div class="row">   
                                        <div class="col-1 form-check"></div>
                                        @for ($j = 1; $j <= $tmp; $j++)
                                        <div class="col-2 form-check">
                                            <label class="form-check-label">                                       
                                                <input type="radio" class="form-check-input" name="answer{{ $loop->iteration }}" value="{{ ($j +$t) }}" required>                                           
                                            </label> 
                                        </div>
                                        @endfor
                                    </div>
                                    @php $max=$max-5; @endphp
                                    @endfor
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
                        <button class="btn btn-outline-primary" type="submit">
                            Submit
                        </button>
                    </form> 
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

