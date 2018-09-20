<div class="modal-dialog">
        
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"> Add New Product </h4>
</div>
<div class="modal-body">

 <!-- error div -->
 <div class="alert alert-success success"> </div>
 <div class="alert alert-warning warning"> </div>
 <div class="alert alert-error error"> </div>
 
 <!-- form add -->
<div class="x_panel" >

<div class="x_content">

<form id="upload_form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $form_action; ?>" 
enctype="multipart/form-data">
   					
      <div class="col-md-12 col-sm-12 col-xs-12 form-group">  
        <input type="text" class="form-control has-feedback-left" id="tsku" required name="tsku" placeholder="SKU">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> 
      </div>
        
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" class="form-control has-feedback-left" id="tname" name="tname" required placeholder="Name">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> 
      </div>
      
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
   <input type="text" class="form-control has-feedback-left" id="tmodel" name="tmodel" required placeholder="Model">
   <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> 
      </div>
      
      <!-- pembatas div -->
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
      </div>
       <!-- pembatas div -->
      
      
      <div class="col-md-9 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Category </label>
        <div class="col-md-9 col-sm-9 col-xs-12">

        </div>
      </div>
      
      <div class="col-md-9 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Manufacture </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        </div>
      </div>
      
      <div class="col-md-9 col-sm-9 col-xs-12 form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Image </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="file" id="uploadImage" accept="image/*" class="input-medium" title="Upload" name="userfile" /> <br>
          <img id="catimg" style=" max-width:100px; height:auto;">
      </div>
      </div>
      <div class="clearfix"></div> 
      
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <button type="submit" class="btn btn-primary" id="button">Save</button>
          <button type="button" id="bclose" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" id="breset" class="btn btn-warning" onClick="reset();">Reset</button>
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