
<?php 

$atts = array(
	  'class'      => 'refresh12',
	  'title'      => 'Report',
	  'width'      => '550',
	  'height'     => '300',
	  'img'        => base_url().'images/finance_alaysis.png',
	  'scrollbars' => 'yes',
	  'status'     => 'yes',
	  'resizable'  => 'yes',
	  'screenx'    =>  '\'+((parseInt(screen.width) - 550)/2)+\'',
	  'screeny'    =>  '\'+((parseInt(screen.height) - 350)/2)+\'',
);

?>

<script type="text/javascript" src="<?php echo base_url().'js/' ?>canvasjs.min.js"></script>
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

<div id="webadmin">

	<div class="title"> <?php $flashmessage = $this->session->flashdata('message'); ?> </div>
	<p class="message"> <?php echo ! empty($message) ? $message : '' . ! empty($flashmessage) ? $flashmessage : ''; ?> </p>
	
	<table style="width:100%;">
		<tr> <td rowspan="3" style="width:30px; background-color:#CCCCCC; "></td> <td style="font-size:18px; font-weight:bold; padding:10px; ">WEB-ADMIN - 1.0.2 - 
		<?php echo $name; ?> System</td> </tr>
		<tr> <td style="background-color:#CCCCCC; color:#FFFFFF; padding:5px 5px 5px 10px; font-weight:bold; "> <div class="garis"> </div> </td> </tr>
		<tr> <td style="background-color:#F2F2F2; padding:5px 5px 5px 10px;"> IP Adress : <b style="color:#790F0F;"> <?php echo $this->input->ip_address(); ?> - <?php echo $user_agent; ?> </b> |  
		Last Login : <b style="color:#790F0F;"> <?php echo $this->session->userdata('waktu'); ?> </b> |  
		Period : <b style="color:#790F0F;"> <?php echo $month.' '.$year; ?> </b>  </td> </tr>
	</table>  
	
	<hr>
    
    <fieldset class="field" style="height:345px; width:48%; float:left; margin:0 0 10px 5px;"> <legend> Asset </legend>
    <form name="chartform1" method="post">
    <table>
    <tr> <td> <label> Type </label> : &nbsp;
              <select name="cassettype" class="field"> 
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
               <input class="field" type="submit" value="SUBMIT" />
    </td> </tr>
    </table>
    </form>
    <div id="chartContainer" style="height: 300px; width: 100%;"> </div>
    </fieldset>
    
    <fieldset class="field" style="height:345px; width:46%; float:right; margin:0 5px 10px 0px;"> <legend> Net Profit </legend>
    <div id="chartContainer2" style="height: 330px; width: 100%;"></div>
    </fieldset>
    
    <div id="chartContainer3" style="height: 300px; width: 98%; float:left; margin-bottom:20px;"></div>
    <div id="chartContainer4" style="height: 280px; width: 60%; float:right; margin-bottom:10px;"></div>
	
    <fieldset class="field" style="margin:5px;"> <legend> Financial Report - Statement </legend>
	<div id="iconplace">
        
        <div class="icon">
		  <center>
            <img alt="Admin Menu" src="<?php echo base_url().'images/sales.png';?>">
            <?php echo anchor_popup(site_url("report/profitloss"), '<p> Profit & Loss </p>', $atts); ?>
		  </center>
		</div>
		
		<div class="icon">
		  <center>
            <img alt="Admin Menu" src="<?php echo base_url().'images/balance.png';?>">
            <?php echo anchor_popup(site_url("report/balance_sheet"), '<p> Balance Sheet </p>', $atts); ?>
		  </center>
		</div>
        
        <div class="icon">
		  <center>
            <img alt="Admin Menu" src="<?php echo base_url().'images/report.png';?>">
            <?php echo anchor_popup(site_url("report/cash_flow"), '<p> Cash Flow </p>', $atts); ?>
		  </center>
		</div>
        
        <div class="icon">
		  <center>
            <img alt="Admin Menu" src="<?php echo base_url().'images/neworder.png';?>">
            <?php echo anchor_popup(site_url("report/trial_balance"), '<p> Trial Balance </p>', $atts); ?>
		  </center>
		</div>
        
        <div class="icon">
		  <center>
            <img alt="Admin Menu" src="<?php echo base_url().'images/receipt.png';?>">
            <?php echo anchor_popup(site_url("ledger/report"), '<p> General Ledger </p>', $atts); ?>
		  </center>
		</div>
        
        <div class="icon">
		  <center>
            <img alt="Admin Menu" src="<?php echo base_url().'images/log.png';?>">
            <?php echo anchor_popup(site_url("journalgl/report"), '<p> Journal </p>', $atts); ?>
		  </center>
		</div>
		
	</div>
    </fieldset>
	
    <fieldset class="field" style="height:360px; width:97%; float:right; margin-right:5px;"> <legend> Sales Chart </legend>
    <form name="chartform" method="post">
    <table>
    <tr> <td> <label> Type </label> : &nbsp;
              <select id="ctype" name="ctype" class="field"> 
              <option value="0"> Operational - Income </option> 
              <option value="1"> Gross Income </option> 
              <option value="2"> Income vs Cost </option> 
              </select>
               <input class="field" type="submit" value="SUBMIT" />
    </td> </tr>
    </table>
    </form>
    <div id="chartContainer5" style="width:100%; height:300px;"></div>
    </fieldset>
    
	<div class="clear"></div>
	
</div>