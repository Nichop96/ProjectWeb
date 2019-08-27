<div class="col-lg-3 col-md-3 col-sm-1 grid-margin stretch-card">            
    <div class="card border-primary mb-3">
        <div height="120px">
            {{$image}}            
        </div>
        <div class="card-body" >   
            <div class="row">
                <div class="col-10">
                    <h4>{{$name}}</h4>                    
                </div>
                <div class="col-2">

                    <div class="btn-group">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-menu text-primary menu-icon " style="font-size:1.5em;"></i>
                        </a>

                        <div class="dropdown-menu">
                            {{$buttons}}                            
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>
</div>