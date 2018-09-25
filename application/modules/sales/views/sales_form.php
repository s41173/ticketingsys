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

<script src="<?php echo base_url(); ?>js/moduljs/sales.js"></script>
<script src="<?php echo base_url(); ?>js-old/register.js"></script>

<script type="text/javascript">

	var sites_add  = "<?php echo site_url('sales/add_process/');?>";
	var sites_edit = "<?php echo site_url('sales/update_process/');?>";
	var sites_del  = "<?php echo site_url('sales/delete/');?>";
	var sites_get  = "<?php echo site_url('sales/update/');?>";
    var sites_get_item  = "<?php echo site_url('sales/update_item/');?>";
    var sites  = "<?php echo site_url('sales');?>";
	var source = "<?php echo $source;?>";
    var url  = "<?php echo $graph;?>";
	
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
                    
<!--
  <div id="errors" class="alert alert-danger alert-dismissible fade in" role="alert"> 
     <?php // $flashmessage = $this->session->flashdata('message'); ?> 
	 <?php // echo ! empty($message) ? $message : '' . ! empty($flashmessage) ? $flashmessage : ''; ?> 
  </div>
-->
  
  <div id="step-1">
    <!-- form -->
    <form id="salesformdata" data-parsley-validate class="form-horizontal form-label-left" method="POST" 
    action="<?php echo $form_action; ?>" 
      enctype="multipart/form-data">
		
    <style type="text/css">
       .xborder{ border: 1px solid red;}
       #custtitlebox{ height: 90px; background-color: #E0F7FF; border-top: 3px solid #2A3F54; margin-bottom: 10px; }
        #amt{ color: #000; margin-top: 35px; text-align: right; font-weight: bold;}
        #amt span{ color: blue;}
        .labelx{ font-weight: bold; color: #000;}
        #table_summary{ font-size: 16px; color: #000;}
        .amt{ text-align: right;}
    </style>

<!-- form atas   -->
    <div class="row">
       
<!-- div untuk customer place  -->
       <div id="custtitlebox" class="col-md-12 col-sm-12 col-xs-12">
            
           <div class="form-group">
               
               <div class="col-md-3 col-sm-12 col-xs-12">
                   <label class="control-label labelx"> * Customer </label>

         <?php $js = "class='select2_single form-control' id='ccustomer' tabindex='-1' style='min-width:150px;' "; 
	     echo form_dropdown('ccustomer', $customer, isset($default['customer']) ? $default['customer'] : '', $js); ?>
               </div>
               
               <div class="col-md-3 col-sm-12 col-xs-12 col-md-offset-1">
                   <label class="control-label labelx"> Email </label>
                   <input type="email" class="form-control" id="temail" required name="temail" readonly value="<?php echo isset($default['email']) ? $default['email'] : '' ?>" >
               </div>
               
               <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-1">
                   <h2 id="amt"> Total Amount : Rp. <span class="amt"> <?php echo isset($default['total']) ? idr_format($default['total']) : '0'; ?> </span>,- </h2>
               </div>
               
           </div>
           
       </div>
<!-- div untuk customer place  -->

<!-- div tgl transaksi -->
    <div class="col-md-2 col-sm-12 col-xs-12">
       
       <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> Transaction Date </label>
          <input type="text" title="Date" class="form-control" id="ds1" name="tdates" required
           value="<?php echo isset($default['dates']) ? $default['dates'] : '' ?>" /> 
       </div>
        
        <!-- due date    -->
       <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> Due Date </label>
          <input type="text" title="Due Date" class="form-control" id="ds2" name="tduedates" required 
           value="<?php echo isset($default['due_date']) ? $default['due_date'] : '' ?>" /> 
       </div>    
        
    </div>
<!-- div tgl transaksi -->
        
<!-- div no transaksi -->
  <div class="col-md-2 col-sm-12 col-xs-12">
       
      <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> Trans Code </label>
          <input type="text" title="Trans Code" class="form-control" readonly name="tcode" value="<?php echo $code; ?>" /> 
       </div>  
      
      <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> Payment Type </label>
          <?php $js = "class='form-control' id='cpayment' tabindex='-1' style='min-width:150px;' "; 
	      echo form_dropdown('cpayment', $payment, isset($default['payment']) ? $default['payment'] : '', $js); ?>
      </div>  
        
  </div>
<!-- div no transaksi -->
        
<!-- div landed cost -->
  <div class="col-md-2 col-sm-12 col-xs-12">
       
      <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> Landed Cost </label>
          <input type="number" title="Landed Cost" class="form-control" name="tcosts" value="<?php echo isset($default['costs']) ? $default['costs'] : '0' ?>" /> 
      </div> 
       
      <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> COA </label>
          <?php $js = "class='form-control' id='caccount' tabindex='-1' style='min-width:250px;' disabled "; 
	      echo form_dropdown('caccount', $account, isset($default['account']) ? $default['account'] : '', $js); ?>
      </div>  
        
  </div>
<!-- div landed cost -->

<!-- div landed cost -->
  <div class="col-md-2 col-sm-12 col-xs-12">
      
      <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="control-label labelx"> Total Discount </label>
          <input type="number" title="Landed Cost" class="form-control" name="ttotal_discount" readonly value="<?php echo isset($default['discount']) ? $default['discount'] : '0' ?>" /> 
      </div>  
        
  </div>
<!-- div landed cost -->

</div>
<!-- form atas   -->
      
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-9">
          <div class="btn-group">    
          <button type="submit" class="btn btn-success" id="button"> Save </button>
          <button type="reset" class="btn btn-danger" id=""> Cancel </button>
          <a class="btn btn-primary" href="<?php echo site_url('sales/add/'); ?>"> New Transaction </a> 
          </div>
        </div>
      </div>
      
	</form>
      
    <!-- end div layer 1 -->
      
<!-- form transaction table  -->
 
                    
<?php
                        
$atts2 = array(
	  'class'      => 'btn btn-primary button_inline',
	  'title'      => 'Product',
	  'width'      => '800',
	  'height'     => '600',
	  'scrollbars' => 'yes',
	  'status'     => 'yes',
	  'resizable'  => 'yes',
	  'screenx'    =>  '\'+((parseInt(screen.width) - 800)/2)+\'',
	  'screeny'    =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
);

?>      
      
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    
 <!-- searching form -->
           
   <form id="ajaxtransform" class="form-inline" method="post" action="<?php echo $form_action_trans; ?>">
      <div class="form-group">
        <label class="control-label labelx"> Passenger / ID No </label> <br>
        <table>
        <tr>
         <td> <?php $js = "class='select2_single form-control' id='cpassenger' tabindex='-1' style='width:197px;' "; 
	       echo form_dropdown('cpassenger', $passenger, isset($default['passenger']) ? $default['passenger'] : '', $js); ?> &nbsp; </td>
        </tr>
             <tr>
         <td> <textarea class="form-control col-md-3 col-xs-12" id="tpassenger" name="tpassenger"></textarea> </td>
             </tr>
             <tr>
         <td>
             <input type="text" class="form-control" id="tidcard" name="tidcard" style="margin-top:5px;">
         </td>
             </tr>
         </table>
        
        &nbsp;
      </div>

      <div class="form-group">
        <label class="control-label labelx"> Departed </label> <br>
         <table>
             <tr>
         <td> <?php $js = "class='select2_single form-control' id='cdepart' tabindex='-1' style='width:240px;' "; 
	     echo form_dropdown('cdepart', $airport, isset($default['depart']) ? $default['depart'] : '', $js); ?> </td>
             </tr>
             <tr>
         <td> <textarea class="form-control" name="tdepartdesc" id="tdepartdesc" placeholder="Departed Description" style="margin-top:5px; width:240px;"></textarea> </td>
             </tr>
         </table>
         
      </div>
      
      <div class="form-group">
        <label class="control-label labelx"> Arrived </label> <br>
         <table style="margin-right:5px;">
             <tr>
         <td> <?php $js = "class='select2_single form-control' id='carrived' tabindex='-1' style='width:240px;' "; 
	     echo form_dropdown('carrived', $airport, isset($default['arrived']) ? $default['arrived'] : '', $js); ?> </td>
             </tr>
             <tr>
         <td> <textarea class="form-control" name="tarriveddesc" id="tarriveddesc" placeholder="Arrived Description" style="margin-top:5px; width:240px;"></textarea> </td>
             </tr>
         </table>
      </div>
            
      <div class="form-group">
        <label class="control-label labelx"> Depart Date / Return </label> <br>
        
        <table>
             <tr>
         <td> <input type="text" title="Date" class="form-control" id="ds3" name="tdepartdates" required style="width:170px"
         value="<?php echo isset($default['dates']) ? $default['dates'] : '' ?>" />
            <input type="checkbox" name="ckreturn" id="ckreturn" value="1"> <small> Return </small>
             </td>
             </tr>
             <tr>
         <td> <input type="text" title="Date" class="form-control" id="ds4" name="tarrivedates" required disabled style="width:170px; margin-top:5px;"
         value="<?php echo isset($default['dates']) ? $default['dates'] : '' ?>" /> </td>
             </tr>
         </table>
        
         
      </div>
      
      <div class="form-group">
        <label class="control-label labelx"> Airline &amp; Booking Code &amp; Vendor </label> <br>
        <table>
        <tr>
         <td> <?php $js = "class='select2_single form-control' id='cairline' tabindex='-1' style='width:240px;' "; 
	       echo form_dropdown('cairline', $airline, isset($default['airline']) ? $default['airline'] : '', $js); ?> &nbsp; </td>
        </tr>
        <tr>
         <td> 
          <input type="text" class="form-control" name="tbook" id="tbook" placeholder="Booking Code" style="width:240px; padding-top:5px;">
          &nbsp; </td>
        </tr>
        <tr>
         <td> 
         <?php $js = "class='select2_single form-control' id='cvendor' tabindex='-1' style='min-width:240px;' "; 
	     echo form_dropdown('cvendor', $vendor, isset($default['vendor']) ? $default['vendor'] : '', $js); ?>
         </td>
        </tr>
        </table>
        
      </div>
      
      <div class="form-group">
        <label class="control-label labelx"> Ticket No </label> <br>
        <input type="text" name="tticketno" id="tticketno" class="form-control" style="width:150px;" required value="0"> &nbsp;
      </div>
      
      <div class="form-group">
        <label class="control-label labelx"> Capital </label> <br>
        <input type="number" name="tcapital" id="tcapital" class="form-control" style="width:110px;" maxlength="8" required value="0"> &nbsp;
      </div>
      
      <div class="form-group">
        <label class="control-label labelx"> Price </label> <br>
        <input type="number" name="tprice" id="tprice" class="form-control" style="width:110px;" maxlength="8" required value="0"> &nbsp;
      </div>
       
      <div class="form-group">
        <label class="control-label labelx"> Discount </label> <br>
        <input type="number" name="tdiscount" id="tdiscount" class="form-control" style="width:110px;" maxlength="8" required value="0"> &nbsp;
      </div>   
       
      <div class="form-group">
        <label class="control-label labelx"> Tax </label> <br>
         <?php $js = "class='form-control' id='ctax' tabindex='-1' style='width:90px;' "; 
	     echo form_dropdown('ctax', $tax, isset($default['tax']) ? $default['tax'] : '', $js); ?>
        &nbsp;
      </div>

      <div class="form-group"> <br>
       <div class="btn-group">      
       <button type="submit" class="btn btn-primary button_inline"> Post </button>
       <button type="button" onClick="load_data();" class="btn btn-danger button_inline"> Reset </button>
       </div>
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
            <th class="column-title"> Passenger </th>
            <th class="column-title"> Routing </th>
            <th class="column-title"> DepTime </th>
            <th class="column-title"> Return </th>
            <th class="column-title"> Vendor </th>
            <th class="column-title"> Airline </th>
            <th class="column-title"> Ticket No </th>
            <th class="column-title"> Capital </th>
            <th class="column-title"> Price </th>
            <th class="column-title"> Discount </th>
            <th class="column-title"> Tax </th>
            <th class="column-title"> Amount </th>
            <th class="column-title no-link last"><span class="nobr">Action</span>
            </th>
            <th class="bulk-actions" colspan="7">
              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
            </th>
          </tr>
        </thead>

        <tbody>
            
        <?php
              
            if ($items)
            {
                function airport($val){
                    $lib = new Airport_lib();
                    return $lib->get_code($val);
                }
                
                function airline($val){
                    $lib = new Airline_lib();
                    return $lib->get_detail_field('code',$val);
                }
                
                function vendor($val){
                    $lib = new Vendor_lib();
                    return $lib->get_vendor_name($val);
                }
                
                $i=1;
                foreach($items as $res)
                {
if ($res->returns == FALSE){ $return = '-'; }else{ $return = tglin($res->return_dates).' '.timein($res->return_dates); }
                    echo "
                     <tr class=\"even pointer\">
                        <td> ".$i." </td>
                        <td> ".ucfirst($res->passenger).' - '.$res->idcard." </td>
                        <td> ".airport($res->source)." - ".airport($res->destination)."</td>
                        <td> ".tglin($res->dates).' '.timein($res->dates)." </td>
                        <td> ".$return." </td>
                        <td> ".vendor($res->vendor)." </td>
                        <td> ".airline($res->airline)." </td>    
                        <td> ".$res->ticketno." </td>
                        <td class=\"a-right a-right \"> ".idr_format($res->hpp)." </td>
                        <td class=\"a-right a-right \"> ".idr_format($res->price)." </td>
                        <td class=\"a-right a-right \"> ".idr_format($res->discount)." </td>
                        <td class=\"a-right a-right \"> ".idr_format($res->tax)." </td>
                        <td class=\"a-right a-right \"> ".idr_format($res->amount)." </td>
<td class=\" last\"> 

<a class=\"btn btn-primary btn-xs text-update\" id=\"".$res->id."\"> <i class=\"fa fas-2x fa-edit\"> </i> </a>

<a class=\"btn btn-danger btn-xs\" href=\"".site_url('sales/delete_item/'.$res->id.'/'.$res->sales_id)."\"> 
<i class=\"fa fas-2x fa-trash\"> </i> 
</a> 

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
    <div class="col-md-3 col-sm-12 col-xs-12 col-md-offset-9">
        
        <table id="table_summary" style="width:100%;">
            <tr> <td> Sub Total </td> <td class="amt"> <?php echo isset($default['total']) ? idr_format($default['total']) : '0'; ?>,- </td> </tr>
<tr> <td> Discount (-) </td> <td class="amt"> <?php echo isset($default['discount']) ? idr_format($default['discount']) : '0'; ?>,- </td> </tr>
            <tr> <td> Tax </td> <td class="amt"> <?php echo isset($default['tax']) ? idr_format($default['tax']) : '0' ?>,- </td> </tr>
            <tr> <td> Cost </td> <td class="amt"> 
                <span id="shipn"><?php echo isset($default['costs']) ? idr_format($default['costs']) : '0' ?></span>,- 
            </td> </tr>
<tr> <td> <h3 style="color:#337AB7; font-weight:bold;"> Total </h3> </td> 
     <td class="amt"> <h3 style="color:#337AB7; font-weight:bold;"> <?php echo isset($default['tot_amt']) ? idr_format($default['tot_amt']) : '0' ?>,- </h3> </td> </tr>
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
     
  <!-- Modal - Add Form -->
  <div class="modal fade" id="myModal" role="dialog">
         <?php $this->load->view('sales_update_item'); ?>      
  </div>
      <!-- Modal - Add Form -->
      
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
    
    
