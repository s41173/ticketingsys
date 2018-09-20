<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"> Opening Balance - Update </h4>
        </div>
        
 <div class="modal-body"> 
 
 <!-- error div -->
 <div class="alert alert-success success"> </div>
 <div class="alert alert-warning warning"> </div>
 <div class="alert alert-error error"> </div>

 <!-- form edit -->
 <form id="edit_form_non" data-parsley-validate class="form-horizontal form-label-left" method="POST" 
 action="<?php echo $form_action_update; ?>" enctype="multipart/form-data">
     
    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Code </label>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <input id="tcode_update" class="form-control col-md-1 col-xs-12" type="text" name="tcode" readonly>
      </div>
    </div>
    
    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Account </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="tname_update" class="form-control col-md-1 col-xs-12" type="text" name="tname" readonly>
      </div>
    </div>
    
    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Balance </label>
      <div class="col-md-5 col-sm-6 col-xs-12">
          <input id="tbalance_update" class="form-control col-md-1 col-xs-12" type="number" name="tbalance">
      </div>
    </div>

      <div class="ln_solid"></div>
      <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="submit" class="btn btn-primary" id="button">Save</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          </div>
      </div>
  </form> 
  <!-- form edit -->
  
  </div>
 </div>
</div>