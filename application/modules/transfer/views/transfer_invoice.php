<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> AP-Payment - GJ-00<?php echo isset($pono) ? $pono : ''; ?></title>
<style media="all">

	#logo { margin:0 0 0 75px;}
	#logotext{ font-size:12px; text-align:center; margin:0; }
	p { margin:0; padding:0; font-size:11px;}
	#pono{ font-size:18px; padding:0; margin:0 5px 10px 0; text-align:left;}
	
	table.product
	{ border-collapse:collapse; width:100%; }
	
	table.product,table.product th
	{	border: 1px solid black; font-size:13px; font-weight:bold; padding:4px 0 4px 0; }
	
	table.product,table.product td
	{	border: 1px solid black; font-size:12px; font-weight:normal; padding:3px 0 3px 0; text-align:center; }
	
	table.product td.left { text-align:left; padding:3px 5px 3px 10px; }
	table.product td.right { text-align:right; padding:3px 10px 3px 5px; }
	
</style>
</head>
    
<script type="text/javascript">
    
    function closeWindow() {
        setTimeout(function() {
        window.close();
        }, 300000);
    }
    
</script>      

<body onLoad="closeWindow()">

<div style="width:750px; height:7cm; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:0px solid #000;"> 
	
	<h2 style="font-size:18px; font-weight:normal; text-align:center; text-decoration:underline;"> FUND TRANSFER TRANSACTION </h2> 
    <div style="clear:both; "></div> 
	
	<div style="width:350px; border:0px solid #000; float:left;">
		<table style="font-size:13px; font-family:Tahoma, Geneva, sans-serif;">
 		    <tr> <td> Transcode </td> <td>:</td> <td> TR-0<?php echo $pono; ?> </td> </tr>
            <tr> <td> Account </td> <td>:</td> <td> <?php echo $from; ?> - <?php echo $to; ?> </td> </tr>
			<tr> <td> Currency </td> <td>:</td> <td> <?php echo $currency; ?> </td> </tr>
            <tr> <td> Date </td> <td>:</td> <td> <?php echo $podate; ?> </td> </tr>
		</table>
	</div>
	
	<div style="width:200px; border:0px solid red; float:right;">
		<table style="font-size:13px; font-family:Tahoma, Geneva, sans-serif;">
			<tr> <td> Notes </td> <td>:</td> <td> <?php echo $notes; ?> </td> </tr>
            <tr> <td> Status </td> <td>:</td> <td> <?php echo $stts; ?> </td> </tr>
            <tr> <td> <b> Total </b> </td> <td>:</td> <td> <b> <?php echo number_format($amount); ?> </b> </td> </tr>
            <tr> <td> In Words </td> <td>:</td> <td> <?php echo $terbilang; ?> </td> </tr>
		</table>
	</div>
	<div style="clear:both; "></div>
    <hr>
	<style>
        .sig{ font-size:11px; width:100%; float:right; text-align:center;}
        .sig td{ width:155px;}
    </style>
    
    <table border="0" class="sig">
        <tr> <td> Approved By : </td> <td> Review By : </td> <td> Paid By : </td> <td> Received By : </td> </tr>
    </table> <br> <br> <br> <br> <br> 
    
    <table border="0" class="sig">
        <tr> <td> Manager </td> <td> Accounting </td> <td> <br> (_______________) </td> <td> <br> (_______________) </td> </tr>
    </table>
    <br>
	<div class="clear"></div>
    
</div>	

</body>
</html>
