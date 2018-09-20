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
 font-size: 11px;
 color: #800000; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s7 {
 font-family: Arial;
 font-size: 11px;
 color: #434889; font-weight: bold; font-style: normal;;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s8 {
 font-family: Arial;
 font-size: 11px;
 color: #000080; font-weight: bold; font-style: normal;;;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s9 {
 font-family: Arial;
 font-size: 11px;
 color: #434889; font-style: normal;;;;
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
<body bgcolor="#FFFFFF" text="#000000">

<?php

    function get_bulan($month,$year)
	{
		$a = $month;
		$value = null;
		for ($x = 1; $x <= 12; $x++)
		{
		  if ($a > 12){$a=1; $year=$year+1;}		
		  $value[$x][0] = $a;
		  $value[$x][1] = $year;
		  $a++;
		}
		return $value;
	}
		
	$mo = get_bulan($months,$years);
	
	$totincome[0] = 0; $totincome[1] = 0; $totincome[2] = 0; $totincome[3] = 0; $totincome[4] = 0; $totincome[5] = 0; $totincome[6] = 0; $totincome[7] = 0; $totincome[8] = 0; $totincome[9] = 0; $totincome[10] = 0; $totincome[11] = 0; 
	$totfrontincome[0] = 0; $totfrontincome[1] = 0; $totfrontincome[2] = 0; $totfrontincome[3] = 0; $totfrontincome[4] = 0; $totfrontincome[5] = 0; $totfrontincome[6] = 0; $totfrontincome[7] = 0; $totfrontincome[8] = 0; $totfrontincome[9] = 0; $totfrontincome[10] = 0; $totfrontincome[11] = 0;
	$pendapatan[0] = 0; $pendapatan[1] = 0; $pendapatan[2] = 0; $pendapatan[3] = 0; $pendapatan[4] = 0; $pendapatan[5] = 0; $pendapatan[6] = 0; $pendapatan[7] = 0; $pendapatan[8] = 0; $pendapatan[9] = 0; $pendapatan[10] = 0; $pendapatan[11] = 0;
	$tothpp[0] = 0; $tothpp[1] = 0; $tothpp[2] = 0; $tothpp[3] = 0; $tothpp[4] = 0; $tothpp[5] = 0; $tothpp[6] = 0; $tothpp[7] = 0; $tothpp[8] = 0; $tothpp[9] = 0; $tothpp[10] = 0; $tothpp[11] = 0;
	$totothercost[0] = 0; $totothercost[1] = 0; $totothercost[2] = 0; $totothercost[3] = 0; $totothercost[4] = 0; $totothercost[5] = 0; $totothercost[6] = 0; $totothercost[7] = 0; $totothercost[8] = 0; $totothercost[9] = 0; $totothercost[10] = 0; $totothercost[11] = 0;
	$totfrontcost[0] = 0; $totfrontcost[1] = 0; $totfrontcost[2] = 0; $totfrontcost[3] = 0; $totfrontcost[4] = 0; $totfrontcost[5] = 0; $totfrontcost[6] = 0; $totfrontcost[7] = 0; $totfrontcost[8] = 0; $totfrontcost[9] = 0; $totfrontcost[10] = 0; $totfrontcost[11] = 0;
	$biayaataspendapatan[0] = 0; $biayaataspendapatan[1] = 0; $biayaataspendapatan[2] = 0; $biayaataspendapatan[3] = 0; $biayaataspendapatan[4] = 0; $biayaataspendapatan[5] = 0; $biayaataspendapatan[6] = 0; $biayaataspendapatan[7] = 0; $biayaataspendapatan[8] = 0; $biayaataspendapatan[9] = 0; $biayaataspendapatan[10] = 0; $biayaataspendapatan[11] = 0;
	$lrkotor[0] = 0; $lrkotor[1] = 0; $lrkotor[2] = 0; $lrkotor[3] = 0; $lrkotor[4] = 0; $lrkotor[5] = 0; $lrkotor[6] = 0; $lrkotor[7] = 0; $lrkotor[8] = 0; $lrkotor[9] = 0; $lrkotor[10] = 0;  $lrkotor[11] = 0; 
	$totoperationalcost[0] = 0; $totoperationalcost[1] = 0; $totoperationalcost[2] = 0; $totoperationalcost[3] = 0; $totoperationalcost[4] = 0; $totoperationalcost[5] = 0; $totoperationalcost[6] = 0; $totoperationalcost[7] = 0; $totoperationalcost[8] = 0; $totoperationalcost[8] = 0; $totoperationalcost[9] = 0; $totoperationalcost[10] = 0; $totoperationalcost[11] = 0;
	$totnonoperationalcost[0] = 0; $totnonoperationalcost[1] = 0; $totnonoperationalcost[2] = 0; $totnonoperationalcost[3] = 0; $totnonoperationalcost[4] = 0; $totnonoperationalcost[5] = 0; $totnonoperationalcost[6] = 0; $totnonoperationalcost[7] = 0; $totnonoperationalcost[8] = 0; $totnonoperationalcost[9] = 0; $totnonoperationalcost[10] = 0; $totnonoperationalcost[11] = 0;
	$lroperasi[0] = 0; $lroperasi[1] = 0; $lroperasi[2] = 0; $lroperasi[3] = 0; $lroperasi[4] = 0; $lroperasi[5] = 0; $lroperasi[6] = 0; $lroperasi[7] = 0; $lroperasi[8] = 0; $lroperasi[9] = 0; $lroperasi[10] = 0; $lroperasi[11] = 0;
	$totoutincome[0] = 0; $totoutincome[1] = 0; $totoutincome[2] = 0; $totoutincome[3] = 0; $totoutincome[4] = 0; $totoutincome[5] = 0; $totoutincome[6] = 0; $totoutincome[7] = 0; $totoutincome[8] = 0; $totoutincome[9] = 0; $totoutincome[10] = 0; $totoutincome[11] = 0;
	$totoutcost[0] = 0; $totoutcost[1] = 0; $totoutcost[2] = 0; $totoutcost[3] = 0; $totoutcost[4] = 0; $totoutcost[5] = 0; $totoutcost[6] = 0; $totoutcost[7] = 0; $totoutcost[8] = 0; $totoutcost[9] = 0; $totoutcost[10] = 0; $totoutcost[11] = 0;
	$lrbersih[0] = 0; $lrbersih[1] = 0; $lrbersih[2] = 0; $lrbersih[3] = 0; $lrbersih[4] = 0; $lrbersih[5] = 0; $lrbersih[6] = 0; $lrbersih[7] = 0; $lrbersih[8] = 0; $lrbersih[9] = 0; $lrbersih[10] = 0; $lrbersih[11] = 0;
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0)
	{
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$m,$y)->row();
		return floatval($res->vamount);
	}
	
?>


<a name="PageN1"></a>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr style="height: 1px"><td width="12"></td><td width="2"></td><td width="6"></td><td width="48"></td><td width="4"></td><td width="20"></td><td width="2"></td><td width="83"></td><td width="15"></td><td width="17"></td><td width="1"></td><td width="1"></td><td width="2"></td><td width="61"></td><td width="24"></td><td width="3"></td><td width="12"></td><td width="8"></td><td width="66"></td><td width="3"></td><td width="85"></td><td width="3"></td><td width="85"></td><td width="3"></td><td width="85"></td><td width="3"></td><td width="85"></td><td width="3"></td><td width="85"></td><td width="3"></td><td width="85"></td><td width="3"></td><td width="67"></td><td width="8"></td><td width="7"></td><td width="3"></td><td width="3"></td><td width="85"></td><td width="3"></td><td width="85"></td><td width="3"></td><td width="85"></td><td width="1"></td></tr>
<tr style="height:18px">
<td colspan="4" class="s0"> </td><td></td><td colspan="4" class="s0"> <?php echo date('d M Y').' - '.waktuindo(); ?> </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="10" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:22px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:24px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="20" rowspan="2" class="s3"><?php echo isset($company) ? $company : ''; ?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:24px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="20" class="s2">Profit and Loss</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:12px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:26px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="20" class="s4"> <?php echo get_month($mo[1][0]).' '.$mo[1][1]; ?> - <?php echo get_month($mo[12][0]).' '.$mo[12][1]; ?> </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:22px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:15px">
<td colspan="12" class="s6">Account Name</td><td></td>
<td colspan="2" class="s5"> <?php echo $mo[1][0].' - '.$mo[1][1] ?> </td><td></td>
<td colspan="3" class="s5"> <?php echo $mo[2][0].' - '.$mo[2][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[3][0].' - '.$mo[3][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[4][0].' - '.$mo[4][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[5][0].' - '.$mo[5][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[6][0].' - '.$mo[6][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[7][0].' - '.$mo[7][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[8][0].' - '.$mo[8][1] ?> </td><td></td>
<td colspan="4" class="s5"> <?php echo $mo[9][0].' - '.$mo[9][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[10][0].' - '.$mo[10][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[11][0].' - '.$mo[11][1] ?> </td><td></td>
<td class="s5"> <?php echo $mo[12][0].' - '.$mo[12][1] ?> </td><td></td>
</tr>
<tr style="height:4px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan -->

<tr style="height:16px">
<td colspan="18" class="s7">Pendapatan</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Usaha -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8">Pendapatan Usaha</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($income as $res)
	{
		echo "
		<tr style=\"height:16px\">
        <td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
        </tr>
		";
		
		
		$totincome[0]  = $totincome[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totincome[1]  = $totincome[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totincome[2]  = $totincome[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totincome[3]  = $totincome[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totincome[4]  = $totincome[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totincome[5]  = $totincome[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totincome[6]  = $totincome[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totincome[7]  = $totincome[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totincome[8]  = $totincome[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totincome[9]  = $totincome[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totincome[10] = $totincome[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totincome[11] = $totincome[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7">Total Pendapatan Usaha</td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totincome[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totincome[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totincome[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totincome[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Usaha -->

<!-- Pendapatan Terima Dimuka -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Pendapatan Usaha Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($frontincome as $res)
	{
		echo "
		<tr style=\"height:16px\">
        <td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
        </tr>
		";
		
		
		$totfrontincome[0]  = $totfrontincome[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totfrontincome[1]  = $totfrontincome[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totfrontincome[2]  = $totfrontincome[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totfrontincome[3]  = $totfrontincome[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totfrontincome[4]  = $totfrontincome[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totfrontincome[5]  = $totfrontincome[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totfrontincome[6]  = $totfrontincome[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totfrontincome[7]  = $totfrontincome[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totfrontincome[8]  = $totfrontincome[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totfrontincome[9]  = $totfrontincome[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totfrontincome[10] = $totfrontincome[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totfrontincome[11] = $totfrontincome[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7">Total Pendapatan Usaha Lainnya </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totfrontincome[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totfrontincome[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totfrontincome[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totfrontincome[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Terima Dimuka -->



<tr style="height:18px">
<td colspan="11" class="s7">Total Pendapatan</td><td></td><td></td>
<td colspan="2" class="s9"><?php $pendapatan[0] = $totincome[0] + $totfrontincome[0];  echo num_format($pendapatan[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php $pendapatan[1] = $totincome[1] + $totfrontincome[1];  echo num_format($pendapatan[1]); ?></td><td></td>
<td class="s9"><?php $pendapatan[2] = $totincome[2] + $totfrontincome[2];  echo num_format($pendapatan[2]); ?></td><td></td>
<td class="s9"><?php $pendapatan[3] = $totincome[3] + $totfrontincome[3];  echo num_format($pendapatan[3]); ?></td><td></td>
<td class="s9"><?php $pendapatan[4] = $totincome[4] + $totfrontincome[4];  echo num_format($pendapatan[4]); ?></td><td></td>
<td class="s9"><?php $pendapatan[5] = $totincome[5] + $totfrontincome[5];  echo num_format($pendapatan[5]); ?></td><td></td>
<td class="s9"><?php $pendapatan[6] = $totincome[6] + $totfrontincome[6];  echo num_format($pendapatan[6]); ?></td><td></td>
<td class="s9"><?php $pendapatan[7] = $totincome[7] + $totfrontincome[7];  echo num_format($pendapatan[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php $pendapatan[8] = $totincome[8] + $totfrontincome[8];  echo num_format($pendapatan[8]); ?></td><td></td>
<td class="s9"><?php $pendapatan[9] = $totincome[9] + $totfrontincome[9];  echo num_format($pendapatan[9]); ?></td><td></td>
<td class="s9"><?php $pendapatan[10] = $totincome[10] + $totfrontincome[10];  echo num_format($pendapatan[10]); ?></td><td></td>
<td class="s9"><?php $pendapatan[11] = $totincome[11] + $totfrontincome[11];  echo num_format($pendapatan[11]); ?></td><td></td>
</tr>

<!-- Pendapatan -->

<!-- Biaya Atas Pendapatan -->

<tr style="height:16px">
<td colspan="18" class="s7">Biaya Atas Pendapatan</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8">Biaya Usaha</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($hpp as $res)
	{
		echo "
		<tr style=\"height:16px\">
        <td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
        </tr>
		";
		
		
		$tothpp[0]  = $tothpp[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$tothpp[1]  = $tothpp[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$tothpp[2]  = $tothpp[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$tothpp[3]  = $tothpp[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$tothpp[4]  = $tothpp[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$tothpp[5]  = $tothpp[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$tothpp[6]  = $tothpp[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$tothpp[7]  = $tothpp[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$tothpp[8]  = $tothpp[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$tothpp[9]  = $tothpp[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$tothpp[10] = $tothpp[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$tothpp[11] = $tothpp[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7">Total Biaya Usaha</td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($tothpp[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($tothpp[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($tothpp[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothpp[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha -->

<!-- Biaya Usaha Lainnya -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Biaya Usaha Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($othercost as $res)
	{
		echo "
		<tr style=\"height:16px\">
        <td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
        </tr>
		";
		
		
		$totothercost[0]  = $totothercost[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totothercost[1]  = $totothercost[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totothercost[2]  = $totothercost[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totothercost[3]  = $totothercost[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totothercost[4]  = $totothercost[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totothercost[5]  = $totothercost[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totothercost[6]  = $totothercost[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totothercost[7]  = $totothercost[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totothercost[8]  = $totothercost[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totothercost[9]  = $totothercost[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totothercost[10] = $totothercost[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totothercost[11] = $totothercost[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Biaya Usaha Lainnya </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totothercost[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totothercost[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totothercost[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totothercost[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha Lainnya -->

<tr style="height:18px">
<td colspan="11" class="s7">Total Biaya Atas Pendapatan</td><td></td><td></td>
<td colspan="2" class="s9"><?php $biayaataspendapatan[0] = $tothpp[0] + $totothercost[0] + $totfrontcost[0];  echo num_format($biayaataspendapatan[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php $biayaataspendapatan[1] = $tothpp[1] + $totothercost[1] + $totfrontcost[1];  echo num_format($biayaataspendapatan[1]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[2] = $tothpp[2] + $totothercost[2] + $totfrontcost[2];  echo num_format($biayaataspendapatan[2]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[3] = $tothpp[3] + $totothercost[3] + $totfrontcost[3];  echo num_format($biayaataspendapatan[3]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[4] = $tothpp[4] + $totothercost[4] + $totfrontcost[4];  echo num_format($biayaataspendapatan[4]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[5] = $tothpp[5] + $totothercost[5] + $totfrontcost[5];  echo num_format($biayaataspendapatan[5]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[6] = $tothpp[6] + $totothercost[6] + $totfrontcost[6];  echo num_format($biayaataspendapatan[6]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[7] = $tothpp[7] + $totothercost[7] + $totfrontcost[7];  echo num_format($biayaataspendapatan[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php $biayaataspendapatan[8] = $tothpp[8] + $totothercost[8] + $totfrontcost[8];  echo num_format($biayaataspendapatan[8]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[9] = $tothpp[9] + $totothercost[9] + $totfrontcost[9];  echo num_format($biayaataspendapatan[9]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[10] = $tothpp[10] + $totothercost[10] + $totfrontcost[10];  echo num_format($biayaataspendapatan[10]); ?></td><td></td>
<td class="s9"><?php $biayaataspendapatan[11] = $tothpp[11] + $totothercost[11] + $totfrontcost[11];  echo num_format($biayaataspendapatan[11]); ?></td><td></td>
</tr>

<!-- Biaya Atas Pendapatan -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Gross Margin -->
<tr style="height:18px">
<td colspan="11" class="s6"> Gross Margin </td><td></td><td></td>
<td colspan="2" class="s5"><?php $lrkotor[0] = $pendapatan[0] - $biayaataspendapatan[0]; echo num_format($lrkotor[0]); ?></td><td></td>
<td colspan="3" class="s5"><?php $lrkotor[1] = $pendapatan[1] - $biayaataspendapatan[1]; echo num_format($lrkotor[1]); ?></td><td></td>
<td class="s5"><?php $lrkotor[2] = $pendapatan[2] - $biayaataspendapatan[2]; echo num_format($lrkotor[2]); ?></td><td></td>
<td class="s5"><?php $lrkotor[3] = $pendapatan[3] - $biayaataspendapatan[3]; echo num_format($lrkotor[3]); ?></td><td></td>
<td class="s5"><?php $lrkotor[4] = $pendapatan[4] - $biayaataspendapatan[4]; echo num_format($lrkotor[4]); ?></td><td></td>
<td class="s5"><?php $lrkotor[5] = $pendapatan[5] - $biayaataspendapatan[5]; echo num_format($lrkotor[5]); ?></td><td></td>
<td class="s5"><?php $lrkotor[6] = $pendapatan[6] - $biayaataspendapatan[6]; echo num_format($lrkotor[6]); ?></td><td></td>
<td class="s5"><?php $lrkotor[7] = $pendapatan[7] - $biayaataspendapatan[7]; echo num_format($lrkotor[7]); ?></td><td></td>
<td colspan="4" class="s5"><?php $lrkotor[8] = $pendapatan[8] - $biayaataspendapatan[8]; echo num_format($lrkotor[8]); ?></td><td></td>
<td class="s5"><?php $lrkotor[9] = $pendapatan[9] - $biayaataspendapatan[9]; echo num_format($lrkotor[9]); ?></td><td></td>
<td class="s5"><?php $lrkotor[10] = $pendapatan[10] - $biayaataspendapatan[10]; echo num_format($lrkotor[10]); ?></td><td></td>
<td class="s5"><?php $lrkotor[11] = $pendapatan[11] - $biayaataspendapatan[11]; echo num_format($lrkotor[11]); ?></td><td></td>
</tr>
<!-- Gross Margin -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pengeluaran Operasional -->

<tr style="height:16px">
<td colspan="18" class="s7"> Pengeluaran Operasional </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Operasional -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8">Biaya Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($operationalcost as $res)
	{
		echo "
		<tr style=\"height:16px\">
        <td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
        </tr>
		";
		
		
		$totoperationalcost[0]  = $totoperationalcost[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totoperationalcost[1]  = $totoperationalcost[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totoperationalcost[2]  = $totoperationalcost[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totoperationalcost[3]  = $totoperationalcost[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totoperationalcost[4]  = $totoperationalcost[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totoperationalcost[5]  = $totoperationalcost[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totoperationalcost[6]  = $totoperationalcost[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totoperationalcost[7]  = $totoperationalcost[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totoperationalcost[8]  = $totoperationalcost[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totoperationalcost[9]  = $totoperationalcost[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totoperationalcost[10] = $totoperationalcost[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totoperationalcost[11] = $totoperationalcost[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7">Total Biaya Operasional</td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totoperationalcost[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totoperationalcost[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totoperationalcost[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Operasional -->

<tr style="height:18px">
<td colspan="11" class="s7"> Total Pengeluaran Operasional </td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totoperationalcost[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totoperationalcost[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totoperationalcost[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoperationalcost[11]); ?></td><td></td>
</tr>

<!-- Pengeluaran Operasional -->


<!-- Pengeluaran Non Operasional -->

<tr style="height:16px">
<td colspan="18" class="s7"> Pengeluaran Non Operasional </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Non Operasional -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8">Biaya Non Operasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($nonoperationalcost as $res)
	{
		echo "
		<tr style=\"height:16px\">
        <td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
        </tr>
		";
		
		
		$totnonoperationalcost[0]  = $totnonoperationalcost[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totnonoperationalcost[1]  = $totnonoperationalcost[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totnonoperationalcost[2]  = $totnonoperationalcost[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totnonoperationalcost[3]  = $totnonoperationalcost[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totnonoperationalcost[4]  = $totnonoperationalcost[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totnonoperationalcost[5]  = $totnonoperationalcost[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totnonoperationalcost[6]  = $totnonoperationalcost[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totnonoperationalcost[7]  = $totnonoperationalcost[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totnonoperationalcost[8]  = $totnonoperationalcost[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totnonoperationalcost[9]  = $totnonoperationalcost[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totnonoperationalcost[10] = $totnonoperationalcost[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totnonoperationalcost[11] = $totnonoperationalcost[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7">Total Biaya Non Operasional</td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totnonoperationalcost[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totnonoperationalcost[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totnonoperationalcost[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Non Operasional -->

<tr style="height:18px">
<td colspan="11" class="s7"> Total Pengeluaran Operasional </td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totnonoperationalcost[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totnonoperationalcost[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totnonoperationalcost[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totnonoperationalcost[11]); ?></td><td></td>
</tr>

<!-- Pengeluaran Non Operasional -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Operating Profit -->
<tr style="height:18px">
<td colspan="11" class="s6"> Operating Profit </td><td></td><td></td>
<td colspan="2" class="s5"><?php $lroperasi[0] = $lrkotor[0] - $totoperationalcost[0] + $totnonoperationalcost[0]; echo num_format($lroperasi[0]); ?></td><td></td>
<td colspan="3" class="s5"><?php $lroperasi[1] = $lrkotor[1] - $totoperationalcost[1] + $totnonoperationalcost[1]; echo num_format($lroperasi[1]); ?></td><td></td>
<td class="s5"><?php $lroperasi[2] = $lrkotor[2] - $totoperationalcost[2] + $totnonoperationalcost[2]; echo num_format($lroperasi[2]); ?></td><td></td>
<td class="s5"><?php $lroperasi[3] = $lrkotor[3] - $totoperationalcost[3] + $totnonoperationalcost[3]; echo num_format($lroperasi[3]); ?></td><td></td>
<td class="s5"><?php $lroperasi[4] = $lrkotor[4] - $totoperationalcost[4] + $totnonoperationalcost[4]; echo num_format($lroperasi[4]); ?></td><td></td>
<td class="s5"><?php $lroperasi[5] = $lrkotor[5] - $totoperationalcost[5] + $totnonoperationalcost[5]; echo num_format($lroperasi[5]); ?></td><td></td>
<td class="s5"><?php $lroperasi[6] = $lrkotor[6] - $totoperationalcost[6] + $totnonoperationalcost[6]; echo num_format($lroperasi[6]); ?></td><td></td>
<td class="s5"><?php $lroperasi[7] = $lrkotor[7] - $totoperationalcost[7] + $totnonoperationalcost[7]; echo num_format($lroperasi[7]); ?></td><td></td>
<td colspan="4" class="s5"><?php $lroperasi[8] = $lrkotor[8] - $totoperationalcost[8] + $totnonoperationalcost[8]; echo num_format($lroperasi[8]); ?></td><td></td>
<td class="s5"><?php $lroperasi[9] = $lrkotor[9] - $totoperationalcost[9] + $totnonoperationalcost[9]; echo num_format($lroperasi[9]); ?></td><td></td>
<td class="s5"><?php $lroperasi[10] = $lrkotor[10] - $totoperationalcost[10] + $totnonoperationalcost[10]; echo num_format($lroperasi[10]); ?></td><td></td>
<td class="s5"><?php $lroperasi[11] = $lrkotor[11] - $totoperationalcost[11] + $totnonoperationalcost[11]; echo num_format($lroperasi[11]); ?></td><td></td>
</tr>
<!-- Operating Profit -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Lain -->

<tr style="height:16px">
<td colspan="18" class="s7"> Pendapatan Lain </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Luar Usaha -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Pendapatan Luar Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($outincome as $res)
	{
		echo "
		<tr style=\"height:16px\">
        <td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
        </tr>
		";
		
		
		$totoutincome[0]  = $totoutincome[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totoutincome[1]  = $totoutincome[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totoutincome[2]  = $totoutincome[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totoutincome[3]  = $totoutincome[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totoutincome[4]  = $totoutincome[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totoutincome[5]  = $totoutincome[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totoutincome[6]  = $totoutincome[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totoutincome[7]  = $totoutincome[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totoutincome[8]  = $totoutincome[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totoutincome[9]  = $totoutincome[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totoutincome[10] = $totoutincome[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totoutincome[11] = $totoutincome[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7">Total Pendapatan Luar Usaha </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totoutincome[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totoutincome[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totoutincome[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Non Operasional -->

<tr style="height:18px">
<td colspan="11" class="s7"> Total Pendapatan Lain </td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totoutincome[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totoutincome[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totoutincome[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutincome[11]); ?></td><td></td>
</tr>

<!-- Pendapatan Lain -->

<!-- Pengeluaran Lain -->

<tr style="height:16px">
<td colspan="18" class="s7"> Pengeluaran Lain </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pengeluaran Luar Usaha -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Pengeluaran Luar Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($outcost as $res)
	{
		echo "
		<tr style=\"height:16px\">
        <td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
        </tr>
		";
		
		
		$totoutcost[0]  = $totoutcost[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totoutcost[1]  = $totoutcost[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totoutcost[2]  = $totoutcost[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totoutcost[3]  = $totoutcost[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totoutcost[4]  = $totoutcost[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totoutcost[5]  = $totoutcost[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totoutcost[6]  = $totoutcost[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totoutcost[7]  = $totoutcost[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totoutcost[8]  = $totoutcost[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totoutcost[9]  = $totoutcost[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totoutcost[10] = $totoutcost[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totoutcost[11] = $totoutcost[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7">Total Pengeluaran Luar Usaha </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totoutcost[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totoutcost[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totoutcost[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Non Operasional -->

<tr style="height:18px">
<td colspan="11" class="s7"> Total Pengeluaran Lain </td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totoutcost[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totoutcost[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totoutcost[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totoutcost[11]); ?></td><td></td>
</tr>

<!-- Pengeluaran Lain -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Net Profit -->
<tr style="height:18px">
<td colspan="11" class="s6"> Net Profit </td><td></td><td></td>
<td colspan="2" class="s5"><?php $lrbersih[0] = $lroperasi[0] + $totoutincome[0] - $totoutcost[0]; echo num_format($lrbersih[0]); ?></td><td></td>
<td colspan="3" class="s5"><?php $lrbersih[1] = $lroperasi[1] + $totoutincome[1] - $totoutcost[1]; echo num_format($lrbersih[1]); ?></td><td></td>
<td class="s5"><?php $lrbersih[2] = $lroperasi[2] + $totoutincome[2] - $totoutcost[2]; echo num_format($lrbersih[2]); ?></td><td></td>
<td class="s5"><?php $lrbersih[3] = $lroperasi[3] + $totoutincome[3] - $totoutcost[3]; echo num_format($lrbersih[3]); ?></td><td></td>
<td class="s5"><?php $lrbersih[4] = $lroperasi[4] + $totoutincome[4] - $totoutcost[4]; echo num_format($lrbersih[4]); ?></td><td></td>
<td class="s5"><?php $lrbersih[5] = $lroperasi[5] + $totoutincome[5] - $totoutcost[5]; echo num_format($lrbersih[5]); ?></td><td></td>
<td class="s5"><?php $lrbersih[6] = $lroperasi[6] + $totoutincome[6] - $totoutcost[6]; echo num_format($lrbersih[6]); ?></td><td></td>
<td class="s5"><?php $lrbersih[7] = $lroperasi[7] + $totoutincome[7] - $totoutcost[7]; echo num_format($lrbersih[7]); ?></td><td></td>
<td colspan="4" class="s5"><?php $lrbersih[8] = $lroperasi[8] + $totoutincome[8] - $totoutcost[8]; echo num_format($lrbersih[8]); ?></td><td></td>
<td class="s5"><?php $lrbersih[9] = $lroperasi[9] + $totoutincome[9] - $totoutcost[9]; echo num_format($lrbersih[9]); ?></td><td></td>
<td class="s5"><?php $lrbersih[10] = $lroperasi[10] + $totoutincome[10] - $totoutcost[10]; echo num_format($lrbersih[10]); ?></td><td></td>
<td class="s5"><?php $lrbersih[11] = $lroperasi[11] + $totoutincome[11] - $totoutcost[11]; echo num_format($lrbersih[11]); ?></td><td></td>
</tr>
<!-- Net Profit -->

<tr style="height:22px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:1px">
<td colspan="43" class="s10" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:1px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td colspan="8" class="s0"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="8" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
</table>
</body></html>
