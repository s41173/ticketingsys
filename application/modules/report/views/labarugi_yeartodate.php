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
<body
 bgcolor="#FFFFFF" text="#000000">
<a name="PageN1"></a>

<?php
	
	$totincome = 0; $totincome_year = 0; 
	$totfrontincome = 0; $totfrontincome_year = 0;
	$pendapatan = 0; $pendapatan_year = 0;
	$tothpp = 0; $tothpp_year = 0;
	$totothercost = 0; $totothercost_year = 0;
	$totfrontcost = 0; $totfrontcost_year = 0;
	$biayaataspendapatan = 0; $biayaataspendapatan_year = 0;
	$lrkotor = 0; $lrkotor_year = 0;
	$totoperationalcost = 0; $totoperationalcost_year = 0;
	$totnonoperationalcost = 0; $totnonoperationalcost_year = 0;
	$lroperasi = 0; $lroperasi_year = 0;
	$totoutincome = 0; $totoutincome_year = 0;
	$totoutcost = 0; $totoutcost_year = 0;
	$lrbersih = 0; $lrbersih_year = 0;
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0,$em=0,$ey=0)
	{
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$em,$ey)->row();
		return floatval($res->vamount);
	}
	
	function get_year_amount($cur='IDR',$acc,$ey=0)
	{
		$am = new Account_model();
		$res = $am->get_annual_period_balance($cur,$acc,$ey)->row();
		return floatval($res->vamount);
	}
	
?>

<table align="center" width="920px" border="0" cellspacing="0" cellpadding="0">
<tr style="height: 1px"><td width="34"></td><td width="34"></td><td width="4"></td><td width="26"></td><td width="13"></td><td width="61"></td><td width="1"></td><td width="4"></td><td width="15"></td><td width="162"></td><td width="53"></td><td width="4"></td><td width="11"></td><td width="7"></td><td width="5"></td><td width="15"></td><td width="87"></td><td width="8"></td><td width="113"></td><td width="61"></td></tr>
<tr style="height:18px">
<td colspan="2" class="s0"></td><td></td><td colspan="6" class="s0"> <?php echo date('d M Y').' - '.waktuindo(); ?> </td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="5" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:22px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:24px">
<td colspan="20" rowspan="2" class="s3"><?php echo isset($company) ? $company : ''; ?></td>
</tr>
<tr style="height:2px">
</tr>
<tr style="height:24px">
<td colspan="20" class="s2">Profit and Loss</td>
</tr>
<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:26px">
<td colspan="20" class="s4"><?php echo get_month($months).' '.$years.' - '.get_month($emonths).' '.$eyears; ?></td>
</tr>
<tr style="height:24px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="4" class="s5">Balance</td><td></td><td class="s5">Year to Date</td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pendapatan</td><td></td><td></td><td></td><td colspan="4" rowspan="2" class="s1"><?php echo $currency; ?></td><td></td><td rowspan="2" class="s1"><?php echo $currency; ?></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pendapatan Usaha-->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Pendapatan Usaha</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 

	foreach($income as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
			  <td class=\"s0\">".$res->code."</td><td></td> <td colspan=\"7\" class=\"s0\">".$res->name."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td class=\"s1\">".num_format(get_year_amount($currency,$res->id,$eyears))."</td><td></td>
              </tr>
		     ";
		
		$totincome = $totincome + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totincome_year = $totincome_year + floatval(get_year_amount($currency,$res->id,$eyears));  
	}
?>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Pendapatan Usaha</td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totincome); ?></td><td></td>
<td class="s7"><?php echo num_format($totincome_year); ?></td><td></td>
</tr>
<!--Pendapatan Usaha-->

<!--Pendapatan Terima Dimuka -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6">Pendapatan Usaha Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 

	foreach($frontincome as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
			  <td class=\"s0\">".$res->code."</td><td></td> <td colspan=\"7\" class=\"s0\">".$res->name."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td class=\"s1\">".num_format(get_year_amount($currency,$res->id,$eyears))."</td><td></td>
              </tr>
		     ";
		
		$totfrontincome = $totfrontincome + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totfrontincome_year = $totfrontincome_year + floatval(get_year_amount($currency,$res->id,$eyears));  
	}
?>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Pendapatan Usaha Lainnya </td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totfrontincome); ?></td><td></td>
<td class="s7"><?php echo num_format($totfrontincome_year); ?></td><td></td>
</tr>

<!--Pendapatan Terima Dimuka -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pendapatan</td><td></td><td></td><td></td>
<td colspan="4" class="s7"><?php $pendapatan = $totincome + $totfrontincome;  echo num_format($pendapatan); ?></td><td></td>
<td class="s7"><?php $pendapatan_year = $totincome_year + $totfrontincome_year;  echo num_format($pendapatan_year); ?></td><td></td>
</tr>
<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Biaya atas Pendapatan</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Biaya Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 

	foreach($hpp as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
			  <td class=\"s0\">".$res->code."</td><td></td> <td colspan=\"7\" class=\"s0\">".$res->name."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td class=\"s1\">".num_format(get_year_amount($currency,$res->id,$eyears))."</td><td></td>
              </tr>
		     ";
		
		$tothpp = $tothpp + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothpp_year = $tothpp_year + floatval(get_year_amount($currency,$res->id,$eyears));  
	}
?>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Biaya Usaha</td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($tothpp); ?></td><td></td>
<td class="s7"><?php echo num_format($tothpp_year); ?></td><td></td>
</tr>
<!-- Biaya Usaha -->

<!-- Biaya Usaha Lainnya -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Biaya Usaha Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 

	foreach($hpp as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
			  <td class=\"s0\">".$res->code."</td><td></td> <td colspan=\"7\" class=\"s0\">".$res->name."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td class=\"s1\">".num_format(get_year_amount($currency,$res->id,$eyears))."</td><td></td>
              </tr>
		     ";
		
		$tothpp = $tothpp + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothpp_year = $tothpp_year + floatval(get_year_amount($currency,$res->id,$eyears));  
	}
?>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Biaya Usaha Lainnya</td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($tothpp); ?></td><td></td>
<td class="s7"><?php echo num_format($tothpp_year); ?></td><td></td>
</tr>
<!-- Biaya Usaha Lainnya -->


<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Biaya atas Pendapatan</td><td></td><td></td><td></td>
<td colspan="4" class="s7"><?php $biayaataspendapatan = $tothpp + $totothercost + $totfrontcost; echo num_format($biayaataspendapatan); ?></td><td></td>
<td class="s7"><?php $biayaataspendapatan_year = $tothpp_year + $totothercost_year + $totfrontcost_year; echo num_format($biayaataspendapatan_year); ?></td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s8">Gross Margin</td><td></td><td></td><td></td>
<td colspan="4" class="s9"><?php $lrkotor = $pendapatan - $biayaataspendapatan; echo num_format($lrkotor); ?></td><td></td>
<td class="s9"><?php $lrkotor_year = $pendapatan_year - $biayaataspendapatan_year; echo num_format($lrkotor_year); ?></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pengeluaran Operasional -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pengeluaran Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Operasional -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Biaya Operasional </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 

	foreach($operationalcost as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
			  <td class=\"s0\">".$res->code."</td><td></td> <td colspan=\"7\" class=\"s0\">".$res->name."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td class=\"s1\">".num_format(get_year_amount($currency,$res->id,$eyears))."</td><td></td>
              </tr>
		     ";
		
		$totoperationalcost = $totoperationalcost + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totoperationalcost_year = $totoperationalcost_year + floatval(get_year_amount($currency,$res->id,$eyears));  
	}
?>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Biaya Operasional</td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totoperationalcost); ?></td><td></td>
<td class="s7"><?php echo num_format($totoperationalcost_year); ?></td><td></td>
</tr>
<!-- Biaya Operasional -->

<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pengeluaran Operasional</td><td></td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totoperationalcost); ?></td><td></td>
<td class="s7"><?php echo num_format($totoperationalcost_year); ?></td><td></td>
</tr>

<!-- Pengeluaran Operasional -->

<!-- Pengeluaran Non Operasional -->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pengeluaran Non Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Non Operasional -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Biaya Non Operasional </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 

	foreach($nonoperationalcost as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
			  <td class=\"s0\">".$res->code."</td><td></td> <td colspan=\"7\" class=\"s0\">".$res->name."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td class=\"s1\">".num_format(get_year_amount($currency,$res->id,$eyears))."</td><td></td>
              </tr>
		     ";
		
		$totnonoperationalcost = $totnonoperationalcost + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totnonoperationalcost_year = $totnonoperationalcost_year + floatval(get_year_amount($currency,$res->id,$eyears));  
	}
?>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Biaya Non Operasional</td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totnonoperationalcost); ?></td><td></td>
<td class="s7"><?php echo num_format($totnonoperationalcost_year); ?></td><td></td>
</tr>
<!-- Biaya Operasional -->

<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pengeluaran Non Operasional</td><td></td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totnonoperationalcost); ?></td><td></td>
<td class="s7"><?php echo num_format($totnonoperationalcost_year); ?></td><td></td>
</tr>

<!-- Pengeluaran Non Operasional -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s8">Operating Profit</td><td></td><td></td><td></td>
<td colspan="4" class="s9"><?php $lroperasi = $lrkotor - $totoperationalcost + $totnonoperationalcost; echo num_format($lroperasi); ?></td><td></td>
<td class="s9"><?php $lroperasi_year = $lrkotor_year - $totoperationalcost_year + $totnonoperationalcost_year; echo num_format($lroperasi_year); ?></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pendapatan Lain-->
<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pendapatan Lain</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Luar Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Pendapatan Luar Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 

	foreach($outincome as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
			  <td class=\"s0\">".$res->code."</td><td></td> <td colspan=\"7\" class=\"s0\">".$res->name."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td class=\"s1\">".num_format(get_year_amount($currency,$res->id,$eyears))."</td><td></td>
              </tr>
		     ";
		
		$totoutincome = $totoutincome + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totoutincome_year = $totoutincome_year + floatval(get_year_amount($currency,$res->id,$eyears));  
	}
?>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Pendapatan Luar Usaha</td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totoutincome); ?></td><td></td>
<td class="s7"><?php echo num_format($totoutincome_year); ?></td><td></td>
</tr>
<!-- Pendapatan Luar Usaha -->

<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pendapatan Lain</td><td></td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totoutincome); ?></td><td></td>
<td class="s7"><?php echo num_format($totoutincome_year); ?></td><td></td>
</tr>
<!--Pendapatan Lain-->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pengeluaran Lain-->

<tr style="height:16px">
<td></td><td colspan="9" class="s6">Pengeluaran Lain</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pengeluaran Luar Usaha-->

<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s6"> Pengeluaran Luar Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 

	foreach($outcost as $res)
	{
		echo "<tr style=\"height:15px\"> <td></td><td></td><td></td><td></td><td></td>
			  <td class=\"s0\">".$res->code."</td><td></td> <td colspan=\"7\" class=\"s0\">".$res->name."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td class=\"s1\">".num_format(get_year_amount($currency,$res->id,$eyears))."</td><td></td>
              </tr>
		     ";
		
		$totoutcost = $totoutcost + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totoutcost_year = $totoutcost_year + floatval(get_year_amount($currency,$res->id,$eyears));  
	}
?>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s6">Total Pengeluaran Luar Usaha</td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totoutcost); ?></td><td></td>
<td class="s7"><?php echo num_format($totoutcost_year); ?></td><td></td>
</tr>

<!--Pengeluaran Luar Usaha-->

<tr style="height:18px">
<td></td><td colspan="9" class="s6">Total Pengeluaran Lain</td><td></td><td></td><td></td>
<td colspan="4" class="s7"><?php echo num_format($totoutcost); ?></td><td></td>
<td class="s7"><?php echo num_format($totoutcost_year); ?></td><td></td>
</tr>

<!--Pengeluaran Lain-->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s8">Net Profit</td><td></td><td></td><td></td>
<td colspan="4" class="s9"><?php $lrbersih = $lroperasi + $totoutincome - $totoutcost; echo num_format($lrbersih); ?></td><td></td>
<td class="s9"><?php $lrbersih_year = $lroperasi_year + $totoutincome_year - $totoutcost_year; echo num_format($lrbersih_year); ?></td><td></td>
</tr>
<tr style="height:24px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:1px">
<td colspan="20" class="s10" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:1px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td colspan="8" class="s0"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="4" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
</table>
</body></html>
