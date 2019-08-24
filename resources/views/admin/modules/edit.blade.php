@extends('layouts.admin')

@section('title')
Edit module
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div id="card-body" class="card-body">
                    <h2 class="text-primary">Edit module</h2>    
                    <br>
                    <form id="repeater-form" name="bbb">

                        <div  class="form-group">
                            <h5 for="aux_name" > Name </h5>
                            <input id="aux_name" type="text" class="form-control form-control-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('aux_name', $module->name ? : '' ) }}" name="aux_name" placeholder="{{$module->name}} ">

                            @if ($errors->has('name'))                            
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                            <br>
                        </div>
                        <div class="form-group">
                            <h5 for="aux_description" > Description </h5>
                            <input id="aux_description" type="text" class="form-control form-control-lg{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('aux_description', $module->description ? : '' ) }}"  name="aux_description" placeholder="{{$module->description}}">
                            @if ($errors->has('description'))

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                            <br>


                        </div>  
                        <div class="form-group">
                            <h5>Chose a category</h5>
                            <div class="row">
                                @foreach($categories  as $category)
                                <div class="col-lg-3 col-md-3 col-sm-1 form-check">
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
                            <h5 for="exampleFormControlFile1">Picture of the product </h5>
                            <br>
                            <input type="file" class="form-control-file" id="aux_fileChooser" name='file' form='aux_form' accept="image/png, .jpeg, .jpg, image/gif"/>
                            
                        </div>                      
                        
                        <!-- a qua -->
                        <br>
                        @foreach($questions as $question)
                        <br>                      
                            <div class="card border-primary mb-3" id="{{$question->id}}">
                                <!-- Repeater Content -->
                                <div class="item-content card-body block">

                                    <div class="form-group">
                                        <h5  class="col-lg-5  control-label">Question</h5>
                                        <div class="col-lg-12 col-md-9 col-sm-5">
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
                                    <button class="btn btn-danger remove-btn" onclick="rimuovi('{{$question->id}}')">
                                        Remove question
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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#selectModule" id="fetchall">
                                        Import questions
                                    </button>
                                    <div class="modal fade" id="selectModule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Import questions</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>                                            
                                            <div class="modal-body">
                                                <h6>Select a module of wich you want to take some questions</h6>                                                                                                            
                                                <div class="table-responsive">
                                                    <table id="recent_surveys" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Description</th>
                                                                <th>Category</th>                        
                                                                <th>Actions</th>                       
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody">                                                                
                                                        </tbody>
                                                    </table>
                                                </div>                                                        
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#importQuestions" id='module_selected'>Select module</button>
                                            </div>
                                          </div>
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <!-- Repeater Items -->
                                <div class="items" >
                                    <br>
                                    <div class="card border-primary mb-3">
                                        <!-- Repeater Content -->
                                        <div class="item-content card-body block">

                                            <div class="form-group">
                                                <h5  class="col-lg-5 control-label">Question</h5>
                                                <div class="col-lg-12 col-md-9 col-sm-5">
                                                    <input type="text" class="form-control question form-control-lg" placeholder="New question">

                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <h5 for="leftlabel" class="col-lg-6 control-label">Left label</h5>
                                                    <input type="text" class="form-control leftlabel" placeholder="Low" >
                                                </div>
                                                <div class="col">
                                                    <h5 for="rightlabel"  class="col-lg-6 control-label">Right label</h5>
                                                    <input type="text" class="form-control rightlabel" placeholder="High" >
                                                </div>
                                            </div>                            
                                            <br>
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

<div class="modal fade" id="importQuestions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Import questions</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

                <div class="modal-body">
                    <h6>Select the questions</h6>                                                                                
                    <div class="table-responsive">
                        <table id="recent_surveys" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>                                                                        
                                    <th>Label left</th>
                                    <th>Label Right</th>
                                    <th>Max rate</th>
                                    <th>Actions</th> 
                                </tr>
                            </thead>
                            <tbody id="tbodyquestions">                                                                
                            </tbody>
                        </table>
                    </div>                          
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal" id='insertQuestions'>Import questions</button>
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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script>
    $(document).ready(function(){
        
        $('#fetchall').click(function(){
	 fetchModules();         
       });
       
        $('#module_selected').click(function(){
	 fetchQuestions();         
       });

    function fetchModules(){
        
      $.ajax({
        url: '{{route('admin.modules.getmodules')}}',
        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
        type: 'POST',
        dataType: 'json',
        success: function(response){ 
          
        $("#tbody").empty();
          var len = 0;          
          if(response[0].name != null){
            len = 1;
          }         
          if(len > 0){
            i = 0;
            while(response[i].name != null)
            {
              var description = response[i].description;
              var name = response[i].name; 
              var category = response[i].category;
              var id = response[i].id;

              var tr_str = "<tr>" +
                  "<td>" + name + "</td>" +
                  "<td>" + description + "</td>" +
                  "<td>" + category + "</td>" +
                  "<td> <input type='radio' name='import' class='form-check-input' value='"+id+"'></td>" +
              "</tr>";              
              $("#tbody").append(tr_str);
              i++;
            }          
          }else{
             var tr_str = "<tr>" +
                 "<td align='center' colspan='4'>No record found.</td>" +
             "</tr>";

             $("#table tbody").append(tr_str);
          }

        }
      });
    }
    
    function fetchQuestions(){
      var module = $("input[name='import']:checked").val(); 
      if(module != null){
      $.ajax({
        url: "{{route('admin.modules.getquestions')}}",
        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
        type: 'POST',
        data: {module: module},
        dataType: 'json',
        success: function(response){ 
        $("#tbodyquestions").empty();
          var len = 0;          
          if(response[0].name != null){
            len = 1;
          }         
          if(len > 0){
            i = 0;
            while(response[i].name != null)
            {
              var label_left = response[i].label_left;
              var name = response[i].name; 
              var label_right = response[i].label_right;
              var max_rate = response[i].max_rate;
              var id = response[i].id;

              var tr_str = "<tr>" +
                  "<td>" + name + "</td>" +
                  "<td>" + label_left + "</td>" +
                  "<td>" + label_right + "</td>" +
                  "<td>" + max_rate + "</td>" +
                  "<td> <input type='checkbox' name='importQuestions' class='form-check-input' value='"+id+"'></td>" +
              "</tr>";              
              $("#tbodyquestions").append(tr_str);
              i++;
            }          
          }else{
             var tr_str = "<tr>" +
                 "<td align='center' colspan='4'>No record found.</td>" +
             "</tr>";

             $("#table tbody").append(tr_str);
          }
          
         // alert("Questions imported");
        }
      });
      }
      else{
      alert("Select a module");
      }
    }
    
    
    $('#insertQuestions').click(function(){
        
        importQuestions();
       
       });
    
    
    function importQuestions(){
      var questions = [];
            $.each($("input[name='importQuestions']:checked"), function(){            
                questions.push($(this).val());
            });
      if(questions != null){
      $.ajax({
        url: "{{route('admin.modules.importquestions')}}",
        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
        type: 'POST',
        data: {questions: questions},
        dataType: 'json',
        success: function(response){ 
                var i = 0;
                while(response[i].name != null)
                {                   
                    var code = '<br><div class="card border-primary mb-3" id="'+response[i].id+'"><div class="item-content card-body block align-self-lg-auto"><div class="form-group"><h5 for="question" class="col-lg-5 control-label">Question</h5><div class="col-lg-12 col-md-9 col-sm-5"><input type="text" class="form-control question"   value="'+response[i].name+'" ></div></div><div class="row"><div class="col"><h5 for="leftlabel" class="col-lg-6 control-label">Left label</h5><input type="text" id="leftlabel" name="leftlabel" class="form-control leftlabel" value="'+response[i].label_left+'"></div><div class="col"><h5 for="rightlabel"  class="col-lg-6 control-label">Right label</h5><input type="text" id="rightlabel" name="rightlabel" class="form-control rightlabel" value="'+response[i].label_right+'"><br></div></div><div class="row"><div class="col"><div class="form-group"><h5 for="maxmark" class="control-label ">Max value</h5><input type="text" class="form-control maxmark" id="maxmark"  value="'+response[i].max_rate+'"></div></div><div class="col"><div class="form-group"><h5 for="correctans" class="control-label ">Correct answer</h5><input type="text" class="form-control correctans" id="correctans"  value="'+response[i].correct_answer+'"></div></div></div></div><div class="pull-right repeater-remove-btn"><button class="btn btn-danger remove-btn" onclick="rimuovi('+response[i].id+')">Remove question</button></div><div class="clearfix"></div></div>';
                    $("#questions").append(code);
                    i++;
                }
          }
          
         // alert("Questions imported");
        });
      }
      }  
      
    });
    function rimuovi(elemID){
       var element = document.getElementById(elemID);
       element.parentNode.removeChild(element);
    }
    </script>

@endsection
