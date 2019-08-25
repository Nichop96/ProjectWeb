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
                        <table id="questions" class="table">
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