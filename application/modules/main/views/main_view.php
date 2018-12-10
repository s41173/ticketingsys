<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel" >
<div class="x_title">
  <h2>WEB-ADMIN - 1.0.3 - <?php echo $name; ?> System </h2> <div class="clearfix"></div>
    
   <!-- top tiles -->
  <div class="row tile_count" style="margin-left:5px;">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
      <div class="count">2500</div>
      <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
      <div class="count">123.50</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
      <div class="count green">2,500</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
      <div class="count">4,567</div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
      <div class="count">2,315</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
      <div class="count">7,325</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
  </div>
<!-- /top tiles -->

<div class="clearfix"></div>
     
    <div class="title"> <?php $flashmessage = $this->session->flashdata('message'); ?> </div>
    <p class="message"> <?php echo ! empty($message) ? $message : '' . ! empty($flashmessage) ? $flashmessage : ''; ?> </p>
    
    <div class="alert alert-error alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <span style="color:#fff !important;">IP Adress : <strong> <?php echo $this->input->ip_address(); ?> </strong> 
      - <?php echo $user_agent; ?> | Last Login : <?php echo $this->session->userdata('waktu'); ?> | 
      Period : <?php echo $month; ?> <?php echo $year; ?> </span> 
    </div>
    
    
</div>
    
    <div class="x_content">
    
        <style>
          .ixcon{
            display: inline-block;
            margin: 20px;
            text-align: center;
            border:1px solid #eee;
            width: 100px;
            height: 100px;
            margin-bottom: 0;
            margin-right: 0px;
            padding-top: 15px;transition: all .5s;
            margin-left: 0;
          }
          .ixcon img{
            display: block;
        
            margin: 0 auto;margin-bottom: 5px;
          }
          .ixcon:hover{
            border:1px solid #40C1A6;
            transition: all 1s;
          }
          .ixcon:hover a{
            color: #40C1A6;
            text-decoration: none;
          }
        </style>
        
            <div class="ixcon">
                <a href="<?php echo site_url('purchase');?>">
                <img alt="Article Manager" src="<?php echo base_url().'images/purchase.png';?>">
                <p> Purchase </p>
                </a>
            </div>
        
            <div class="ixcon">
                <a href="<?php echo site_url('product');?>">
                <img alt="user" src="<?php echo base_url().'images/inventory.png';?>">
                <p> Inventory </p>
              </a>
            </div>
        
            <div class="ixcon">
                <a href="<?php echo site_url('stock_transfer');?>">
                <img alt="user" src="<?php echo base_url().'images/backup.png';?>">
                <p> Stock Transfer </p>
              </a>
            </div>
        
            <div class="ixcon">
                <a href="<?php echo site_url('sales');?>">
                <img alt="setting" src="<?php echo base_url().'images/sales.png';?>">
                <p> Sales </p>
              </a>
        
            </div>
        
            <div class="ixcon">
                <a href="<?php echo site_url('transfer');?>">
                <img alt="setting" src="<?php echo base_url().'images/receipt.png';?>">
                <p> Transaction </p>
              </a>
        
            </div>
            
            <div class="ixcon">
                <a href="<?php echo site_url('report_reference');?>">
                <img alt="setting" src="<?php echo base_url().'images/settlement.png';?>">
                <p> General Ledger </p>
              </a>
        
            </div>
        
            <div class="ixcon">
                <a href="<?php echo site_url('payroll');?>">
                <img alt="setting" src="<?php echo base_url().'images/role.png';?>">
                <p> Payroll </p>
              </a>
        
            </div>
        
            <div class="ixcon">
                <a href="<?php echo site_url('admin');?>">
                <img alt="user" src="<?php echo base_url().'images/user_icon.png';?>">
                <p>User</p>
              </a>
        
            </div>
        
            <div class="ixcon">
                <a href="<?php echo site_url('configuration');?>">
                <img alt="configuration" src="<?php echo base_url().'images/config.png';?>">
                <p>Configuration</p>
              </a>
            </div>
        
       <style type="text/css">
           .tablebox{ height: 300px; overflow-y: scroll; overflow-x: auto; } 
           .chartbox{ height: 300px; overflow: hidden; } 
           .margin{ margin-bottom: 30px; }
       </style>  
        
<div class="clear margin"></div>

<!-- cart -->
<script type="text/javascript" src="<?php echo base_url().'js-old/' ?>canvasjs.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	
	var url = "<?php echo $archart;?>";
	$.getJSON(url, function (result) {

		var chart = new CanvasJS.Chart("chartContainer", {
			theme: "theme1",//theme1
			axisX:{title: "Account Receivable Due", },
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
	
	var url2 = "<?php echo $apchart;?>";
	$.getJSON(url2, function (result) {

		var chart2 = new CanvasJS.Chart("chartContainer2", {
			theme: "theme1",//theme1
			axisX:{title: " Payable Due Chart", },
   		    animationEnabled: true, 
			data: [
				{
					type: "column",
					dataPoints: result
				}
			]
		});

		chart2.render();
	});
	
});
</script>       
        
       <!-- box ar chart-->
       <div id="chartContainer" class="col-md-6 col-sm-12 col-xs-12 chartbox margin">  </div> 
       <div id="" class="col-md-6 col-sm-12 col-xs-12 tablebox margin">
           
            <div class="x_panel">
                  <div class="x_title">
                    <h2>  Account Receivable Due - List </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">    
                      <?php echo ! empty($salestable) ? $salestable : ''; ?>       
                    </div>
                  </div>
            </div>
           
       </div>     
        
       <!-- box ap chart-->
       <div id="chartContainer2" class="col-md-6 col-sm-12 col-xs-12 chartbox margin">  </div> 
       <div id="" class="col-md-6 col-sm-12 col-xs-12 tablebox margin"> 
           
           <div class="x_panel">
                  <div class="x_title">
                    <h2>  Payable Due - List </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">  
                    <?php echo ! empty($purchasetable) ? $purchasetable : ''; ?>  
                    </div>

                  </div>
            </div>
       </div>  
        
       <!-- post dated check  -->
       <div id="" class="col-md-6 col-sm-12 col-xs-12 tablebox"> 
           
           <div class="x_panel">
                  <div class="x_title">
                    <h2> Post-Dated Checks Issuance  - List </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">  
                    <?php echo ! empty($checkouttable) ? $checkouttable : ''; ?>  
                    </div>

                  </div>
            </div>
       </div>   
        
       <!-- stock min qty  -->
       <div id="" class="col-md-6 col-sm-12 col-xs-12 tablebox"> 
           
           <div class="x_panel">
                  <div class="x_title">
                    <h2> Stock Minimum  - List </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">  
                    <?php echo ! empty($producttable) ? $producttable : ''; ?>  
                    </div>

                  </div>
            </div>
       </div>   
    
    </div> 

<!-- end content -->

</div>
</div>