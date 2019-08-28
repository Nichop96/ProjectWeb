@extends('layouts.admin')

@section('title')
Create module
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <br>
                    <h2 class="text-primary">Create module</h2> 
                    <br>
                    
                    <form id="repeater-form" name="bbb">

                        <div  class="form-group">
                            <h5 for="aux_name" > Name </h5>
                            <input id="aux_name" type="text" maxlength="255" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="aux_name" placeholder="Module name">

                            @if ($errors->has('name'))                            
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                            <span id="nameNull" class="text-danger">                                
                            </span>
                            <br>
                        </div>
                        <div class="form-group">
                            <h5 for="aux_description" > Description </h5>
                            <input id="aux_description" type="text" maxlength="255" class="form-control form-control-lg{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description') }}" name="aux_description" placeholder="Module's description">
                            @if ($errors->has('description'))

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                            <br>


                        </div>  
                        <div class="form-group">
                            <h5> Choose a category </h5>
                            <div class="row">
                                @foreach($categories  as $category)
                                <div class="col-lg-3 col-md-3 col-sm-1 form-check">
                                    <div>
                                    <label class="form-check-label">
                                        <input  type="radio" class="form-check-input sel_category" name="category" id="aux_category{{ $category->id }}" value="{{ $category->id }}" @if($loop->iteration==1) checked @endif>
                                        {{ $category->name }}
                                    </label>
                                    </div>

                                </div>
                                @endforeach
                                @if ($errors->has('category'))

                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$errors->first('category')          }} </strong>
                                </span>
                                @endif
                                <span>
                                    <strong class="text-danger" id="categoryNull"> </strong>
                                </span>
                            </div>
                        </div>
                        
                        
                        <!-- modifiche da qua -->
                        
                        <div class="form-group">
                            <h5 for="exampleFormControlFile1">Picture of the product</h5>
                            <br>
                            <input type="file" class="form-control-file" id="aux_fileChooser" name='file' form='aux_form' accept="image/png, .jpeg, .jpg, image/gif"/>
                            
                        </div>                      
                        
                        <!-- a qua -->
                        
                        <br>
                        <div id="questions">
                            <!-- Repeater Html Start -->
                            <div id="repeater">
                                <!-- Repeater Heading -->
                                <div class="repeater-heading">
                                    <h5 class="pull-left">Questions</h5>
                                    <br>
                                    <button class="btn btn-primary repeater-add-btn mt-3 mr-3">
                                        Add question
                                    </button>
                                    @component('components.importQuestions.modalSelect')
                                        @slot('type')
                                        module
                                        @endslot
                                    @endcomponent

                                </div>
                                <br>
                                <div class="clearfix"></div>
                                <!-- Repeater Items -->
                                <div class="items" data-group="test">
                                    <br>
                                    <div class="card border-primary mb-3">
                                       
                                        <div class="item-content card-body block align-self-lg-auto">

                                            <div class="form-group">
                                                <h5 for="question" class="col-lg-5 control-label">Question</h5>
                                                <div class="col-lg-12 col-md-9 col-sm-5">
                                                    <input type="text" class="form-control question"   placeholder="Question" >
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <h5 for="leftlabel" class="col-lg-6 control-label">Left label</h5>
                                                    <input type="text" id="leftlabel" name="leftlabel" class="form-control leftlabel" placeholder="Low">
                                                    
                                                </div>
                                                <div class="col">
                                                    <h5 for="rightlabel"  class="col-lg-6 control-label">Right label</h5>
                                                    <input type="text" id="rightlabel" name="rightlabel" class="form-control rightlabel" placeholder="High">
                                                    <br>
                                                </div>
                                            </div>                            
                                            <div class='row'>
                                                <div class='col'>
                                                <div class="form-group">
                                                    <h5 for="maxmark" class="control-label ">Max value</h5>

                                                    <input type="text" class="form-control maxmark" id="maxmark"  value="5" placeholder="5">

                                                </div>
                                                </div>
                                                <div class='col'>
                                                <div class="form-group">
                                                <h5 for="correctans" class="control-label ">Correct answer</h5>

                                                <input type="text" class="form-control correctans" id="correctans"  value="5" placeholder="5">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- Repeater Remove Btn -->
                                        <div class="pull-right ml-5 mb-5 repeater-remove-btn">
                                            <button class="btn btn-danger remove-btn">
                                                Remove question
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
                            <button class="btn btn-outline-primary" onclick="submit()">
                                Save module 
                            </button>
                        </div>
                        <div class="col">
                            <a href="{{ route('admin.modules.index') }}">
                                        <input type='button' class='btn btn-outline-danger' value='Cancel'>
                            </a>
                        </div>
                    </div>
                </div> <!-- div di creazione modulo -->
                <div name="aux">
                    <form id="aux_form" class="pt-3" action="{{ route('admin.modules.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
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

@component('components.importQuestions.modalQuestions')
@endcomponent


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
    });
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
<script>
    // return: true if is a string
    //         false if is a number
    function LabelValidate(label) {
        // modo poco efficiente ma veloce da capire e fare
        if (parseInt(label)) {
            return false;
        }
        return true;
    }
</script>
<script>
    function resetAllErrors(){
        $('.is-invalid').each(function(i, obj){
            $(this).removeClass('is-invalid');
        });
    }
</script>
<script>
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
        var name = document.getElementById("aux_name").value;
        if(name ==="") {
            $('#aux_name').addClass("is-invalid");
            $('#nameNull').html('A module must have a name');
        }
        document.getElementById("name").value = document.getElementById("aux_name").value; 
        document.getElementById("description").value = document.getElementById("aux_description").value;
        var tmp = $("input:checked").val();
        if (!tmp) {
            tmp = null;
            $('#categoryNull').html("Choose a category");
            $('#categoryNull').addClass("is-invalid");
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
   var element = document.getElementById('question_'+elemID);
   element.parentNode.removeChild(element);
}
</script>
@component('components.importQuestions.importJs')
    @slot('type')
    module
    @endslot
@endcomponent
@endsection
