<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"> Currency - Update </h4>
        </div>
        
 <div class="modal-body"> 
 
 <!-- error div -->
 <div class="alert alert-success success"> </div>
 <div class="alert alert-warning warning"> </div>
 <div class="alert alert-error error"> </div>

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
     
 <!-- form edit -->
 <form id="edit_form_non" data-parsley-validate class="form-horizontal form-label-left" method="POST" 
 action="<?php echo $form_action_update; ?>" enctype="multipart/form-data">
    
    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Name </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="tname_update" class="form-control col-md-7 col-xs-12" type="text" name="tname" required placeholder="Name">
      </div>
    </div>
     
     <div class="form-group">
       <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Account </label>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <table>
            <tr>
        <td> <input id="titem_update" class="form-control col-md-3 col-xs-12" type="text" readonly name="titem" required> </td>
                <td> <?php echo anchor_popup(site_url("account/get_list/titem_update/"), '[ ... ]', $atts1); ?> </td>
            </tr>
        </table>  
      </div>
     </div>
     
     <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Desc </label>
      <div class="col-md-5 col-sm-6 col-xs-12">
        <textarea class="form-control" name="tdesc" id="tdesc_update" rows="2"></textarea>
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