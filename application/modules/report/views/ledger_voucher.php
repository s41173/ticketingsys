<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> Journal Voucher <?php echo isset($pono) ? $pono : ''; ?></title>
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

<body onLoad="window.print();">

<div style="width:750px; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	
	<h2 style="font-size:24px; font-weight:normal; text-align:center;"> Journal Voucher - <?php echo $p_name; ?> </h2>
	
	
	<div style="clear:both; "></div> 
	
	<div style="width:300px; border:0px solid red; float:left;">
		<table style="font-size:12px;">
		    <tr> <td> No </td> <td>:</td> <td> JT-00<?php echo $no; ?> </td> </tr>
			<tr> <td> Date </td> <td>:</td> <td> <?php echo $date; ?> </td> </tr>
			<tr> <td> Currency </td> <td>:</td> <td> <?php echo $cur; ?> </td> </tr>
			<tr> <td> Notes </td> <td>:</td> <td> <?php echo $notes; ?> </td> </tr>
			<tr> <td> Log </td> <td>:</td> <td> <?php echo $log; ?> </td> </tr>
		</table>
	</div>
	
	<div style="clear:both; "></div>
	
	<div style="margin:10px 0 0 0; border-solid:0px dotted #000;">
		
		<table class="product">

		 <tr> <th> Code </th>  <th> Account </th> <th> Debit </th> <th> Credit </th> </tr>

<!--		 <tr> <td> 1 </td> <td class="left"> Biaya Lain </td> <td class="left"> 30 </td> </tr> -->
		
		 <?php
		 
		 	
		    if ($items)
			{
				$i=1;
				foreach($items as $res)
				{
					echo "
						<tr> 
						     <td>".$account->get_code($res->account_id)."</td>
							 <td>".$account->get_name($res->account_id)."</td>
						     <td class=\"right\">".num_format($res->debit)."</td>
							 <td class=\"right\">".num_format($res->credit)."</td> 
						</tr>
					";
					$i++;
				}
			}
		 ?>
		 
		 <tr> <td></td> <td class="right"> <b>Total :</b> </td> <td class="right"> <b> <?php echo num_format($balance); ?> </b> </td> 
		                          <td class="right"> <b> <?php echo num_format($balance); ?> </b> </td> </tr>
			
		</table>
		
		<div style="clear:both; "></div>
		<hr>
		<div style="width:100%; border:0px solid #000; float:right; margin:3px 0px 0 0;">
		<style>
		  .sig{ font-size:16px; width:650px; float:right; text-align:right; }
		  .sig td{ width:170px; font-size:14px;}
		</style>
		
			<table border="0" class="sig">
				<tr> <td> Certain By : </td>  </tr>
			</table> <br> <br> <br> <br> <br>  <br>  <br> 
			
			<table border="0" class="sig">
				<tr> <td> <u> ___________________ </u> </td>  </tr>
			</table>
		</div>
		
		<div style="clear:both; ">
	</div>	
	
</div>

</body>
</html>
