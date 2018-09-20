<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel" >
<div class="x_title">
  <h2>WEB-ADMIN - 1.0.3 - <?php echo $name; ?> System </h2> <div class="clearfix"></div>
    
   <!-- top tiles -->
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
    
<script type="text/javascript" src="<?php echo base_url().'js-old/' ?>canvasjs.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	
	var url = "<?php echo $asset;?>";
	$.getJSON(url, function (result) {

		var chart = new CanvasJS.Chart("chartContainer", {
			theme: "theme1",//theme1
			axisY:{title: "Asset", },
   		    animationEnabled: true, 
			data: [
				{
					type: "pie",
					dataPoints: result
				}
			]
		});

		chart.render();
	});
	
	var url2 = "<?php echo $operating;?>";
	$.getJSON(url2, function (result) {

		var chart2 = new CanvasJS.Chart("chartContainer2", {
			theme: "theme1",//theme1
			axisX:{title: "Net-Profit", },
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
	
	var url3 = "<?php echo $asset12;?>";
	$.getJSON(url3, function (result) {

		var chart3 = new CanvasJS.Chart("chartContainer3", {
			theme: "theme1",//theme1
			axisX:{title: "Asset-12 Month", },
   		    animationEnabled: true, 
			data: [
				{
					type: "column",
					dataPoints: result
				}
			]
		});
		chart3.render();
	});
	
	var url4 = "<?php echo $cashbank;?>";
	$.getJSON(url4, function (result) {

		var chart4 = new CanvasJS.Chart("chartContainer4", {
			theme: "theme1",//theme1
   	   	    axisY:{title: "Cash & Bank", },
   		    animationEnabled: true, 
			data: [
				{
					type: "bar",
					dataPoints: result
				}
			]
		});
		chart4.render();
	});
	
	var url7 = "<?php echo $outcome12;?>";
	var url6 = (function () {
    var url6 = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': url7,
        'dataType': "json",
        'success': function (data) {
            url6 = data;
        }
    });
		return url6;
	})(); 
	
	var types = "<?php echo $jenis;?>";
	var url5 = "<?php echo $income12;?>";
	
	if (types != 2)
	{
			$.getJSON(url5, function (result) {
			var chart5 = new CanvasJS.Chart("chartContainer5", {
				theme: "theme1",//theme1
				axisX:{title: "Sales-12 Month", },
				animationEnabled: true, 
				data: [
					{
						type: "column",
						dataPoints: result
					}
				]
			});
			chart5.render();
		}); 
	}
	else 
	{
		$.getJSON(url5, function (result) {
			var chart5 = new CanvasJS.Chart("chartContainer5", {
				theme: "theme1",//theme1
				axisX:{title: "Sales-12 Month", },
				animationEnabled: true, 
				data: [
					{
						type: "column",
						dataPoints: result
					},
					{
					type: "column",
					dataPoints: url6
				  }
				]
			});
			chart5.render();
		}); 
    }
	
});
</script>    
    
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
            
            .border{ border: 0px solid #ccc;}
        </style>

        
<div class="row">
    
   <!--  Asset -->
    <div class="col-md-6 col-sm-6 col-xs-12 border">
    
    <fieldset style="height:345px; width:100%; float:left; margin:8px 0 10px 5px;"> <legend> Asset </legend>
    <form name="chartform1" class="form-inline" method="post">
    <table>
    <tr> <td> <label> Type </label> : &nbsp;
              <select name="cassettype" class="form-control"> 
              <option value="1"> Jan </option> 
              <option value="2"> Feb </option> 
              <option value="3"> Mar </option>
              <option value="4"> Apr </option>
              <option value="5"> May </option>
              <option value="6"> Jun </option>
              <option value="7"> Jul </option>
              <option value="8"> Aug </option>
              <option value="9"> Sep </option> 
              <option value="10"> Oct </option>
              <option value="11"> Nov </option>
              <option value="12"> Dec </option>
              </select>
              <button type="submit" class="btn btn-primary button_inline"> Submit </button>
    </td> </tr>
    </table>
    </form>
    <div id="chartContainer" style="height: 300px; width: 100%;"> </div>
    </fieldset>
    
    </div>
    <!--  Asset -->
    
    <!--  Net Profit -->
    <div class="col-md-6 col-sm-6 col-xs-12 border">
    
    <fieldset style="height:345px; width:100%; float:left; margin:8px 0 10px 5px;"> <legend> Net Profit </legend>
    <div id="chartContainer2" style="height: 300px; width: 100%;"> </div>
    </fieldset>
    
    </div>
    <!--  Net Profit -->
    
    <!--  Asset 12 Month -->
    <div class="col-md-12 col-sm-12 col-xs-12 border">
    
    <fieldset style="height:345px; width:100%; margin:8px 0 10px 5px;"> <legend> Asset 12 Month </legend>
    <div id="chartContainer3" style="height: 300px; width: 100%;"> </div>
    </fieldset>
    
    </div>
    <!--  Asset 12 Month -->
    
     <!--  Report -->
    <div class="col-md-5 col-sm-5 col-xs-12 border">
    <fieldset style="height:345px; width:100%; margin:8px 0 10px 5px;"> <legend> Financial Report - Statement </legend>
        
    <?php 

    $atts = array(
          'class'      => '',
          'title'      => 'Report',
          'width'      => '550',
          'height'     => '300',
          'scrollbars' => 'yes',
          'status'     => 'no',
          'resizable'  => 'no',
          'screenx'    =>  '\'+((parseInt(screen.width) - 550)/2)+\'',
          'screeny'    =>  '\'+((parseInt(screen.height) - 300)/2)+\'',
    );

    ?>
        
        <div class="ixcon">
            <img alt="Sales" src="<?php echo base_url().'images/sales.png';?>">
            <?php echo anchor_popup(site_url("report/profitloss/"), '<p> Profit & Loss </p>', $atts); ?>
        </div>
        
        <div class="ixcon">
            <img alt="Sales" src="<?php echo base_url().'images/balance.png';?>">
            <?php echo anchor_popup(site_url("report/balance_sheet/"), '<p> Balance Sheet </p>', $atts); ?>
        </div>
        
        <div class="ixcon">
            <img alt="Sales" src="<?php echo base_url().'images/report.png';?>">
            <?php echo anchor_popup(site_url("report/cash_flow/"), '<p> Cash Flow </p>', $atts); ?>
        </div>
        
        <div class="ixcon">
            <img alt="Sales" src="<?php echo base_url().'images/neworder.png';?>">
            <?php echo anchor_popup(site_url("report/trial_balance/"), '<p> Trial Balance </p>', $atts); ?>
        </div>
        
        <div class="ixcon">
            <img alt="Sales" src="<?php echo base_url().'images/receipt.png';?>">
            <?php echo anchor_popup(site_url("ledger/report"), '<p> General Ledger </p>', $atts); ?>
        </div>
        
<!--
        <div class="ixcon">
            <img alt="Sales" src="<?php // echo base_url().'images/log.png';?>">
            <?php // echo anchor_popup(site_url("journalgl/report"), '<p> Journal </p>', $atts); ?>
        </div>
-->
 
    </fieldset>
    </div>
    <!--  Report -->
    
    <!--  Cash & Bank -->
    <div class="col-md-7 col-sm-7 col-xs-12 border">
    <fieldset style="height:345px; width:100%; margin:8px 0 10px 5px;"> <legend> Cash &amp; Bank </legend>
        <div id="chartContainer4" style="height: 280px; width: 100%; float:right; margin-bottom:10px;"></div>
    </fieldset>
    </div>
    <!--  Cash & Bank -->
    
    <!--  Sales Chart -->
    <div class="col-md-12 col-sm-12 col-xs-12 border">
    <fieldset style="height:345px; width:100%; margin:8px 0 10px 5px;"> <legend> Sales Chart </legend>
        <form name="chartform" method="post" class="form-inline">
    <table>
    <tr> <td> <label> Type </label> : &nbsp;
              <select id="ctype" name="ctype" class="form-control"> 
              <option value="0"> Operational - Income </option> 
              <option value="1"> Gross Income </option> 
              <option value="2"> Income vs Cost </option> 
              </select>
              <button type="submit" class="btn btn-primary button_inline"> Submit </button>
    </td> </tr>
    </table>
    </form>
        <div id="chartContainer5" style="height: 280px; width: 100%; float:right; margin-bottom:10px;"></div>
    </fieldset>
    </div>
    <!--  Sales Chart -->


</div>
        
       <div class="clearfix"></div>
    
    </div> 

<!-- end content --> 

</div>
</div>