@extends('layouts.admin')

@section('title')
Module creation
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <h4 class="card-title">Creation of a module</h4>    
                    <form id="repeater-form" name="bbb">

                        <div  class="form-group">
                            <label for="aux_name" > Name </label>
                            <input id="aux_name" type="text" class="form-control form-control-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('aux_name', $module->name ? : '' ) }}" name="aux_name" placeholder="{{$module->name}} ">

                            @if ($errors->has('name'))                            
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="aux_description" > Description </label>
                            <input id="aux_description" type="text" class="form-control form-control-lg{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('aux_description', $module->description ? : '' ) }}"  name="aux_description" placeholder="{{$module->description}}">
                            @if ($errors->has('description'))

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                            <br>


                        </div>  
                        <div class="form-group">
                            Chose the category
                            <div class="row">
                                @foreach($categories  as $category)
                                <div class="col-3 form-check">
                                    <label class="form-check-label">
                                        <input  type="radio" class="form-check-input sel_category" id="{{ $category->id }}" name="category" {{ $category->id === $module->category_id ? "checked" : '' }} value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>

                                </div>
                                @endforeach
                                @if ($errors->has('category'))

                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$errors->first('category')          }} </strong>
                                </span>
                                @endif

                            </div>

                        </div>
                        <!-- modifiche da qua -->
                        
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label>
                            <input type="file" class="form-control-file" id="aux_fileChooser" name='file' form='aux_form' accept="image/png, .jpeg, .jpg, image/gif"/>
                            
                        </div>                      
                        
                        <!-- a qua -->
                        <br>
                        @foreach($questions as $question)
                        <br>                      
                            <div class="card" id="{{$question->id}}">
                                <!-- Repeater Content -->
                                <h5 class="card-title"> Insert question </h5>
                                <div class="item-content card-body block">

                                    <div class="form-group">
                                        <label  class="col-lg-2 control-label">Question</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control question form-control-lg" value="{{$question->name}}">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="leftlabel" class="col-lg-2 control-label">Left label</label>
                                            <input type="text" class="form-control leftlabel" value="{{$question->label_left}}" >
                                        </div>
                                        <div class="col">
                                            <label for="rightlabel"  class="col-lg-2 control-label">right label</label>
                                            <input type="text" class="form-control rightlabel" value="{{$question->label_right}}" >
                                        </div>
                                    </div>                            
                                    <div class='row'>
                                        <div class='col'>
                                       
                                            <div class="form-group">
                                                <label class="control-label ">Max mark value</label>
                                                <input type="text" class="form-control maxmark" value="{{$question->max_rate}}" >
                                            </div>
                                        </div>
                                        <div class='col'>
                                            <div class='form-group'>
                                                <label class="control-label ">Correct answer</label>
                                                <input type="text" class="form-control correctans" value="{{$question->correct_answer}}" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- Repeater Remove Btn -->
                                <div class="pull-right">
                                    <button class="btn btn-danger remove-btn" onclick="rimuovi('{{$question->id}}')">
                                        Remove
                                    </button>
                                </div>
                                <div class="clearfix"></div>

                            </div>                    
                        
                        <br>
                        @endforeach

                        <div id="questions">
                            <!-- Repeater Html Start -->
                            <div id="repeater">
                                <!-- Repeater Heading -->
                                <div class="repeater-heading">
                                    <h5 class="pull-left">Questions</h5>
                                    <button class="btn btn-primary repeater-add-btn">
                                        Add question
                                    </button>
                                </div>

                                <br>
                                <!-- Repeater Items -->
                                <div class="items" >
                                    <div class="card">
                                        <!-- Repeater Content -->
                                        <h5 class="card-title"> Insert question </h5>
                                        <div class="item-content card-body block">

                                            <div class="form-group">
                                                <label  class="col-lg-2 control-label">Question</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control question form-control-lg" >

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="leftlabel" class="col-lg-2 control-label">Left label</label>
                                                    <input type="text" class="form-control leftlabel"  >
                                                </div>
                                                <div class="col">
                                                    <label for="rightlabel"  class="col-lg-2 control-label">right label</label>
                                                    <input type="text" class="form-control rightlabel"  >
                                                </div>
                                            </div>                            

                                            <div class='row'>
                                                <div class='col'>
                                                    <div class="form-group">
                                                        <label for="maxmark" class="control-label ">Max mark value</label>

                                                        <input type="text" class="form-control maxmark" id="maxmark"  value="5" placeholder="5">

                                                    </div>
                                                </div>
                                                <div class='col'>
                                                    <div class="form-group">
                                                        <label for="correctans" class="control-label ">Correct answer</label>

                                                        <input type="text" class="form-control correctans" id="correctans"  value="5" placeholder="5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Repeater Remove Btn -->
                                        <div class="pull-right repeater-remove-btn">
                                            <button class="btn btn-danger remove-btn">
                                                Remove
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                                <br>

                            </div>
                            <!-- Repeater End -->



                        </div>

                        <br>

                    </form>
                   <div class="row">
                        <div class="col">
                            <button class="btn btn-primary" onclick="submit()">
                                submit Module
                            </button>
                        </div>
                        <div class="col">
                            <a href="{{ route('admin.modules.index') }}">
                                        <input type='button' class='btn btn-primary' value='Cancel'>
                            </a>
                        </div>
                    </div>
                </div> <!-- div di creazione modulo -->
                <div name="aux">
                    <form id="aux_form" class="pt-3" action="{{ route('admin.modules.update', ['module' => $module->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        {{ method_field('PUT') }}
                        <input type='hidden' class='aux_questions' name='aux_questions' id='aux_questions' />
                        <input type='hidden' class='aux_left' name='aux_left' id='aux_left' />
                        <input type='hidden' class='aux_right'  name='aux_right' id='aux_right' />
                        <input type='hidden' class='aux_maxmark' name='aux_maxmark' id='aux_maxmark' />
                        <input type='hidden' class='aux_correctans' name='aux_correctans' id='aux_correctans' />
                        <input type='hidden' class='aux_name' name='name' id='name' />
                        <input type='hidden' class='aux_description' name='description' id='description' />
                        <input type='hidden' class='aux_category' name='category' id='category' />
                        

                </div>
            </div>                                           
        </div>                
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/repeater.js') }}"></script>
<script>
                        /* Create Repeater */
                        $("#repeater").createRepeater({
                            showFirstItemToDefault: false,
                        });
</script>    
<script>
    $("#repeater-form").on('submit', function (event) {
        event.preventDefault();
    })
</script>
<script>
    function resetAllErrors(){
        $('.is-invalid').each(function(i, obj){
            $(this).removeClass('is-invalid');
        });
    }
</script>

<script>
    function LabelValidate(label) {
        // modo poco efficiente ma veloce da capire e fare

        if (parseInt(label)) {
            return false;
        }

        return true;
    }
</script>

<script>

    function my_empty(stringa) {
        var i;
        for (i = 0; i < stringa.length; i++) {
            if (stringa[i] === -1) {

            } else {
                return false;
            }
        }
        return true;
    }
</script>

<script>// continua da qui, estrai i valori e inviali alla pagina php che farà gli inserimenti tramite ajax
    function submit() { 
        resetAllErrors();
        
        
        var questions = $('.question').map(function (idx, elem) {
            var tmp = $(elem).val();
            if (tmp) {
                return tmp;
            }
            return -1;
        }).get();

        var leftLabels = $('.leftlabel').map(function (idx, elem) {
            var tmp = $(elem).val();
            if (tmp === '') {
                tmp = 'Low';
            }
            if (!LabelValidate(tmp)) { // se non è valida
                $(elem).addClass("is-invalid");
                
            }else{
                 $(elem).removeClass("is-invalid");
            }
            return tmp;
        }).get();

        var rightLabels = $('.rightlabel').map(function (idx, elem) {
            var tmp = $(elem).val();
            if (tmp === '') {
                tmp = 'High';
            }
            if (!LabelValidate(tmp)) { // se non è valida
                $(elem).addClass("is-invalid");
                
            }else{
                 $(elem).removeClass("is-invalid");
            }
            return tmp;
        }).get();

        var maxMark = $('.maxmark').map(function (idx, elem) {
            var tmp = $(elem).val();
            if (tmp === '') {
                tmp = 5;
            }
             if (LabelValidate(tmp) || (parseInt(tmp)<2) ) { // se non è valida
                $(elem).addClass("is-invalid");
                
            }else{
                 $(elem).removeClass("is-invalid");
            }
            return tmp;
        }).get();
        
         var correctans = $('.correctans').map(function (idx, elem) {
            var tmp = $(elem).val();
            if (tmp === '') {
                tmp = 5;
            }
            if (LabelValidate(tmp) || (parseInt(tmp)<1) || (parseInt(tmp)>parseInt(maxMark[idx]))) { // se non è valida ---> manca gestione del maggiore di maxrate
                $(elem).addClass("is-invalid");
                
            }else{
                 $(elem).removeClass("is-invalid");
            }
            return tmp;
        }).get();

        // question attributes

        document.getElementById("aux_left").value = leftLabels;
        document.getElementById("aux_right").value = rightLabels;
        document.getElementById("aux_maxmark").value = maxMark;
        document.getElementById("aux_correctans").value = correctans;
        // module attributes
        document.getElementById("name").value = document.getElementById("aux_name").value;
        document.getElementById("description").value = document.getElementById("aux_description").value;

        var tmp = $("input:checked").val();
        if (!tmp) {
            tmp = null;
        }
        document.getElementById("category").value = tmp;

        if(!$('.is-invalid').length){
            if (!Array.isArray(questions) || my_empty(questions)) {
                if (confirm("You are saving a module without questions, are you sure?")) {
                    document.getElementById("aux_questions").value = questions;
                    document.getElementById("aux_form").submit();
                } else {
                    // do nothing
                }
            } else { // if exist atleast a question
                document.getElementById("aux_questions").value = questions;
                document.getElementById("aux_form").submit();
            }

        }
    }
</script>
<script>
    function rimuovi(elemID){
       var element = document.getElementById(elemID);
       element.parentNode.removeChild(element);
    }
</script>

@endsection