<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name=Generator content="FastReport 3.0 http://www.fast-report.com">
<title> <?php echo isset($title) ? $title : ''; ?>  </title>

<style type="text/css"> <!-- 
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
 font-size: 11px;
 color: #800000; font-weight: bold; font-style: normal;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 0px;
 border-bottom-width: 1;
 text-align: Center; vertical-align: Top;
}
.s5 {
 font-family: Arial;
 font-size: 11px;
 color: #434889; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s6 {
 font-family: Arial;
 font-size: 11px;
 color: #434889; font-weight: bold; font-style: normal;;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 1;
 border-bottom-width: 0px;
 text-align: Right; vertical-align: Top;
}
.s7 {
 font-family: Arial;
 font-size: 11px;
 color: #80334A; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s8 {
 font-family: Arial;
 font-size: 11px;
 color: #80334A; font-weight: bold; font-style: normal;;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 1;
 border-bottom-width: 0px;
 text-align: Right; vertical-align: Top;
}
.s9 {
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
<body bgcolor="#FFFFFF" text="#000000">

<a name="PageN1"></a>

<?php
	
	$totincome = 0; $totincome2 = 0; $totincome_budget=0; $totincome2_budget=0;
	$totfrontincome = 0; $totfrontincome2 = 0; $totfrontincome_budget = 0; $totfrontincome2_budget = 0;
	$pendapatan = 0; $pendapatan2 = 0; $pendapatan_budget = 0; $pendapatan2_budget = 0;
	$tothpp = 0; $tothpp2 = 0; $tothpp_budget = 0; $tothpp2_budget = 0;
	$totothercost = 0; $totothercost2 = 0; $totothercost_budget = 0; $totothercost2_budget = 0;
	$totfrontcost = 0; $totfrontcost2 = 0; $totfrontcost_budget =0 ; $totfrontcost2_budget = 0;
	$biayaataspendapatan = 0; $biayaataspendapatan2 = 0; $biayaataspendapatan_budget = 0; $biayaataspendapatan2_budget = 0;
	$lrkotor = 0; $lrkotor2 = 0; $lrkotor_budget = 0; $lrkotor2_budget = 0;
	$totoperationalcost = 0; $totoperationalcost2 = 0; $totoperationalcost_budget = 0; $totoperationalcost2_budget = 0;
	$totnonoperationalcost = 0; $totnonoperationalcost2 = 0; $totnonoperationalcost_budget = 0; $totnonoperationalcost2_budget = 0;
	$lroperasi = 0; $lroperasi2 = 0; $lroperasi_budget = 0; $lroperasi2_budget = 0;
	$totoutincome = 0; $totoutincome2 = 0; $totoutincome_budget = 0; $totoutincome2_budget = 0;
	$totoutcost = 0; $totoutcost2 = 0; $totoutcost_budget = 0; $totoutcost2_budget = 0;
	$lrbersih = 0; $lrbersih2 = 0; $lrbersih_budget = 0; $lrbersih2_budget = 0;
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0)
	{
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$m,$y)->row();
		return floatval($res->vamount);
	}
	
	function get_acc_budget($cur='IDR',$acc,$m=0,$y=0)
	{
		$am = new Account_model();
		$res = $am->get_budget($cur,$acc,$m,$y)->row();
		return floatval($res->budget);
	}
	
?>

<table align="center" width="920px" border="0" cellspacing="0" cellpadding="0">
<tr style="height: 1px"><td width="41"></td><td width="21"></td><td width="6"></td><td width="4"></td><td width="44"></td><td width="1"></td><td width="61"></td><td width="15"></td><td width="105"></td><td width="3"></td><td width="1"></td><td width="2"></td><td width="100"></td><td width="6"></td><td width="25"></td><td width="15"></td><td width="58"></td><td width="2"></td><td width="5"></td><td width="3"></td><td width="97"></td><td width="5"></td><td width="99"></td><td width="1"></td></tr>
<tr style="height:18px">
<td colspan="3" class="s0"></td><td></td><td colspan="4" class="s0"> <?php echo date('d M Y').' - '.waktuindo(); ?> </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="8" class="s1" style="font-size:1px">&nbsp;</td><td></td>
</tr>
<tr style="height:22px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:24px">
<td colspan="23" rowspan="2" class="s3"><?php echo isset($company) ? $company : ''; ?></td><td></td>
</tr>
<tr style="height:2px">
<td></td>
</tr>
<tr style="height:24px">
<td colspan="23" class="s2">Profit and Loss</td><td></td>
</tr>
<tr style="height:44px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="5" class="s4"><?php echo get_month($months).' '.$years; ?></td><td></td><td></td><td></td><td colspan="3" class="s4"><?php echo get_month($emonths).' '.$eyears; ?></td><td></td>
</tr>

<!-- Pendapatan -->
<tr style="height:16px">
<td colspan="10" class="s5">Pendapatan</td><td></td><td></td><td rowspan="2" class="s1">Real (<?php echo $currency; ?>)</td><td></td><td colspan="4" rowspan="2" class="s1">Budget (<?php echo $currency; ?>)</td><td></td><td colspan="2" rowspan="2" class="s1">Real (<?php echo $currency; ?>)</td><td></td><td colspan="2" rowspan="2" class="s1">Budget (<?php echo $currency; ?>)</td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pendapatan Usaha-->
<tr style="height:16px">
<td></td><td colspan="9" class="s5">Pendapatan Usaha</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($income as $res)
	{
		echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
		
		$totincome = $totincome + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totincome_budget = $totincome_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totincome2 = $totincome2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totincome2_budget = $totincome2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Pendapatan Usaha</td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totincome); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totincome_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totincome2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totincome2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pendapatan Usaha-->

<!--Pendapatan Dimuka-->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Pendapatan Usaha Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($frontincome as $res)
	{
		echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
		
		$totfrontincome = $totfrontincome + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totfrontincome_budget = $totfrontincome_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totfrontincome2 = $totfrontincome2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totfrontincome2_budget = $totfrontincome2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Pendapatan Usaha Lainnya </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totfrontincome); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totfrontincome_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totfrontincome2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totfrontincome2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!--Pendapatan Dimuka-->


<tr style="height:18px">
<td colspan="11" class="s5">Total Pendapatan</td><td></td>
<td class="s6"><?php $pendapatan = $totincome + $totfrontincome;  echo num_format($pendapatan); ?></td><td></td>
<td colspan="4" class="s6"><?php $pendapatan_budget = $totincome_budget + $totfrontincome_budget;  echo num_format($pendapatan_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php $pendapatan2 = $totincome2 + $totfrontincome2;  echo num_format($pendapatan2); ?></td><td></td>
<td colspan="2" class="s6"><?php $pendapatan2_budget = $totincome2_budget + $totfrontincome2_budget;  echo num_format($pendapatan2_budget); ?></td>
</tr>
<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:16px">
<td colspan="10" class="s5">Biaya atas Pendapatan</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Biaya Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($hpp as $res)
	{
		echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
		
		$tothpp = $tothpp + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$tothpp_budget = $tothpp_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$tothpp2 = $tothpp2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $tothpp2_budget = $tothpp2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Biaya Usaha</td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($tothpp); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($tothpp_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothpp2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothpp2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha -->

<!-- Biaya Usaha Lainnya -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Biaya Usaha Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($othercost as $res)
	{
		echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
		
		$totothercost = $totothercost + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totothercost_budget = $totothercost_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totothercost2 = $totothercost2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totothercost2_budget = $totothercost2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Biaya Usaha Lainnya</td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totothercost); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totothercost_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totothercost2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totothercost2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha Lainnya -->


<tr style="height:18px">
<td colspan="11" class="s5">Total Biaya atas Pendapatan</td><td></td>
<td class="s6"><?php $biayaataspendapatan = $tothpp + $totothercost + $totfrontcost; echo num_format($biayaataspendapatan); ?></td><td></td>
<td colspan="4" class="s6"><?php $biayaataspendapatan_budget = $tothpp_budget + $totothercost_budget + $totfrontcost_budget; echo num_format($biayaataspendapatan_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php $biayaataspendapatan2 = $tothpp2 + $totothercost2 + $totfrontcost2; echo num_format($biayaataspendapatan2); ?></td><td></td>
<td colspan="2" class="s6"><?php $biayaataspendapatan2_budget = $tothpp2_budget + $totothercost2_budget + $totfrontcost2_budget; echo num_format($biayaataspendapatan2_budget); ?></td>
</tr>


<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:18px">
<td colspan="11" class="s7">Gross Margin</td><td></td>
<td class="s8"><?php $lrkotor = $pendapatan - $biayaataspendapatan; echo num_format($lrkotor); ?></td><td></td>
<td colspan="4" class="s8"><?php $lrkotor_budget = $pendapatan_budget - $biayaataspendapatan_budget; echo num_format($lrkotor_budget); ?></td><td></td>
<td colspan="2" class="s8"><?php $lrkotor2 = $pendapatan2 - $biayaataspendapatan2; echo num_format($lrkotor2); ?></td><td></td>
<td colspan="2" class="s8"><?php $lrkotor2_budget = $pendapatan2_budget - $biayaataspendapatan2_budget; echo num_format($lrkotor2_budget); ?></td>
</tr>

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pengeluaran Operasional -->
<tr style="height:16px">
<td colspan="10" class="s5">Pengeluaran Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Operasional -->

<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Biaya Operasional </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($operationalcost as $res)
	{
		echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
		
		$totoperationalcost = $totoperationalcost + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totoperationalcost_budget = $totoperationalcost_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totoperationalcost2 = $totoperationalcost2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totoperationalcost2_budget = $totoperationalcost2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Biaya Operasional</td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totoperationalcost); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totoperationalcost_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoperationalcost2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoperationalcost2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Operasional -->

<tr style="height:18px">
<td colspan="11" class="s5">Total Pengeluaran Operasional</td><td></td>
<td class="s6"><?php echo num_format($totoperationalcost); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totoperationalcost_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoperationalcost2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoperationalcost2_budget); ?></td>
</tr>

<!-- Pengeluaran Operasional -->

<!-- Pengeluaran Non Operasional -->
<tr style="height:16px">
<td colspan="10" class="s5">Pengeluaran Non Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Operasional -->

<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Biaya Non Operasional </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($nonoperationalcost as $res)
	{
		echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
		
		$totoperationalcost = $totoperationalcost + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totoperationalcost_budget = $totoperationalcost_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totoperationalcost2 = $totoperationalcost2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totoperationalcost2_budget = $totoperationalcost2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Biaya Non Operasional</td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totoperationalcost); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totoperationalcost_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoperationalcost2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoperationalcost2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Non Operasional -->

<tr style="height:18px">
<td colspan="11" class="s5">Total Pengeluaran Non Operasional</td><td></td>
<td class="s6"><?php echo num_format($totoperationalcost); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totoperationalcost_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoperationalcost2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoperationalcost2_budget); ?></td>
</tr>

<!-- Pengeluaran Non Operasional -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td colspan="11" class="s7">Operating Profit</td><td></td>
<td class="s8"><?php $lroperasi = $lrkotor - $totoperationalcost + $totnonoperationalcost; echo num_format($lroperasi); ?></td><td></td>
<td colspan="4" class="s8"><?php $lroperasi_budget = $lrkotor_budget - $totoperationalcost_budget + $totnonoperationalcost_budget; echo num_format($lroperasi_budget); ?></td><td></td>
<td colspan="2" class="s8"><?php $lroperasi2 = $lrkotor2 - $totoperationalcost2 + $totnonoperationalcost2; echo num_format($lroperasi2); ?></td><td></td>
<td colspan="2" class="s8"><?php $lroperasi2_budget = $lrkotor2_budget - $totoperationalcost2_budget + $totnonoperationalcost2_budget; echo num_format($lroperasi2_budget); ?></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Lain -->
<tr style="height:16px">
<td colspan="10" class="s5">Pendapatan Lain</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Luar Usaha -->

<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Pendapatan Luar Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($outincome as $res)
	{
		echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
		
		$totoutincome = $totoutincome + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totoutincome_budget = $totoutincome_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totoutincome2 = $totoutincome2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totoutincome2_budget = $totoutincome2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Pendapatan Luar Usaha </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totoutincome); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totoutincome_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoutincome2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoutincome2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Luar Usaha -->

<tr style="height:18px">
<td colspan="11" class="s5">Total Pendapatan Lain </td><td></td>
<td class="s6"><?php echo num_format($totoutincome); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totoutincome_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoutincome2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoutincome2_budget); ?></td>
</tr>
<!-- Pendapatan Lain -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pengeluaran Lain -->
<tr style="height:16px">
<td colspan="10" class="s5">Pengeluaran Lain</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pengeluaran Luar Usaha -->

<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Pengeluaran Luar Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($outcost as $res)
	{
		echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
		
		$totoutcost = $totoutcost + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totoutcost_budget = $totoutcost_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totoutcost2 = $totoutcost2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totoutcost2_budget = $totoutcost2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Pengeluaran Luar Usaha </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totoutcost); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totoutcost_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoutcost2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoutcost2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pengeluaran Luar Usaha -->

<tr style="height:18px">
<td colspan="11" class="s5">Total Pengeluaran Lain</td><td></td>
<td class="s6"><?php echo num_format($totoutcost); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totoutcost_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoutcost2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totoutcost2_budget); ?></td>
</tr>
<!-- Pengeluaran Lain -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td colspan="11" class="s7">Net Profit</td><td></td>
<td class="s8"><?php $lrbersih = $lroperasi + $totoutincome - $totoutcost; echo num_format($lrbersih); ?></td><td></td>
<td colspan="4" class="s8"><?php $lrbersih_budget = $lroperasi_budget + $totoutincome_budget - $totoutcost_budget; echo num_format($lrbersih_budget); ?></td><td></td>
<td colspan="2" class="s8"><?php $lrbersih2 = $lroperasi2 + $totoutincome2 - $totoutcost2; echo num_format($lrbersih2); ?></td><td></td>
<td colspan="2" class="s8"><?php $lrbersih2_budget = $lroperasi2_budget + $totoutincome2_budget - $totoutcost2_budget; echo num_format($lrbersih2_budget); ?></td>
</tr>
<tr style="height:28px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:1px">
<td colspan="23" class="s9" style="font-size:1px">&nbsp;</td><td></td>
</tr>
<tr style="height:1px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td colspan="7" class="s0"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="7" class="s1" style="font-size:1px">&nbsp;</td><td></td>
</tr>
</table>
</body></html>
