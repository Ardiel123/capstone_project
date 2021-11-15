  <!-- Modal Alert-->
  <div class="modal fade" id="nothing" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Failed</h4>
        </div>
        <div class="modal-body">
          <p>You selected nothing!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--end of modal-->

  <!-- Modal Alert-->
  <div class="modal fade" id="success" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Successfull</h4>
        </div>
        <div class="modal-body">
          <p><?php echo $success_message; ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload()">Ok</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--end of modal-->

  <!-- Modal Alert-->
  <div class="modal fade" id="fail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Failed</h4>
        </div>
        <div class="modal-body">
          <p><?php echo $fail_message; ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--end of modal-->