<div class="modal-dialog">
        
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"> Edit - Airline </h4>
</div>
<div class="modal-body">

 <!-- error div -->
 <div class="alert alert-success success"> </div>
 <div class="alert alert-warning warning"> </div>
 <div class="alert alert-error error"> </div>
 
 <!-- form add -->
<div class="x_panel" >

<div class="x_content">

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

 <form id="edit_form_non" data-parsley-validate class="form-horizontal form-label-left" method="POST" 
 action="<?php echo $form_action_update; ?>" enctype="multipart/form-data">
    
      <div class="col-md-11 col-sm-9 col-xs-12 form-group"> <br>
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Code </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" class="form-control" id="tcode_update" name="tcode" readonly>
        </div>
      </div>
    
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Region </label>
        <div class="col-md-6 col-sm-6 col-xs-12">    
           <select class="form-control" id="cregion_update" name="cregion">
               <option value="0"> Domestic </option>
               <option value="1"> International </option>
               <option value="2"> Domestic &amp; International </option>
           </select>
        </div>
      </div>
      
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Type </label>
        <div class="col-md-6 col-sm-6 col-xs-12">    
           <select class="form-control" id="cregion_update" name="ctype">
               <option value="DEPOSIT"> Deposit </option>
               <option value="REGULAR"> Regular </option>
           </select>
        </div>
      </div>		
      
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Account </label>
        <div class="col-md-4 col-sm-4 col-xs-12">   
          <table>
              <tr>
<td> <input id="titem_update" class="form-control col-md-3 col-xs-12" type="text" readonly name="titem" required> </td>
<td> <?php echo anchor_popup(site_url("account/get_list/titem_update"), '[ ... ]', $atts1); ?> </td>
              </tr>
          </table> 
        </div>
      </div>		
    
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <input type="text" class="form-control has-feedback-left" id="tname_update" name="tname" required placeholder="Name">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> 
      </div>
      
      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
        <textarea class="form-control" name="tdesc" id="tdesc_update" rows="2" placeholder="Description"></textarea>
      </div>
          
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 btn-group">
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