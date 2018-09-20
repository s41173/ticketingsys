<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" >
<title> <?php echo isset($title) ? $title : ''; ?>  </title>
<style media="all">
	table{ font-family:"Arial"; font-size:11px;}
	h4{ font-family:"Arial"; font-size:13pt; font-weight:600;}
	.clear{clear:both;}
	table th{ background-color:#EFEFEF; padding:4px 0px 4px 0px; border-top:1px solid #000000; border-bottom:1px solid #000000;}
    p{ font-family:"Arial", Times, serif; font-size:12px; margin:0; padding:0;}
	legend{font-family:"Arial", Times, serif; font-size:13px; margin:0; padding:0; font-weight:600;}
	.tablesum{ font-size:13px;}
	.strongs{ font-weight:normal; font-size:12px; border-top:1px dotted #000000; }
	.poder{ border-bottom:0px solid #000000; color:#0000FF;}
	tr.border_bottom td { border-bottom:1pt solid black;}
	.border_bottoms { border-bottom:1pt solid black;}
	.border_up{ border-top:1pt solid black;}
	.acc_tit{ font-size:10pt; font-weight:bold; margin:5px; color:#006; }
	.acc_tit2{ font-size:10pt; font-weight:bold; margin:5px; color:#900; }
</style>
</head>

<body onLoad="window.print()">

<?php
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0,$em=0,$ey=0)
	{
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$em,$ey)->row();
		return intval($res->vamount);
	}
	
?>

<div style="width:100%; border:0px solid blue; font-family:Arial, Helvetica, sans-serif; font-size:12px;">

	
	<div style="border:0px solid red; float:right;">
		<table border="0">
			<tr> <td> Print Date </td> <td> : </td> <td> <?php echo tgleng(date('Y-m-d')); ?> </td> </tr>
            <tr> <td> Currency </td> <td> : </td> <td> <?php echo $currency; ?> </td> </tr>
		</table>
	</div>

	<center>
	   <div style="border:0px solid green; width:300px;">	
	       <h4> <?php echo isset($company) ? $company : ''; ?> <br> Profit & Loss <br> 
		   <?php echo get_month($months).' '.$years.' - '.get_month($emonths).' '.$eyears; ?> </h4>
	   </div>
	</center>
	
	<div class="clear"></div>
	
	<div style="width:100%; border:0px solid brown; margin-top:20px; border-bottom:1px dotted #000000; ">
		
        <table width="100%">
        	
        <tr> <td align="left"> <p class="acc_tit"> Pendapatan </p> </td> </tr>
        <tr> <td align="left" style="padding-left:50px;"> Pendapatan Usaha </td> </tr>
        <?php 
			foreach($income as $res)
			{
				echo "
				<tr> <td align=\"left\" style=\"padding-left:75px;\">".$res->code." - ".$res->name."</td> 
				     <td align=\"right\">".number_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> 
			    </tr>
				";
			}
		?>
        <tr> <td align="left" style="padding-left:50px;"> Total Pendapatan Usaha </td> 
             <td class="border_up" align="right"> <?php echo number_format($incometot); ?> </td> 
        </tr>
        <tr> <td align="left"> <p class="acc_tit">Total Pendapatan</p> </td> 
             <td class="border_up" align="right"> <b> <?php echo number_format($incometot); ?> </b> </td>
        </tr>
        
        <!-- Hpp -->
        <tr> <td align="left"> <p class="acc_tit"> Biaya atas Pendapatan </p> </td> </tr>
        <tr> <td align="left" style="padding-left:50px;"> Biaya Produksi </td> </tr>
        <?php 
			foreach($hpp as $res)
			{
				echo "
				<tr> <td align=\"left\" style=\"padding-left:75px;\">".$res->code." - ".$res->name."</td> 
				     <td align=\"right\">".number_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> 
			    </tr>
				";
			}
		?>
        <tr> <td align="left" style="padding-left:50px;"> Total Biaya Produksi </td> 
             <td class="border_up" align="right"> <?php echo number_format($hpptot); ?> </td> 
        </tr>
        
        <!-- Biaya Lain -->
        <tr> <td align="left" style="padding-left:50px;"> Biaya Lain </td> </tr>
        <?php 
			foreach($othercost as $res)
			{
				echo "
				<tr> <td align=\"left\" style=\"padding-left:75px;\">".$res->code." - ".$res->name."</td> 
				     <td align=\"right\">".number_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> 
			    </tr>
				";
			}
		?>
        <tr> <td align="left" style="padding-left:50px;"> Total Biaya Lain </td> 
             <td class="border_up" align="right"> <?php echo number_format($othercosttot); ?> </td> 
        </tr>
        <!-- Biaya Lain -->
        
        <tr> <td align="left"> <p class="acc_tit">Total Biaya atas Pendapatan</p> </td>
             <td class="border_up" align="right"> <b> <?php echo number_format($hpptot+$othercosttot); ?> </b> </td> 
        </tr>
        <!-- Hpp -->
            
       
<tr> <td align="left"> <p class="acc_tit2"> Gross Margin </p> </td> 
     <td class="border_up" align="right"> <b> <?php echo number_format($incometot-$hpptot+$othercosttot); ?> </b> </td>
</tr>

		<!-- Biaya Operasional / Non Operasional -->
	    <tr> <td align="left"> <p class="acc_tit"> Pengeluaran Operasional </p> </td> </tr>
        <!-- Biaya Operasional -->
        <tr> <td align="left" style="padding-left:50px;"> Biaya Operasional </td> </tr>
        <?php 
			foreach($operationalcost as $res)
			{
				echo "
				<tr> <td align=\"left\" style=\"padding-left:75px;\">".$res->code." - ".$res->name."</td> 
				     <td align=\"right\">".number_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> 
			    </tr>
				";
			}
		?>
        <tr> <td align="left" style="padding-left:50px;"> Total Biaya Operasional </td> 
             <td class="border_up" align="right"> <?php echo number_format($operationalcosttot); ?> </td> 
        </tr>
        <!-- Biaya Operasional -->
        
        <!-- Biaya Non Operasional -->
        <tr> <td align="left" style="padding-left:50px;"> Biaya Non Operasional </td> </tr>
        <?php 
			foreach($nonoperationalcost as $res)
			{
				echo "
				<tr> <td align=\"left\" style=\"padding-left:75px;\">".$res->code." - ".$res->name."</td> 
				     <td align=\"right\">".number_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> 
			    </tr>
				";
			}
		?>
        <tr> <td align="left" style="padding-left:50px;"> Total Biaya Non Operasional </td> 
             <td class="border_up" align="right"> <?php echo number_format($nonoperationalcosttot); ?> </td> 
        </tr>
        <!-- Biaya Non Operasional -->
        
        <tr> <td align="left"> <p class="acc_tit">Total Pengeluaran Operasional </p> </td> 
             <td class="border_up" align="right"> <b> <?php echo number_format($nonoperationalcosttot+$operationalcosttot); ?> </b> </td>
        </tr>
        <!-- Biaya Operasional / Non Operasional -->
        <tr> <td align="left"> <p class="acc_tit2"> Operating Profit </p> </td> 
             <td class="border_up" align="right"> 
             <b> <?php echo number_format($incometot-$hpptot+$othercosttot-$operationalcosttot+$nonoperationalcosttot); ?> </b>
             </td> 
        </tr> 
        
        <!-- Out Income -->
        <tr> <td align="left"> <p class="acc_tit"> Pendapatan Lain </p> </td> </tr>
        <tr> <td align="left" style="padding-left:50px;"> Pendapatan Luar Usaha </td> </tr>
        <?php 
			foreach($outincome as $res)
			{
				echo "
				<tr> <td align=\"left\" style=\"padding-left:75px;\">".$res->code." - ".$res->name."</td> 
				     <td align=\"right\">".number_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> 
			    </tr>
				";
			}
		?>
        <tr> <td align="left" style="padding-left:50px;"> Total Pendapatan Luar Usaha </td> 
             <td class="border_up" align="right"> <?php echo number_format($outincometot); ?> </td> 
        </tr>
        <tr> <td align="left"> <p class="acc_tit">Total Pendapatan Lain</p> </td> 
             <td class="border_up" align="right"> <b> <?php echo number_format($outincometot); ?> </b> </td> 
        </tr>
        <!-- Out Income --> 
        
        <!-- Out Cost -->
        <tr> <td align="left"> <p class="acc_tit"> Pengeluaran Lain </p> </td> </tr>
        <tr> <td align="left" style="padding-left:50px;"> Pengeluaran Luar Usaha </td> </tr>
        <?php 
			foreach($outcost as $res)
			{
				echo "
				<tr> <td align=\"left\" style=\"padding-left:75px;\">".$res->code." - ".$res->name."</td> 
				     <td align=\"right\">".number_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> 
			    </tr>
				";
			}
		?>
        <tr> <td align="left" style="padding-left:50px;"> Total Pengeluaran Luar Usaha </td> 
             <td class="border_up" align="right"> <?php echo number_format($outcosttot); ?> </td> 
        </tr>
        <tr> <td align="left"> <p class="acc_tit">Total Pengeluaran Lain</p> </td>
             <td class="border_up" align="right"> <b> <?php echo number_format($outcosttot); ?> </b> </td> 
        </tr>
        <!-- Out Cost --> 
        <tr> <td align="left"> <p class="acc_tit2"> Net Profit </p> </td> 
             <td class="border_up" align="right">
       <b> <?php echo number_format($incometot-$hpptot+$othercosttot-$operationalcosttot+$nonoperationalcosttot+$outincometot-$outcosttot); ?> </b> 
             </td> 
        </tr> 
         
        </table>
		   

		
	</div>

<!--	<div style="border:0px solid red; float:left; margin:25px 0px 0px 0px;">
		<p> Prepared By : <br/> <br/> <br/>  <br/> <br/>
		    (_______________________) 
		</p>
	</div>
	
	<div style="border:0px solid red; float:left; margin:25px 0px 0px 40px;">
		<p> Approval By : <br/> <br/> <br/>  <br/> <br/>
		    (_______________________) 
		</p>
	</div>-->

</div>

</body>
</html>
