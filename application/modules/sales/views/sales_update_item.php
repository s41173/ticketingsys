<div class="modal-dialog">
        
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"> Edit - Sales Order Update </h4>
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

 <form id="edit_ajax_item" data-parsley-validate class="form-horizontal form-label-left" method="POST" 
 action="<?php echo site_url('sales/update_item_process'); ?>" enctype="multipart/form-data">
    
      <div class="col-md-11 col-sm-9 col-xs-12 form-group"> <br>
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Passenger </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <table>
                 <tr>
             <td>
                <input type="hidden" id="tid" name="tid">
                <input type="hidden" id="tsid" name="tsid">
                <textarea class="form-control col-md-3 col-xs-12" id="tpassenger_update" name="tpassenger"></textarea> 
             </td>
                 </tr>
                 <tr>
             <td>
                 <input type="text" class="form-control" id="tidcard_update" name="tidcard" style="margin-top:5px;">
             </td>
                 </tr>
             </table>
        </div>
      </div>
    
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Departed </label>
        <div class="col-md-6 col-sm-6 col-xs-12">    
             <table>
                 <tr>
             <td> <?php $js = "class='form-control' id='cdepart_update' tabindex='-1' style='width:240px;' "; 
             echo form_dropdown('cdepart', $airport, isset($default['depart']) ? $default['depart'] : '', $js); ?> </td>
                 </tr>
                 <tr>
             <td> <textarea class="form-control" name="tdepartdesc" id="tdepartdesc_update" placeholder="Departed Description" style="margin-top:5px; width:240px;"></textarea> </td>
                 </tr>
             </table>
        </div>
      </div>
      
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Arrived </label>
        <div class="col-md-6 col-sm-6 col-xs-12">    
            <table style="margin-right:5px;">
                 <tr>
<td> <?php $js = "class='form-control' id='carrived_update' tabindex='-1' style='width:240px;' "; 
             echo form_dropdown('carrived', $airport, isset($default['arrived']) ? $default['arrived'] : '', $js); ?> </td>
                 </tr>
                 <tr>
<td> <textarea class="form-control" name="tarriveddesc" id="tarriveddesc_update" placeholder="Arrived Description" style="margin-top:5px; width:240px;"></textarea> </td>
                 </tr>
            </table>
        </div>
      </div>
      
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Depart Date / Return </label>
        <div class="col-md-6 col-sm-6 col-xs-12">    
            <table>
                 <tr>
             <td> <input type="text" title="Date" class="form-control" id="ds3_update" name="tdepartdates" required style="width:170px"
             value="<?php echo isset($default['dates']) ? $default['dates'] : '' ?>" />
                <input type="checkbox" name="ckreturn" id="ckreturn_update" value="1"> <small> Return </small>
                 </td>
                 </tr>
                 <tr>
             <td> <input type="text" title="Date" class="form-control" id="ds4_update" name="tarrivedates" required disabled style="width:170px; margin-top:5px;"
             value="<?php echo isset($default['dates']) ? $default['dates'] : '' ?>" /> </td>
                 </tr>
             </table>
        </div>
      </div>
      
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Airline &amp; Booking Code </label>
        <div class="col-md-4 col-sm-4 col-xs-12">    
            <table>
        <tr>
         <td> <?php $js = "class='form-control' id='cairline_update' tabindex='-1' style='width:240px;' "; 
	       echo form_dropdown('cairline', $airline, isset($default['airline']) ? $default['airline'] : '', $js); ?> &nbsp; </td>
        </tr>
        <tr>
         <td> 
          <input type="text" class="form-control" name="tbook" id="tbook_update" placeholder="Booking Code" style="width:240px; padding-top:5px;">
          &nbsp; </td>
        </tr>
        <tr>
         <td> 
         <?php $js = "class='select2_single form-control' id='cvendor_update' tabindex='-1' style='width:240px;' "; 
	     echo form_dropdown('cvendor', $vendor, isset($default['vendor']) ? $default['vendor'] : '', $js); ?>
         </td>
        </tr>
        </table>
        </div>
      </div>	
      
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Ticket No </label>
        <div class="col-md-4 col-sm-4 col-xs-12">   
<input type="text" name="tticketno" id="tticketno_update" class="form-control" style="width:150px;" required value="0">  
        </div>
      </div>			
      
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Capital </label>
        <div class="col-md-4 col-sm-4 col-xs-12">   
<input type="text" name="tcapital" id="tcapital_update" class="form-control" style="width:150px;" required value="0">  
        </div>
      </div>	
      
      <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Price </label>
        <div class="col-md-4 col-sm-4 col-xs-12">   
<input type="text" name="tprice" id="tprice_update" class="form-control" style="width:150px;" required value="0">  
        </div>
      </div>	
      
       <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Discount </label>
        <div class="col-md-4 col-sm-4 col-xs-12">   
<input type="text" name="tdiscount" id="tdiscount_update" class="form-control" style="width:150px;" required value="0">  
        </div>
      </div>	
      
       <div class="col-md-11 col-sm-9 col-xs-12 form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Tax </label>
        <div class="col-md-4 col-sm-4 col-xs-12">   
 <?php $js = "class='form-control' id='ctax_update' tabindex='-1' style='width:90px;' "; 
	   echo form_dropdown('ctax', $tax, isset($default['tax']) ? $default['tax'] : '', $js); ?>
    <input type="number" name="ttax" id="ttax" class="form-control" style="width:110px;" maxlength="8" readonly value="0"> &nbsp;
        </div>
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