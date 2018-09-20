<div class="modal-dialog">
        
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"> Add New Transaction </h4>
</div>
<div class="modal-body">
 
 <!-- error div -->
 <div class="alert alert-success success"> </div>
 <div class="alert alert-warning warning"> </div>
 <div class="alert alert-error error"> </div>
 
 <!-- form add -->
<div class="x_panel" >
<div class="x_title">
  
  <div class="clearfix"></div> 
</div>
<div class="x_content">

<form id="upload_form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $form_action; ?>" 
      enctype="multipart/form-data">
     
    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> No - TR-00 </label>
      <div class="col-md-3 col-sm-6 col-xs-12">
<input id="tno" class="form-control col-md-3 col-xs-12" type="number" name="tno" value="<?php echo $code; ?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Date </label>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <input id="ds2" class="form-control col-md-4 col-xs-12" type="text" name="tdate" required placeholder="Date">
      </div>
    </div>

      <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Currency </label>
          <div class="col-md-4 col-sm-4 col-xs-12">
              
             <?php $js = "class='form-control' id='ccurrency' tabindex='-1' style='width:100%;' "; 
			 echo form_dropdown('ccurrency', $currency, isset($default['currency']) ? $default['currency'] : '', $js); ?>
          </div>
      </div>

    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Note </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea id="tnote" name="tnote" rows="2" class="form-control"></textarea>
      </div>
    </div>
    
      <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> From </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <?php $js = "class='form-control' id='cfrom' tabindex='-1' style='width:100%;' "; 
			 echo form_dropdown('cfrom', $account, isset($default['from']) ? $default['from'] : '', $js); ?>
          </div>
      </div>
    
     <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> To </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <?php $js = "class='form-control' id='cfrom' tabindex='-1' style='width:100%;' "; 
			 echo form_dropdown('cto', $account, isset($default['to']) ? $default['to'] : '', $js); ?>
          </div>
      </div>
    
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Amount </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input id="tamount" class="form-control col-md-6 col-xs-12" type="number" name="tamount" placeholder="Amount">
        </div>
      </div>


      <div class="ln_solid"></div>
      <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 btn-group">
          <button type="submit" class="btn btn-primary" id="button">Save</button>
          <button type="button" id="bclose" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="reset" id="breset" class="btn btn-warning">Reset</button>
          </div>
      </div>
  </form> 

</div>
</div>
<!-- form add -->

</div>
    <div class="modal-footer"> </div>
</div>
  
</div>