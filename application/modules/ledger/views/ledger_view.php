
 <!-- Datatables CSS -->
<link href="<?php echo base_url(); ?>js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>js/datatables/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/icheck/flat/green.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url(); ?>js/moduljs/ledger.js"></script>
<script src="<?php echo base_url(); ?>js-old/register.js"></script>

<!--canvas js-->
<script type="text/javascript" src="<?php echo base_url().'js-old/' ?>canvasjs.min.js"></script>

<!-- Date time picker -->
 <script type="text/javascript" src="http://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
 <!-- Include Date Range Picker -->
<script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<script type="text/javascript">

	var sites_add  = "<?php echo site_url('ledger/add_process/');?>";
	var sites_edit = "<?php echo site_url('ledger/update_process/');?>";
	var sites_del  = "<?php echo site_url('ledger/delete/');?>";
	var sites_get  = "<?php echo site_url('ledger/update/');?>";
    var sites_ledger  = "<?php echo site_url('ledger/get/');?>";
    var sites_primary  = "<?php echo site_url('ledger/publish/');?>";
    var sites_ajax  = "<?php echo site_url('ledger/');?>";
	var source = "<?php echo $source;?>";
    
    var urlx  = "<?php echo $graph;?>";
	
    $(document).ready(function (e) {
    
     //chart render
	
	$.getJSON(urlx, function (result) {
		
		var chart = new CanvasJS.Chart("chartcontainer", {

			theme: "theme1",//theme1
			axisY:{title: "", },
  		    animationEnabled: true, 
			data: [
				{
					type: "column",
					dataPoints: result
				}
			]
		});

		chart.render();
	});
	
	//chart render
        
    // document ready end	
    });
	
</script>

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

          <div class="row"> 
          
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" >
              
              <!-- xtitle -->
              <div class="x_title">
                
               <h2> Account Filter </h2>
                
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
                </ul>
                
                <div class="clearfix"></div>
              </div>
              <!-- xtitle -->
                
                <div class="x_content">
           
           <!-- searching form -->
           
           <form id="xsearchform" class="form-inline" method="post" action="<?php echo site_url('ledger/search'); ?>">
              
              <div class="form-group"> 
              <label> Account </label> <br>      
    <input type="text" name="taccount" id="titem" class="form-control" required style="max-width:120px;" placeholder="COA"> 
                <?php echo anchor_popup(site_url("account/get_list/"), '[ ... ]', $atts1); ?> &nbsp; &nbsp; 
              </div>
               
              <div class="form-group">
                <label> Period </label> <br>
                <div class="col-md-9 col-sm-9 col-xs-12">     
        <input type="text" readonly style="width: 200px" name="reservation" id="d1" class="form-control active" value=""> 
                </div>
            </div>
              
              <div class="btn-group"> <br>
               <button type="submit" class="btn btn-primary button_inline"> Filter </button>
               <button type="reset" onClick="" class="btn btn-danger button_inline"> Clear </button>
              </div>
          </form> <br>
           
           <!-- searching form -->
           
              
          <form class="form-inline" id="cekallform" method="post" action="<?php echo ! empty($form_action_del) ? $form_action_del : ''; ?>">
                  <!-- table -->
                  
                  <?php echo ! empty($table) ? $table : ''; ?>            
                  <!-- Check All Function -->  
          </form>       

                    
<!-- table attribute -->
<style type="text/css">
    .nilai{ font-weight: bold; color: darkred;}
</style>
                    
          <table style="float:left; margin-right:55px; margin-bottom:20px;">
<tr> 
    <td> <label> Beginning : &nbsp; </label> </td> 
    <td> <label class="nilai"> <?php echo $begin; ?> </label> </td> 
</tr>
<tr> 
    <td> <label> End : &nbsp; </label> </td> 
    <td> <label class="nilai"> <?php echo $end; ?> </label> </td> 
</tr>
          </table>

          <table style="float:left; margin-right:55px;">
<tr> 
    <td> <label> Debit : &nbsp; </label> </td> 
    <td> <label class="nilai"> <?php echo $debit; ?> </label> </td> 
</tr>
<tr> 
    <td> <label> Credit : &nbsp; </label> </td> 
    <td> <label class="nilai"> <?php echo $credit; ?> </label> </td> 
</tr>
          </table>
                    
          <table style="float:left;"> 
<tr> 
    <td> <label> Mutation : &nbsp; </label> </td> 
    <td> <label class="nilai"> <?php echo $mutation; ?> </label> </td> 
</tr>
          </table> <div class="clear"></div>
<!-- table attribute -->                  

<div class="btn-group">
    
<a target="_parent" href="<?php echo site_url('closing/calculate/ledger'); ?>" class="btn btn-warning"> 
   Calculate Ending Balance  </a>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal3"> Report </button>

<div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
  Period End <span class="caret"></span></button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="<?php echo site_url('closing/monthly'); ?>">Month End</a></li>
    <li><a href="<?php echo site_url('closing/annual'); ?>">Year End</a></li>
  </ul>
</div>

<!-- links -->
<?php if (!empty($link)){foreach($link as $links){echo $links . '';}} ?>
<!-- links -->

</div>                       

<div id="chartcontainer" style="height:250px; margin-top:25px; width:100%; border:0px solid red;"></div>              
                    
            </div>
                                               
            </div>
          </div>  
    
      <!-- Modal - Add Form -->
      <div class="modal fade" id="myModal" role="dialog">
         <?php //$this->load->view('account_form'); ?>      
      </div>
      <!-- Modal - Add Form -->
              
       <!-- Modal - Add Form -->
      <div class="modal fade" id="myModal2" role="dialog">
         <?php //$this->load->view('account_update'); ?>      
      </div>
      <!-- Modal - Add Form -->
      
      
      <!-- Modal - Report Form -->
      <div class="modal fade" id="myModal3" role="dialog">
         <?php $this->load->view('ledger_report_panel'); ?>    
      </div>
      <!-- Modal - Report Form -->
      
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
