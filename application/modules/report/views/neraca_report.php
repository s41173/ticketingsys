<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name=Generator content="FastReport 3.0 http://www.fast-report.com">
<title> <?php echo isset($title) ? $title : ''; ?>  </title>
<style type="text/css"><!-- 
.page_break {page-break-before: always;}
.s0 {
 font-family: Arial;
 font-size: 11px;
 color: #000000; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s1 {
 font-family: Arial;
 font-size: 11px;
 color: #000000; font-style: normal;
 background-color: transparent;
 text-align: Right; vertical-align: Top;
}
.s2 {
 font-family: Arial;
 font-size: 27px;
 color: #434889; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Center; vertical-align: Top;
}
.s3 {
 font-family: Arial;
 font-size: 16px;
 color: #000000; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Center; vertical-align: Top;
}
.s4 {
 font-family: Arial;
 font-size: 15px;
 color: #800000; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Center; vertical-align: Top;
}
.s5 {
 font-family: Arial;
 font-size: 11px;
 color: #800000; font-weight: bold; font-style: normal;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 0px;
 border-bottom-width: 1;
 text-align: Right; vertical-align: Top;
}
.s6 {
 font-family: Arial;
 font-size: 12px;
 color: #434889; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s7 {
 font-family: Arial;
 font-size: 12px;
 color: #434889; font-weight: bold; font-style: normal;;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 1;
 border-bottom-width: 0px;
 text-align: Right; vertical-align: Top;
}
.s8 {
 font-family: Arial;
 font-size: 12px;
 color: #80334A; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s9 {
 font-family: Arial;
 font-size: 12px;
 color: #80334A; font-weight: bold; font-style: normal;;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 1;
 border-bottom-width: 0px;
 text-align: Right; vertical-align: Top;
}
.s10 {
 font-family: Arial;
 font-size: 1px;
 color: #000000; font-style: normal;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 1;
 border-bottom-width: 0px;
 text-align: Left; vertical-align: Top;
}
--></style>
</head>
<bodybgcolor="#FFFFFF" text="#000000">
<a name="PageN1"></a>

<?php
	
	$totkas = 0;
    $totbank = 0;
	$totpiutangusaha = 0;
	$totpersediaan = 0;
	$totpiutangnonusaha = 0;
	$tothartawujud = 0;
	$tothartatakwujud = 0;
	$tothartalain = 0;
	$totinvestasi = 0;
	$harta = 0;
	$totpajakdimuka = 0;
	$tothutangusaha = 0;
	$tothutangnonusaha = 0;
	$tothutangpajak = 0;
	$tothutangpanjang = 0;
	$tothutanglain = 0;
	$totmodal = 0;
	$totlaba = 0;
	$modaltot = 0;
	$kewajiban = 0;
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0,$em=0,$ey=0)
	{
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$em,$ey)->row();
		return floatval($res->vamount + get_beginning($cur,$acc,$m,$y));
	}
	
	function get_vamount_balance($cur='IDR',$acc,$m=0,$y=0)
	{
		$bl = new Balance();
		$bl->where('account_id', $acc);
        $bl->where('month', $m);
        $bl->where('year', $y)->get();
		return floatval($bl->beginning+$bl->vamount);
	}
	
	function get_beginning($cur='IDR',$acc,$m=0,$y=0)
	{
		$bl = new Balance();
		$bl->where('account_id', $acc);
        $bl->where('month', $m);
        $bl->where('year', $y)->get();
		return floatval($bl->beginning);
	}
	
	function get_end($cur='IDR',$acc,$m=0,$y=0)
	{
		$bl = new Balance();
		$bl->where('account_id', $acc);
        $bl->where('month', $m);
        $bl->where('year', $y)->get();
		return floatval($bl->end);
	}
	
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr style="height: 1px"><td width="60"></td><td width="8"></td><td width="4"></td><td width="53"></td><td width="40"></td><td width="14"></td><td width="15"></td><td width="33"></td><td width="1"></td><td width="155"></td><td width="53"></td><td width="3"></td><td width="12"></td><td width="40"></td><td width="1"></td><td width="113"></td><td width="114"></td></tr>
<tr style="height:18px">
<td colspan="2" class="s0">14:07</td><td></td><td colspan="4" class="s0">05 Juli, 2014</td><td></td><td></td><td></td><td></td><td colspan="6" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:22px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:24px">
<td colspan="17" rowspan="2" class="s3"><?php echo isset($company) ? $company : ''; ?></td>
</tr>
<tr style="height:2px">
</tr>
<tr style="height:35px">
<td colspan="17" class="s2"> Balance Sheet </td>
</tr>
<tr style="height:1px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:26px">
<td colspan="17" class="s4"><?php echo get_month($months).' '.$years.' - '.get_month($emonths).' '.$eyears; ?></td>
</tr>
<tr style="height:24px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class="s5">Saldo</td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6"> Harta </td><td></td><td></td><td></td><td></td><td></td>
<td rowspan="2" class="s1"><?php echo $currency; ?></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Kas -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Kas </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($kas as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
		   echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		   <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
		   <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
           </tr>";
	    }
		
    	$totkas = $totkas + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears)); 
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6"> Total Kas </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totkas); ?></td><td></td>
</tr>
<!-- Kas -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Bank-->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Bank </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($bank as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		$totbank = $totbank + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Bank </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totbank); ?></td><td></td>
</tr>
<!--Bank-->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Piutang Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Piutang Usaha </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($piutangusaha as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		$totpiutangusaha = $totpiutangusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Piutang Usaha </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totpiutangusaha); ?></td><td></td>
</tr>
<!--Piutang Usaha-->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Persediaan -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Persediaan </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($persediaan as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$totpiutangusaha = $totpiutangusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Persediaan</td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totpersediaan); ?></td><td></td>
</tr>
<!--Persediaan-->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Piutang Non Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Piutang Non Usaha </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($piutangnonusaha as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$totpiutangnonusaha = $totpiutangnonusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Piutang Non Usaha </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totpiutangnonusaha); ?></td><td></td>
</tr>
<!--Piutang Non Usaha-->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Tetap Berwujud -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Harta Tetap Berwujud </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($hartawujud as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$tothartawujud = $tothartawujud + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Harta Tetap Berwujud </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($tothartawujud); ?></td><td></td>
</tr>
<!-- Harta Tetap Berwujud -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Tetap Tak Berwujud -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($hartatakwujud as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$tothartatakwujud = $tothartatakwujud + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($tothartatakwujud); ?></td><td></td>
</tr>
<!-- Harta Tetap Tak Berwujud -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Lainnya -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Harta Lainnya </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($hartalain as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$tothartalain = $tothartalain + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Harta Lainnya </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($tothartalain); ?></td><td></td>
</tr>
<!-- Harta Lainnya -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Investasi -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Investasi Jangka Panjang </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($investasi as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$totinvestasi = $totinvestasi + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6"> Total Investasi Jangka Panjang </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totinvestasi); ?></td><td></td>
</tr>
<!-- Investasi -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6"> Total Harta </td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"><?php $harta = $totkas + $totbank + $totpiutangusaha + $totpersediaan + $totpiutangnonusaha + $tothartawujud + $tothartatakwujud + $tothartalain + $totinvestasi;  echo num_format($harta); ?></td><td></td>
</tr>
<!-- Harta -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>


<!-- Kewajiban -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6"> Kewajiban </td><td></td><td></td><td></td><td></td><td></td>
<td rowspan="2" class="s1"> </td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pajak Di Bayar Dimuka -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Pajak Dibayar Dimuka </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($pajakdimuka as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$totpajakdimuka = $totpajakdimuka + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6"> Total Pajak Dibayar Dimuka </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totpajakdimuka); ?></td><td></td>
</tr>
<!-- Pajak Di Bayar Dimuka -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Hutang Usaha </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($hutangusaha as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$tothutangusaha = $tothutangusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6"> Total Hutang Usaha </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($tothutangusaha); ?></td><td></td>
</tr>
<!-- Hutang Usaha -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Non Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Hutang Non Usaha </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($hutangnonusaha as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$tothutangnonusaha = $tothutangnonusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Hutang Non Usaha </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($tothutangnonusaha); ?></td><td></td>
</tr>
<!-- Hutang Non Usaha-->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Pajak -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Hutang Pajak </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($hutangpajak as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$tothutangpajak = $tothutangpajak + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Hutang Pajak </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($tothutangpajak); ?></td><td></td>
</tr>
<!-- Hutang Pajak -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Jangka Panjang -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Hutang Jangka Panjang </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($hutangpanjang as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$tothutangpanjang = $tothutangpanjang + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Hutang Jangka Panjang </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($tothutangpanjang); ?></td><td></td>
</tr>
<!-- Hutang Jangka Panjang -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Lain -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Hutang Lain </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($hutanglain as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$tothutanglain = $tothutanglain + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($tothutanglain); ?></td><td></td>
</tr>
<!-- Hutang Lain -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>


<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6"> Total Kewajiban </td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"><?php $kewajiban = $totpajakdimuka + $tothutangusaha + $tothutangnonusaha + $tothutangpajak + $tothutangpanjang + $tothutanglain;  echo num_format($kewajiban); ?></td><td></td>
</tr>
<!-- Kewajiban -->

<tr style="height:10px">
<td></td><td colspan="9" class="s6"></td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"></td><td></td>
</tr>

<!-- Modal -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6"> Modal </td><td></td><td></td><td></td><td></td><td></td>
<td rowspan="2" class="s1"> </td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Modal -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Modal </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($modal as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		}
		
		$totmodal = $totmodal + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6"> Total Modal </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totmodal); ?></td><td></td>
</tr>
<!-- Modal -->

<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Laba -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Laba </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($laba as $res)
	{
		if (get_vamount_balance($currency,$res->id,$months,$years) != 0)
		{
			echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_vamount_balance($currency,$res->id,$months,$years))." </td><td></td>
              </tr>";
		}
		$totlaba = $totlaba + floatval(get_vamount_balance($currency,$res->id,$months,$years));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6"> Total Laba </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totlaba); ?></td><td></td>
</tr>
<!-- Laba -->


<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6"> Total Modal </td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"><?php $modaltot = $totmodal + $totlaba;  echo num_format($modaltot); ?></td><td></td>
</tr>
<!-- Modal -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:18px">
<td></td><td colspan="9" class="s8"> Total Kewajiban dan Modal </td><td></td><td></td><td></td><td></td><td></td>
<td class="s9"> <?php echo num_format($kewajiban+$modaltot); ?> </td><td></td>
</tr>
<tr style="height:10px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

</table>
</body></html>
