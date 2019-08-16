@extends('layouts.user')

@section('content')
<div class="content-wrapper">
    <div class="mr-md-3 mr-xl-5">
        <h2>Welcome back to your dashboard</h2>
        <p class="mb-md-0">Some useful analytics</p>
    </div>
    <div class="row align-items-center justify-content-center">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">                            
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">New Surveys</small>
                                    <h5 class="mr-2 mb-0">$577545</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-eye mr-3 icon-lg text-success"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Completed surveys</small>
                                    <h5 class="mr-2 mb-0">9833550</h5>
                                </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-download mr-3 icon-lg text-warning"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Total correct answers</small>
                                    <h5 class="mr-2 mb-0">2233783</h5>
                                </div>
                            </div>
                            <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">Total wrong answers</small>
                                    <h5 class="mr-2 mb-0">3497843</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Cash deposits</p>
                    <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to write details</p>
                    <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                    <canvas id="cash-deposits-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection