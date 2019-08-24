@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
        <h1 class=" text-primary">Welcome to your dashboard</h1>
        <br>
        <h3 class="mb-md-0">Some useful analytics:</h3>
    </div>
    <br>
    <div class="row align-items-center justify-content-center">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">                            
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-flag mr-3 icon-lg text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Modules</small>
                                    <h5 class="mr-2 mb-0">{{$modules_count}}</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-comment-question-outline mr-3 icon-lg text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Surveys</small>
                                    <h5 class="mr-2 mb-0">{{$surveys_count}}</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-sort-variant mr-3 icon-lg text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Groups</small>
                                    <h5 class="mr-2 mb-0">{{$group_count}}</h5>
                                </div>
                            </div>
                            <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-eye mr-3 icon-lg text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Users</small>
                                    <h5 class="mr-2 mb-0">{{$users_count}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h4>Total correct answers:</h4>
                    <br>
                    <canvas id="correctAnswers"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h4>Surveys for each category:</h4>
                    <br>
                    <canvas id="surveys_category"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 stretch-card">
          <div class="card border-primary mb-3">
            <div class="card-body">
              <h4>Recent Surveys</h4>
              <div class="table-responsive">
                <table id="recent_surveys" class="table">
                  <thead>
                    <tr>
                        <th class="text-primary">Name</th>
                        <th class="text-primary">Description</th>
                        <th class="text-primary">Category</th>                        
                        <th class="text-primary">Date</th>                        
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($surveys as $survey)
                    <tr>
                        <td>{{$survey->name}}</td>
                        <td>{{$survey->description}}</td>
                        <td>{{$survey->category}}</td>
                        <td>{{date('d/m/Y',strtotime($survey->created_at))}}</td>                        
                    </tr> 
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
 $(function () {
     
     'use strict'; 
     
    var doughnutPieData = {
            datasets: [{
            data: [{{$correctAnswers}}, {{$wrongAnswers}}],
                    backgroundColor: [
                            'rgba(0,128,0, 0.5)',
                            'rgba(255,0,0, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                            'rgba(0,128,0,1)',
                            'rgba(255,0,0, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                    ],
            }],
                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                            'Correct',
                            'Wrong',
                    ]
            };
            var doughnutPieOptions = {
            responsive: true,
                    animation: {
                    animateScale: true,
                            animateRotate: true
                    },
                    tooltips: {
                    callbacks: {
                    label: function(tooltipItem, data) {
                    //get the concerned dataset
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                            //calculate the total of this data set
                            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                            });
                            //get the current items value
                            var currentValue = dataset.data[tooltipItem.index];
                            //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return "#" + currentValue + "   " + percentage + "%";
                    }
                    }
                    }
            };
            if ($("#correctAnswers").length) {
            var correctAnswersCanvas = $("#correctAnswers").get(0).getContext("2d");
            var correctAnswers = new Chart(correctAnswersCanvas, {
            type: 'doughnut',
                    data: doughnutPieData,
                    options: doughnutPieOptions
            });
    }
    
    
    
     var doughnutPieData = {
            datasets: [{
            data: [@foreach ($surveys_category as $survey_category) {{$survey_category->count}} , @endforeach],
                    backgroundColor: [                           
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                             'rgba(0,128,0, 0.5)',
                            'rgba(255,0,0, 0.5)',
                    ],
                    borderColor: [                            
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(0,128,0,1)',
                            'rgba(255,0,0, 1)',
                    ],
            }],
                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                            @foreach ($surveys_category as $survey_category) '{{$survey_category->name}}' , @endforeach
                    ]
            };
            var doughnutPieOptions = {
            responsive: true,
                    animation: {
                    animateScale: true,
                            animateRotate: true
                    },
                    tooltips: {
                    callbacks: {
                    label: function(tooltipItem, data) {
                    //get the concerned dataset
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                            //calculate the total of this data set
                            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                            });
                            //get the current items value
                            var currentValue = dataset.data[tooltipItem.index];
                            //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return "#" + currentValue + "   " + percentage + "%";
                    }
                    }
                    }
            };
            if ($("#surveys_category").length) {
            var surveys_categoryCanvas = $("#surveys_category").get(0).getContext("2d");
            var surveys_category = new Chart(surveys_categoryCanvas, {
            type: 'doughnut',
                    data: doughnutPieData,
                    options: doughnutPieOptions
            });
    }
    
    });
</script> 
<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>

@endsection
