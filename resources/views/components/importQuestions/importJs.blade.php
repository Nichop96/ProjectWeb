<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script>
    $(document).ready(function(){
        
        $('#fetchall').click(function(){
	 fetchModules();         
       });
       
        $('#{{$type}}_selected').click(function(){
	 fetchQuestions();         
       });

    function fetchModules(){
        
      $.ajax({
        url: '{{route('admin.'.$type.'s.get'.$type.'s')}}',
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
      var {{$type}} = $("input[name='import']:checked").val(); 
      if({{$type}} != null){
      $.ajax({
        url: "{{route('admin.'.$type.'s.getquestions')}}",
        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
        type: 'POST',
        data: { {{$type}}: {{$type}} },
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
      alert("Select a {{$type}}");
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
        url: "{{route('admin.'.$type.'s.importquestions')}}",
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
                    var code = '<br><div class="card border-primary mb-3"><div class="item-content card-body block align-self-lg-auto"><div class="form-group"><h5 for="question" class="col-lg-5 control-label">Question</h5><div class="col-lg-12 col-md-9 col-sm-5"><input type="text" class="form-control question"   value="'+response[i].name+'" ></div></div><div class="row"><div class="col"><h5 for="leftlabel" class="col-lg-6 control-label">Left label</h5><input type="text" id="leftlabel" name="leftlabel" class="form-control leftlabel" value="'+response[i].label_left+'"></div><div class="col"><h5 for="rightlabel"  class="col-lg-6 control-label">Right label</h5><input type="text" id="rightlabel" name="rightlabel" class="form-control rightlabel" value="'+response[i].label_right+'"><br></div></div><div class="row"><div class="col"><div class="form-group"><h5 for="maxmark" class="control-label ">Max value</h5><input type="text" class="form-control maxmark" id="maxmark"  value="'+response[i].max_rate+'"></div></div><div class="col"><div class="form-group"><h5 for="correctans" class="control-label ">Correct answer</h5><input type="text" class="form-control correctans" id="correctans"  value="'+response[i].correct_answer+'"></div></div></div></div><div class="pull-right repeater-remove-btn"><button class="btn btn-danger remove-btn" onclick="rimuovi('+response[i].id+')">Remove question</button></div><div class="clearfix"></div></div>';
                    $("#questions").append(code);
                    i++;
                }
          }
          
         // alert("Questions imported");
        });
      }
      }  
      
    });
    </script>