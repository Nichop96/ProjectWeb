@extends('layouts.admin')

@section('title')
Create survey
@endsection

@section('content')
<!-- da rimuovere il controllo su $questions?
        && isset($questions))
(io l'ho tolto, controllare che non ci siano errori)
-->

 <div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <br>
                    <h2 class="text-primary">Create survey</h2>    
                    <br>
                    <form id="repeater-form" name="bbb">                         
                        <div  class="form-group">
                            <h5 for="aux_name" > Name </h5>
                            @if(isset($module))
                            <input id="aux_name" type="text" class="form-control form-control-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ (old('aux_name', $module->name ? : '' )) }}" name="aux_name" placeholder="{{$module->name}} ">
                            @else
                            <input id="aux_name" type="text" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('aux_name') }}" name="aux_name" placeholder="Survey name">
                            @endif
                            
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
                            @if(isset($module))
                            <input id="aux_description" type="text" class="form-control form-control-lg{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('aux_description', $module->description ? : '' ) }}"  name="aux_description" placeholder="{{$module->description}}">
                            @else
                            <input id="aux_description" type="text" class="form-control form-control-lg{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('aux_description') }}" name="aux_description" placeholder="Survey's description">
                            @endif
                            @if ($errors->has('description'))

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                            <br>


                        </div>  
                        <div class="form-group">
                            <h5 class="col-lg-3 col-md-3 col-sm-1">Chose the category</h5>
                            <div class="row">
                                @foreach($categories  as $category)
                                <div class="col-lg-3 col-md-3 col-sm-1 form-check">
                                    <label class="form-check-label">
                                        @if(isset($module))
                                        <input  type="radio" class="form-check-input sel_category"  name="aux_category" {{ $category->id === $module->category_id ? "checked" : '' }} value="{{ $category->id }}" @if($loop->iteration==1) checked @endif>
                                        @else
                                        <input  type="radio" class="form-check-input sel_category" name="category" id="aux_category{{ $category->id }}" value="{{ $category->id }}" @if($loop->iteration==1) checked @endif>
                                        @endif
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
                            
                         <div class="form-group">
                            <h5 for="file">Avatar of the survey</h5>
                            <input type="file" class="form-control-file" name='file' form='aux_form' accept="image/png, .jpeg, .jpg, image/gif" />
                            
                        </div>  
                        
                        <br>
                        @if(isset($module) && isset($questions))
                        @foreach($questions as $question)
                        <br>                      
                        <div class="card border-primary" id="question_{{$question->id}}">
                            <!-- Repeater Content -->                            
                            <div class="item-content card-body block">

                                <div class="form-group">
                                    <h5  class="col-lg-2 control-label">Question</h5>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control question form-control-lg" value="{{$question->name}}">

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <h5 for="leftlabel" class="col-lg-6 control-label">Left label</h5>
                                        <input type="text" class="form-control leftlabel" value="{{$question->label_left}}" >
                                    </div>
                                    <div class="col">
                                        <h5 for="rightlabel"  class="col-lg-6 control-label">Right label</h5>
                                        <input type="text" class="form-control rightlabel" value="{{$question->label_right}}" >
                                    </div>
                                </div>                            
                                <br>
                                <div class='row'>
                                        <div class='col'>
                                       
                                            <div class="form-group">
                                                <h5 class="control-label ">Max value</h5>
                                                <input type="text" class="form-control maxmark" value="{{$question->max_rate}}" >
                                            </div>
                                        </div>
                                        <div class='col'>
                                            <div class='form-group'>
                                                <h5 class="control-label ">Correct answer</h5>
                                                <input type="text" class="form-control correctans" value="{{$question->correct_answer}}" >
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- Repeater Remove Btn -->
                            <div class="pull-right">
                                <button class="btn btn-danger ml-5 mb-5 remove-btn" onclick="rimuovi('question_{{$question->id}}')">
                                    Remove question
                                </button>
                            </div>
                            <div class="clearfix"></div>

                        </div>                    

                        <br>
                        @endforeach
                        @endif
                        
                        <div id="questions">
                            <!-- Repeater Html Start -->
                            <div id="repeater">
                                <!-- Repeater Heading -->
                                <div class="repeater-heading">
                                    <h5 class="pull-left">Questions</h5>
                                    <button class="btn btn-primary repeater-add-btn mt-3 mr-3">
                                        Add question
                                    </button>
                                    
                                    @component('components.importQuestions.modalSelect')
                                        @slot('type')
                                        survey
                                        @endslot
                                    @endcomponent
                                </div>

                                <br>
                                <!-- Repeater Items -->
                                <div class="items" >
                                    <br>
                                    <div class="card border-primary">
                                        <!-- Repeater Content -->
                                        <div class="item-content card-body block">

                                             <div class="form-group">
                                                <h5 for="question" class="col-lg-2 control-label">Question</h5>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control question"   placeholder="question" >
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <h5 for="leftlabel" class="col-lg-6 control-label">Left label</h5>
                                                    <input type="text" id="leftlabel" name="leftlabel" class="form-control leftlabel" placeholder="Low">
                                                    <span class="invalid-feedback leftlabel-alert" hidden role="alert">
                                                        <strong>Invalid filed!</strong>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <h5 for="rightlabel"  class="col-lg-6 control-label">Right label</h5>
                                                    <input type="text" id="rightlabel" name="rightlabel" class="form-control rightlabel" placeholder="High">
                                                </div>
                                            </div>                            
                                            <br>
                                            <div class='row'>
                                                <div class='col'>
                                                    <div class="form-group">
                                                        <h5 for="maxmark" class="control-label ">Max value</h5>

                                                        <input type="text" class="form-control maxmark"   value="5" placeholder="5">

                                                    </div>
                                                </div>
                                                <div class='col'>
                                                    <div class="form-group">
                                                        <h5 for="correctans" class="control-label ">Correct answer</h5>

                                                        <input type="text" class="form-control correctans"   value="5" placeholder="5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Repeater Remove Btn -->
                                        <div class="pull-right repeater-remove-btn">
                                            <button class="btn btn-danger ml-5 mb-5 remove-btn">
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
                    <div class="table-responsive">
                        <table class="table" id='table'>
                            <thead>
                                <tr>
                                    <th scope="col" class="text-primary">Name</th>  
                                    <th scope="col" class="text-primary">Description</th> 
                                    <th scope="col" class="text-primary">Number of users</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groups as $group)
                                <tr onclick="selezionato({{$group->id}})" id='{{$group->id}}'>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->description }}</td>
                                    <td>{{ $group->count }} </td>

                                </tr>    
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    {{ $groups->links() }}
                    <br>
                    <br>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-outline-primary" onclick="submit()">
                                Submit
                            </button>
                        </div>
                        <div class="col">
                            <a href="{{ route('admin.surveys.index') }}">
                                        <input type='button' class='btn btn-outline-danger' value='Cancel'>
                            </a>
                        </div>
                    </div>
                </div> <!-- div di creazione modulo -->
                <div name="aux">
                    <form id="aux_form" class="pt-3" action="{{ route('admin.surveys.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf 

                        <input type='hidden' class='aux_questions' name='aux_questions' id='aux_questions' />
                        <input type='hidden' class='aux_left' name='aux_left' id='aux_left' />
                        <input type='hidden' class='aux_right'  name='aux_right' id='aux_right' />
                        <input type='hidden' class='aux_maxmark' name='aux_maxmark' id='aux_maxmark' />
                        <input type='hidden' class='aux_correctans' name='aux_correctans' id='aux_correctans' />
                        
                        <input type='hidden' class='aux_name' name='name' id='name' />
                        <input type='hidden' class='aux_description' name='description' id='description' />
                        <input type='hidden' class='aux_category' name='category' id='category' />
                        <input type='hidden' name='aux_groups' id='aux_groups'/>
                        @if(isset($module))
                        <input type="hidden" name="aux_module_id" id="aux_module_id" value="{{$module->id}}"/>
                        @endif
                    </form>        
                </div>
            </div>                                           
        </div>                
    </div>
</div>

@component('components.importQuestions.modalQuestions')
@endcomponent

<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/repeater.js') }}"></script>


<script>
    /* Create Repeater */
    $("#repeater").createRepeater({
        showFirstItemToDefault: false,
        isFirstItemUndeletable: false
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
            if (stringa[i] === - 1) {

            } else {
                return false;
            }
        }
        return true;
    }
</script>

<script>
    function check_table(){
        var tmp = [];
        var table = document.getElementById("table");
        var groups = document.getElementById("aux_groups");
        var flag = false; // check if exist atleast a selected group
        var r=0;
        while(row=table.rows[r++]){
            if(row.classList.contains("bg-success")){
                tmp.push(row.id);
                flag = true;
            }
        }
        groups.value = tmp;
        return flag;
    }
</script>

<script>
    function rimuovi(elemID){
        var element = document.getElementById(elemID);
        element.parentNode.removeChild(element);
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
            } else{
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
            } else{
                $(elem).removeClass("is-invalid");
            }
            return tmp;
        }).get();
        
        var maxMark = $('.maxmark').map(function (idx, elem) {
            var tmp = $(elem).val();
            if (tmp === '') {
                tmp = 5;
            }
            if (LabelValidate(tmp) || (parseInt(tmp) < 2)) { // se non è valida
                $(elem).addClass("is-invalid");
            } else{
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
        var name = document.getElementById("aux_name").value;
        if(name ==="") {
            $('#aux_name').addClass("is-invalid");
            $('#nameNull').html('A survey must have a name');
        }

        // module attributes
        document.getElementById("name").value = document.getElementById("aux_name").value;
        document.getElementById("description").value = document.getElementById("aux_description").value;

       var tmp = $(".sel_category:checked").val();
        if (!tmp) {
            tmp = null;
        }
        document.getElementById("category").value = tmp;
            
        if (!$('.is-invalid').length){
            if (!Array.isArray(questions) || my_empty(questions)) {
                alert("You can not save a module without questions!");

            } else { // if exist atleast a question
                if(check_table()){
                    document.getElementById("aux_questions").value = questions;
                    $("#aux_form").attr("action", "{{ route('admin.surveys.store') }}"); //Will set it
                    //document.getElementById("aux_form").submit();
                    $("#aux_form").submit();    
                }else if(confirm('To create a survey you must add a group! or save the current survey as a module. \n\ Confirmim to save it as a model.')){
                    // salva come modulo
                    document.getElementById("aux_questions").value = questions;
                    $("#aux_form").attr("action", "{{ route('admin.modules.store') }}"); //Will set it
                    //document.getElementById("aux_form").submit();
                    $("#aux_form").submit();
                }else{ // se non voglio salvarlo come modulo
                        
                }
            }

        }
}
</script>
@component('components.importQuestions.importJs')
    @slot('type')
    survey
    @endslot
@endcomponent

@endsection
<script>
    function selezionato(id){
        document.getElementById(id).classList.toggle("bg-success");
    }
</script>
