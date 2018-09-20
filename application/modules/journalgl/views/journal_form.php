 <!-- Datatables CSS -->
<link href="<?php echo base_url(); ?>js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/icheck/flat/green.css" rel="stylesheet" type="text/css">

<!-- Date time picker -->
 <script type="text/javascript" src="http://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
 <!-- Include Date Range Picker -->
<script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<style type="text/css">
  a:hover { text-decoration:none;}
</style>

<script src="<?php echo base_url(); ?>js/moduljs/journal.js"></script>
<script src="<?php echo base_url(); ?>js-old/register.js"></script>

<script type="text/javascript">

	var sites_add  = "<?php echo site_url('journalgl/add_process/');?>";
	var sites_edit = "<?php echo site_url('journalgl/update_process/');?>";
	var sites_del  = "<?php echo site_url('journalgl/delete/');?>";
	var sites_get  = "<?php echo site_url('journalgl/update/');?>";
    var sites  = "<?php echo site_url('journalgl/');?>";
	var source = "<?php echo $source;?>";
	
</script>

          <div class="row"> 
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" >
              
              <!-- xtitle -->
              <div class="x_title">
              
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
                </ul>
                
                <div class="clearfix"></div>
              </div>
              <!-- xtitle -->
                
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
  
  <div id="step-1">
    <!-- form -->
    <form id="journalformdata" data-parsley-validate class="form-horizontal form-label-left" method="POST" 
    action="<?php echo $form_action; ?>" >
		
    <style type="text/css">
       .xborder{ border: 1px solid red;}
       #custtitlebox{ height: 90px; background-color: #E0F7FF; border-top: 3px solid #2A3F54; margin-bottom: 10px; }
        #amt{ color: #000; margin-top: 35px; text-align: right; font-weight: bold;}
        #amt span{ color: blue;}
        .labelx{ font-weight: bold; color: #000;}
        #table_summary{ font-size: 12px; color: #000;}
        .amt{ text-align: right;}
    </style>

<!-- form atas   -->
    <div class="row">
       
<!-- div untuk customer place  -->
       <div id="custtitlebox" class="col-md-12 col-sm-12 col-xs-12">
            
           <div class="form-group">
               
               <div class="col-md-3 col-sm-12 col-xs-12">
                   <label class="control-label labelx"> Code - No </label> <br>
         <select name="ctype" id="ctype" class="form-control" style="width:100px; float:left; margin-right:10px;">
<option value="GJ"<?php echo set_select('ctype', 'GJ', isset($default['type']) && $default['type'] == 'GJ' ? TRUE : FALSE); ?>> GJ </option>
<option value="AJE"<?php echo set_select('ctype', 'AJE', isset($default['type']) && $default['type'] == 'AJE' ? TRUE : FALSE); ?>> AJE </option>
         </select>
     <input type="number" name="tno" id="tno" class="form-control" style="width:80px;" value="<?php echo $counter; ?>">           
               </div>
               
               <div class="col-md-2 col-sm-12 col-xs-12">
                   <label class="control-label labelx"> Currency </label>
         <?php  $js = "class='form-control' id='ccurrency' tabindex='-1' style='width:120px; float:left; margin-right:10px;' ";
	     echo form_dropdown('ccurrency', $currency, isset($default['currency']) ? $default['currency'] : '', $js); ?>
               </div>
               
               <div class="col-md-2 col-sm-12 col-xs-12">
                   <label class="control-label labelx"> Transaction Date </label>
           <input type="text" title="Date" class="form-control" id="ds1" name="tdate" required
           value="<?php echo isset($default['dates']) ? $default['dates'] : '' ?>" /> 
               </div>
               
               
               <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-1">
                   <h2 id="amt"> Total Amount : <span class="amt"> <?php echo isset($total) ? idr_format($total) : '0'; ?> </span>,- </h2>
               </div>
               
           </div>
           
       </div>
<!-- div untuk customer place  -->

<!-- div alamat penagihan -->
       <div class="col-md-4 col-sm-12 col-xs-12">
           <div class="col-md-12 col-sm-12 col-xs-12">
              <label class="control-label labelx"> Note </label>
<input type="text" class="form-control" name="tnote" id="tnote" value="<?php echo isset($default['note']) ? $default['note'] : '' ?>">
           </div>
       </div>
<!-- div alamat penagihan -->

<!-- div tgl transaksi -->
    <div class="col-md-4 col-sm-12 col-xs-12">
       
       <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> Description </label>
          <textarea id="" name="tdesc" style="width:100%;" rows="3"><?php echo isset($default['desc']) ? $default['desc'] : '' ?></textarea>
       </div> 
        
    </div>
<!-- div tgl transaksi -->
        
<!-- div no transaksi -->
  <div class="col-md-3 col-sm-12 col-xs-12">
       
      <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> Document No </label>
          <input type="text" title="Document No" class="form-control" name="tdocno" value="<?php echo isset($default['docno']) ? $default['docno'] : '' ?>" /> 
       </div>  
  </div>
<!-- div no transaksi -->

</div>
<!-- form atas   -->
      
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-4 col-sm-3 col-xs-12 col-md-offset-9">
          <div class="btn-group">    
          <button type="submit" class="btn btn-success" id="button"> Save </button>
          <button type="reset" class="btn btn-danger" id=""> Cancel </button>
          <a class="btn btn-primary" href="<?php echo site_url('journalgl/add/'); ?>"> New Transaction </a>
          </div>
        </div>
      </div>
      
	</form>
      
    <!-- end div layer 1 -->
      
<!-- form transaction table  -->
      
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    
 <!-- searching form -->
           
   <form id="ajaxtransform" class="form-inline" method="post" action="<?php echo $form_action_item; ?>">
      <div class="form-group">
        <label class="control-label labelx"> Account </label> <br>
           <input id="titem" class="form-control col-md-3 col-xs-12" type="text" readonly name="titem" required>
          <?php echo anchor_popup(site_url("account/get_list/"), '[ ... ]', $atts1); ?>
          &nbsp;
      </div>

      <div class="form-group">
        <label class="control-label labelx"> Debit </label> <br>
        <input type="number" name="tdebit" class="form-control" style="width:120px;" maxlength="10" required value="0"> &nbsp;
      </div>
      
      <div class="form-group">
        <label class="control-label labelx"> Credit </label> <br>
        <input type="number" name="tcredit" id="tredit" class="form-control" style="width:120px;" maxlength="10" required value="0"> &nbsp;
      </div>

      <div class="form-group"> <br>
       <button type="submit" class="btn btn-primary button_inline"> Post </button>
       <button type="button" onClick="load_data();" class="btn btn-danger button_inline"> Reset </button>
      </div>
  </form> <br>


   <!-- searching form --> 
        
    </div>
    
<!-- table -->
  <div class="col-md-12 col-sm-12 col-xs-12">  
    <div class="table-responsive">
      <table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th class="column-title"> No </th>
            <th class="column-title"> Account </th>
            <th class="column-title"> Debit </th>
            <th class="column-title"> Credit </th>
            <th class="column-title no-link last"><span class="nobr">Action</span>
            </th>
            <th class="bulk-actions" colspan="7">
              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
            </th>
          </tr>
        </thead>

        <tbody>
            
        <?php
            
            function account($val)
            {
                $acc = new Account_lib();
                return $acc->get_name($val);
            }
            
            if ($items)
            {
                $i=1;
                foreach($items as $res)
                {
                    echo "
                     <tr class=\"even pointer\">
                        <td> ".$i." </td>
                        <td>".account($res->account_id)." </td>
                        <td class=\"a-right a-right \"> ".idr_format($res->debit)." </td>
                        <td class=\"a-right a-right \"> ".idr_format($res->credit)." </td>
<td class=\" last\"> 
<a class=\"btn btn-danger btn-xs text-remove\" id=\"".$res->id."\"> <i class=\"fa fas-2x fa-trash\"> </i> </a> 
</td>
                      </tr>
                    "; $i++;
                }
            }
            
        ?> 

        </tbody>
      </table>
    </div>
    </div>
<!-- table -->
    
<!-- kolom total -->
    <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-8">
        
        <table id="table_summary" style="width:100%;">
            <tr> 
                <td> Debit : <br> <input type="text" class="form-control" readonly style="width:150px;" value="<?php echo isset($debit) ? idr_format($debit) : '0'; ?>"> </td>
                <td> Credit : <br> <input type="text" class="form-control" readonly style="width:150px;" value="<?php echo isset($credit) ? idr_format($credit) : '0'; ?>"> </td>
            </tr>
            <tr> 
                <td> <br> Balance : <br> <input type="text" class="form-control" readonly style="width:150px;" value="<?php echo isset($balance) ? idr_format($balance) : '0'; ?>"> </td>
            </tr>
        </table>
        
    </div>
<!-- kolom total -->
    
</div>
<!-- form transaction table  -->  
        
  </div>
                  
     </div>
       
       <!-- links -->
       <?php if (!empty($link)){foreach($link as $links){echo $links . '';}} ?>
       <!-- links -->
                     
    </div>
  </div>
      
      <script src="<?php echo base_url(); ?>js/icheck/icheck.min.js"></script>
      
       <!-- Datatables JS -->
        <script src="<?php echo base_url(); ?>js/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/responsive.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/dataTables.scroller.min.js"></script>
        <script src="<?php echo base_url(); ?>js/datatables/dataTables.tableTools.js"></script>
    
    <!-- jQuery Smart Wizard -->
    <script type="text/javascript" src="<?php echo base_url(); ?>js/wizard/jquery.smartWizard.js"></script>
        
        <!-- jQuery Smart Wizard -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });

      });
    </script>
    <!-- /jQuery Smart Wizard -->
    
    
