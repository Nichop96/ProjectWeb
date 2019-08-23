@extends('layouts.user')

@section('content')
<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
        <h1 class=" text-primary">Welcome to your dashboard</h1>
        <br>
        <h3 class="mb-md-0">Some useful analytics:</h3>
        <br>
    </div>
    <div class="row align-items-center justify-content-center">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">                            
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-comment-question-outline mr-3 icon-lg text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">New Surveys</small>
                                    <h5 class="mr-2 mb-0">{{$surveys_count}}</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-eye mr-3 icon-lg text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Completed surveys</small>
                                    <h5 class="mr-2 mb-0">{{$completedSurveys_count}}</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-flag mr-3 icon-lg text-success"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Total correct answers</small>
                                    <h5 class="mr-2 mb-0">{{$correctAnswers}}</h5>
                                </div>
                            </div>
                            <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Total wrong answers</small>
                                    <h5 class="mr-2 mb-0">{{$wrongAnswers}}</h5>
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
                    <canvas id="correctAnswers"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h4>Completed survey for each category:</h4>
                    <canvas id="surveys_category"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card border-primary mb-3">
              <div class="card-body">
                <h4>Percentage of correct answers in the completed surveys:</h4>
                <canvas id="areaChart"></canvas>
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
    
    
    var areaData = {
    labels: [@foreach ($completedSurveys as $completedSurvey) '{{$completedSurvey->name}}' , @endforeach],
    datasets: [{
      label: '% of correct answers',
      data: [@foreach ($completedSurveys as $completedSurvey) {{$completedSurvey->percentage}} , @endforeach],
      backgroundColor: [        
        'rgba(54, 162, 235, 0.2)',        
      ],
      borderColor: [        
        'rgba(54, 162, 235, 1)',
             ],
      borderWidth: 1,
      fill: true, // 3: no fill
    }]
  };
  
  var areaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    }
  }
  
   if ($("#areaChart").length) {
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    var areaChart = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaData,
      options: areaOptions
    });
  }
    
    });
</script>    
@endsection