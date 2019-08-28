<button class="btn btn-primary mt-3" data-toggle="modal" data-target="#select{{ $type}}" id="fetchall">
    Import questions
</button>
<div class="modal fade" id="select{{ $type}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import questions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                                            
            <div class="modal-body">
                <h6>Select a {{ $type}} of wich you want to take some questions</h6>                                                                                                            
                <div class="table-responsive">
                    <table id="questions" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>                               
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#importQuestions" id='{{ $type}}_selected'>Select {{ $type}}</button>
            </div>
        </div>
    </div>
</div>