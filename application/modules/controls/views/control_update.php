<?php
    
$atts1 = array(
	  'class'      => 'btn btn-primary button_inline',
	  'title'      => 'COA - List',
	  'width'      => '600',
	  'height'     => '400',
	  'scrollbars' => 'yes',
	  'status'     => 'yes',
	  'resizable'  => 'yes',
	  'screenx'    =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
	  'screeny'    =>  '\'+((parseInt(screen.height) - 400)/2)+\'',
);

?>


<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"> Control - Update </h4>
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
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Description </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="tdesc_update" class="form-control col-md-1 col-xs-12" type="text" name="tdesc" readonly>
      </div>
    </div>
    
    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Account </label>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <input id="titem_update" class="form-control col-md-3 col-xs-12" type="text" name="titem" required>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
          <?php echo anchor_popup(site_url("account/get_list/titem_update/"), '[ ... ]', $atts1); ?>
      </div>
    </div>
    
    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Modul </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <?php $js = "class='select2_single form-control' id='cmodul_update' tabindex='-1' style='width:100%;' "; 
       echo form_dropdown('cmodul', $modul, isset($default['modul']) ? $default['modul'] : '', $js); ?>
      </div>
    </div>

      <div class="ln_solid"></div>
      <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 btn-group">
          <button type="submit" class="btn btn-primary" id="button">Save</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          </div>
      </div>
  </form> 
  <!-- form edit -->
  
  </div>
 </div>
</div>