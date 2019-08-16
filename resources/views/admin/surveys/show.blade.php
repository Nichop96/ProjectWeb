@extends('layouts.admin')

@section('title')
Show Survey
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="statistics-tab" data-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false">Statistics</a>
                        </li>                          
                        <li class="nav-item">
                            <a class="nav-link" id="admin-global-tab" data-toggle="tab" href="#admin-global" role="tab" aria-controls="admin-global" aria-selected="false">Admin Global</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <h4 class="card-title">{{ $survey->name }}</h4>                      
                            <h4 class="card-title">{{ $survey->description }}</h4>                              

                            @foreach($questions as $question)                  
                            <input type="hidden" name='id{{ $loop->iteration }}' value='{{$question->answer_id}}'>
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
                                        @if($j== $question->correct_answer)                                        
                                        <div class="col-2 form-check form-check-success">
                                            <label class="form-check-label">                                    
                                                <input type="radio" class="form-check-input" name="question{{ $loop->iteration }}{{$j}}" value="{{ $j }}" checked>    
                                            </label> 
                                        </div>                                      
                                        @elseif($j== $question->value)
                                        <div class="col-2 form-check">
                                            <label class="form-check-label">                                
                                                <input type="radio" class="form-check-input" name="question{{ $loop->iteration }}{{$j}}" value="{{ $j }}" checked>    
                                            </label> 
                                        </div>
                                        @else
                                        <div class="col-2 form-check">
                                            <label class="form-check-label">                                
                                                <input type="radio" class="form-check-input" name="question{{ $loop->iteration }}{{$j}}" value="{{ $j }}" disabled>    
                                            </label> 
                                        </div>
                                        @endif
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
                        </div>  
                        <div class="tab-pane fade" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                            @foreach($questions as $question)
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $question->name }}</h4>
                                        <canvas id="barChart{{ $loop->iteration }}"></canvas>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>   
                        <div class="tab-pane fade" id="admin-global" role="tabpanel" aria-labelledby="admin-global-tab">
                            <div class="row">
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Number of completed surveys</h4>
                                            <canvas id="surveys"></canvas>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Average score</h4>
                                            <p>50</p>
                                            <h4 class="card-title">Maximum score</h4>
                                            <p>50</p>
                                            <h4 class="card-title">Minimun score</h4>
                                            <p>50</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>                
            </div>
        </div>
    </div>
</div>
<script>

    $(function () {
    /* ChartJS
     * -------
     * Data and config for chartjs
     */
    //Barcharts
    'use strict';
            var backgroundColorOld = [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
            ];
            var borderColorOld = [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
            ];
            var backgroundColor = [
                    'rgba(0,128,0, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
            ];
            var borderColor = [
                    'rgba(0,128,0,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)'
            ];
            var labels = ["1", "2", "3", "4", "5"];
            var label = 'Number of answers';
            var options = {
            scales: {
            yAxes: [{
            ticks: {
            beginAtZero: true
            }
            }]
            },
                    legend: {
                    display: false
                    },
                    elements: {
                    point: {
                    radius: 0
                    }
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
            @foreach($questions as $question)
            var data = {
            labels: labels,
                    datasets: [{
                    label: label,
                            data: [{{$count_answers->count}}],
                            backgroundColor: backgroundColor,
                            borderColor: borderColor,
                            borderWidth: 1,
                            fill: false
                    }]
            };
            // Get context with jQuery - using jQuery's .get() method.
            if ($("#barChart{{ $loop->iteration }}").length) {
    var barChartCanvas = $("#barChart{{ $loop->iteration }}").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
            type: 'bar',
                    data: data,
                    options: options
            });
    }
    @endforeach           



    var doughnutPieData1 = {
    datasets: [{
    data: [30, 40],
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
                    'Completed',
                    'Not completed',
            ]
    };
            var doughnutPieOptions1 = {
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
            if ($("#surveys").length) {
    var surveysCanvas = $("#surveys").get(0).getContext("2d");
            var surveys = new Chart(surveysCanvas, {
            type: 'doughnut',
                    data: doughnutPieData1,
                    options: doughnutPieOptions1
            });
    }
    });

</script>
@endsection

