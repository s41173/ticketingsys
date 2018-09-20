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
	
	$totincome = 0;
	$totfrontincome = 0;
	$pendapatan = 0;
	$tothpp = 0;
	$totothercost = 0;
	$totfrontcost = 0;
	$biayaataspendapatan = 0;
	$lrkotor = 0;
	$totoperationalcost = 0;
	$totnonoperationalcost = 0;
	$lroperasi = 0;
	$totoutincome = 0;
	$totoutcost = 0;
	$lrbersih = 0;
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0,$em=0,$ey=0)
	{
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$em,$ey)->row();
		return floatval($res->vamount);
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
<td colspan="17" class="s2">Profit & Loss</td>
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

<!-- Pendapatan -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pendapatan</td><td></td><td></td><td></td><td></td><td></td>
<td rowspan="2" class="s1"><?php echo $currency; ?></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pendapatan Usaha-->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Pendapatan Usaha</td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($income as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$totincome = $totincome + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Pendapatan Usaha</td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totincome); ?></td><td></td>
</tr>
<!--Pendapatan Usaha-->

<!--Pendapatan Terima Dimuka-->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Pendapatan Terima Dimuka </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->

<!--<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td colspan="3" class="s0">410-11</td><td></td><td colspan="5" class="s0">Pendapatan SPP - SMP</td><td></td><td class="s1"><a href="01/06/2014">42.900.000.00</a></td><td></td>
</tr>-->

<?php 
	foreach($frontincome as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$totfrontincome = $totfrontincome + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Pendapatan Terima Dimuka </td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totfrontincome); ?></td><td></td>
</tr>
<!--Pendapatan Terima Dimuka-->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pendapatan</td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"><?php $pendapatan = $totincome + $totfrontincome;  echo num_format($pendapatan); ?></td><td></td>
</tr>
<!-- Pendapatan -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Biaya atas Pendapatan</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Biaya Usaha</td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Looping -->
<?php 
	foreach($hpp as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$tothpp = $tothpp + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>
<!-- Looping -->
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Biaya Usaha</td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($tothpp); ?> </td><td></td>
</tr>
<!-- Biaya Usaha -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha Lainnya -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Biaya Usaha Lainnya</td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!--Looping-->
<?php 
	foreach($othercost as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$totothercost = $totothercost + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>
<!--Looping-->
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Biaya Usaha Lainnya</td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($totothercost); ?> </td><td></td>
</tr>
<!-- Biaya Usaha Lainnya -->

<!-- Biaya Dibayar Dimuka -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Biaya Dibayar Dimuka </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!--Looping-->
<?php 
	foreach($frontcost as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$totfrontcost = $totfrontcost + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>
<!--Looping-->
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6"> Total Biaya Dibayar Dimuka </td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($totfrontcost); ?> </td><td></td>
</tr>
<!-- Biaya Dibayar Dimuka -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Biaya atas Pendapatan</td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php $biayaataspendapatan = $tothpp + $totothercost + $totfrontcost; echo num_format($biayaataspendapatan); ?> </td><td></td>
</tr>
<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s8">Laba/Rugi Kotor</td><td></td><td></td><td></td><td></td><td></td>
<td class="s9"> <?php $lrkotor = $pendapatan - $biayaataspendapatan; echo num_format($lrkotor); ?> </td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pengeluaran Operasional -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pengeluaran Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Adm&Umum -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Biaya Administrasi &amp; Umum</td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Loop-->
<?php 
	foreach($operationalcost as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$totoperationalcost = $totoperationalcost + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>
<!--Loop-->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Biaya Administrasi &amp; Umum</td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($totoperationalcost); ?> </td><td></td>
</tr>
<!-- Biaya Adm&Umum -->

<tr style="height:0px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!--<tr style="height:1px">
<td colspan="17" class="s10" style="font-size:1px">&nbsp;</td>
</tr>-->
<tr style="height:1px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!--<tr style="height:18px">
<td colspan="6" class="s0">Halaman : 1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="4" class="s1" style="font-size:1px">&nbsp;</td>
</tr>-->
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="page_break">
<tr style="height: 1px"><td width="60"></td><td width="8"></td><td width="4"></td><td width="53"></td><td width="40"></td><td width="14"></td>
<td width="15"></td><td width="33"></td><td width="1"></td><td width="155"></td><td width="53"></td><td width="3"></td>
<td width="12"></td><td width="40"></td><td width="1"></td><td width="113"></td><td width="114"></td></tr>
<tr style="height:7px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pengeluaran Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pengeluaran Operasional</td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totoperationalcost); ?></td><td></td>
</tr>
<!-- Pengeluaran Operasional -->

<tr style="height:18px">
<td></td><td colspan="9" class="s6"></td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"></td><td></td>
</tr>

<!-- Pengeluaran Non Operasional -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pengeluaran Non Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Non Operasional -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Biaya Non Operasional </td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Loop-->
<?php 
	foreach($nonoperationalcost as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$totnonoperationalcost = $totnonoperationalcost + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>
<!--Loop-->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Biaya Non Operasional </td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($totnonoperationalcost); ?> </td><td></td>
</tr>
<!-- Biaya Non Operasional -->

<tr style="height:0px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!--<tr style="height:1px">
<td colspan="17" class="s10" style="font-size:1px">&nbsp;</td>
</tr>-->
<tr style="height:1px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!--<tr style="height:18px">
<td colspan="6" class="s0">Halaman : 1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="4" class="s1" style="font-size:1px">&nbsp;</td>
</tr>-->

<tr style="height: 1px"><td width="60"></td><td width="8"></td><td width="4"></td><td width="53"></td><td width="40"></td><td width="14"></td>
<td width="15"></td><td width="33"></td><td width="1"></td><td width="155"></td><td width="53"></td><td width="3"></td>
<td width="12"></td><td width="40"></td><td width="1"></td><td width="113"></td><td width="114"></td></tr>
<tr style="height:7px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pengeluaran Non Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pengeluaran Non Operasional</td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"><?php echo num_format($totnonoperationalcost); ?></td><td></td>
</tr>
<!-- Pengeluaran Non Operasional -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s8">Laba/Rugi Operasi</td><td></td><td></td><td></td><td></td><td></td>
<td class="s9"><?php $lroperasi = $lrkotor - $totoperationalcost + $totnonoperationalcost; echo num_format($lroperasi); ?></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pendapatan Lain-->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pendapatan Lain</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Luar Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Pendapatan Luar Usaha</td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Loop -->
<?php 
	foreach($outincome as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$totoutincome = $totoutincome + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>
<!-- Loop -->
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Pendapatan Luar Usaha</td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($totoutincome); ?> </td><td></td>
</tr>
<!-- Pendapatan Luar Usaha -->
<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pendapatan Lain</td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($totoutincome); ?> </td><td></td>
</tr>
<!--Pendapatan Lain-->

<!--Pengeluaran Lain-->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pengeluaran Lain</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Pengeluaran Luar Usaha</td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Loop -->
<?php 
	foreach($outcost as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
		      <td colspan=\"3\" class=\"s0\">".$res->code."</td> <td></td> <td colspan=\"5\" class=\"s0\"> ".$res->name." </td> <td></td> 
			  <td class=\"s1\"> ".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))." </td><td></td>
              </tr>";
		$totoutcost = $totoutcost + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>
<!-- Loop -->
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Pengeluaran Luar Usaha</td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($totoutcost); ?> </td><td></td>
</tr>
<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pengeluaran Lain</td><td></td><td></td><td></td><td></td><td></td>
<td class="s7"> <?php echo num_format($totoutcost); ?> </td><td></td>
</tr>
<!--Pengeluaran Lain-->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s8">Laba/Rugi Bersih</td><td></td><td></td><td></td><td></td><td></td>
<td class="s9"> <?php $lrbersih = $lroperasi + $totoutincome - $totoutcost; echo num_format($lrbersih); ?> </td><td></td>
</tr>
<tr style="height:10px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

</table>
</body></html>
