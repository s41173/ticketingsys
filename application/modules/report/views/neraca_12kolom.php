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
	
	// harta
	$totkas[0] = 0; $totkas[1] = 0; $totkas[2] = 0; $totkas[3] = 0; $totkas[4] = 0; $totkas[5] = 0; $totkas[6] = 0; $totkas[7] = 0; $totkas[8] = 0; $totkas[9] = 0; $totkas[10] = 0; $totkas[11] = 0; 
	$totbank[0] = 0; $totbank[1] = 0; $totbank[2] = 0; $totbank[3] = 0; $totbank[4] = 0; $totbank[5] = 0; $totbank[6] = 0; $totbank[7] = 0; $totbank[8] = 0; $totbank[9] = 0; $totbank[10] = 0; $totbank[11] = 0; 
	$totpiutangusaha[0] = 0; $totpiutangusaha[1] = 0; $totpiutangusaha[2] = 0; $totpiutangusaha[3] = 0; $totpiutangusaha[4] = 0; $totpiutangusaha[5] = 0; $totpiutangusaha[6] = 0; $totpiutangusaha[7] = 0; $totpiutangusaha[8] = 0; $totpiutangusaha[9] = 0; $totpiutangusaha[10] = 0; $totpiutangusaha[11] = 0; 
	$totpiutangnonusaha[0] = 0; $totpiutangnonusaha[1] = 0; $totpiutangnonusaha[2] = 0; $totpiutangnonusaha[3] = 0; $totpiutangnonusaha[4] = 0; $totpiutangnonusaha[5] = 0; $totpiutangnonusaha[6] = 0; $totpiutangnonusaha[7] = 0; $totpiutangnonusaha[8] = 0; $totpiutangnonusaha[9] = 0; $totpiutangnonusaha[10] = 0; $totpiutangnonusaha[11] = 0; 
	$totpersediaan[0] = 0; $totpersediaan[1] = 0; $totpersediaan[2] = 0; $totpersediaan[3] = 0; $totpersediaan[4] = 0; $totpersediaan[5] = 0; $totpersediaan[6] = 0; $totpersediaan[7] = 0; $totpersediaan[8] = 0; $totpersediaan[9] = 0; $totpersediaan[10] = 0; $totpersediaan[11] = 0; 
	$totbiayadimuka[0] = 0; $totbiayadimuka[1] = 0; $totbiayadimuka[2] = 0; $totbiayadimuka[3] = 0; $totbiayadimuka[4] = 0; $totbiayadimuka[5] = 0; $totbiayadimuka[6] = 0; $totbiayadimuka[7] = 0; $totbiayadimuka[8] = 0; $totbiayadimuka[9] = 0; $totbiayadimuka[10] = 0; $totbiayadimuka[11] = 0; 
    $totinvestasi[0] = 0; $totinvestasi[1] = 0; $totinvestasi[2] = 0; $totinvestasi[3] = 0; $totinvestasi[4] = 0; $totinvestasi[5] = 0; $totinvestasi[6] = 0; $totinvestasi[7] = 0; $totinvestasi[8] = 0; $totinvestasi[9] = 0; $totinvestasi[10] = 0; $totinvestasi[11] = 0; 
	$tothartawujud[0] = 0; $tothartawujud[1] = 0; $tothartawujud[2] = 0; $tothartawujud[3] = 0; $tothartawujud[4] = 0; $tothartawujud[5] = 0; $tothartawujud[6] = 0; $tothartawujud[7] = 0; $tothartawujud[8] = 0; $tothartawujud[9] = 0; $tothartawujud[10] = 0; $tothartawujud[11] = 0; 
	$tothartatakwujud[0] = 0; $tothartatakwujud[1] = 0; $tothartatakwujud[2] = 0; $tothartatakwujud[3] = 0; $tothartatakwujud[4] = 0; $tothartatakwujud[5] = 0; $tothartatakwujud[6] = 0; $tothartatakwujud[7] = 0; $tothartatakwujud[8] = 0; $tothartatakwujud[9] = 0; $tothartatakwujud[10] = 0; $tothartatakwujud[11] = 0; 
	$tothartalain[0] = 0; $tothartalain[1] = 0; $tothartalain[2] = 0; $tothartalain[3] = 0; $tothartalain[4] = 0; $tothartalain[5] = 0; $tothartalain[6] = 0; $tothartalain[7] = 0; $tothartalain[8] = 0; $tothartalain[9] = 0; $tothartalain[10] = 0; $tothartalain[11] = 0; 
	$harta[0] = 0; $harta[1] = 0; $harta[2] = 0; $harta[3] = 0; $harta[4] = 0; $harta[5] = 0; $harta[6] = 0; $harta[7] = 0; $harta[8] = 0; $harta[9] = 0; $harta[10] = 0; $harta[11] = 0; 	
	
	// kewajiban
	$tothutangusaha[0] = 0; $tothutangusaha[1] = 0; $tothutangusaha[2] = 0; $tothutangusaha[3] = 0; $tothutangusaha[4] = 0; $tothutangusaha[5] = 0; $tothutangusaha[6] = 0; $tothutangusaha[7] = 0; $tothutangusaha[8] = 0; $tothutangusaha[9] = 0; $tothutangusaha[10] = 0; $tothutangusaha[11] = 0; 
	$totpendapatandimuka[0] = 0; $totpendapatandimuka[1] = 0; $totpendapatandimuka[2] = 0; $totpendapatandimuka[3] = 0; $totpendapatandimuka[4] = 0; $totpendapatandimuka[5] = 0; $totpendapatandimuka[6] = 0; $totpendapatandimuka[7] = 0; $totpendapatandimuka[8] = 0; $totpendapatandimuka[9] = 0; $totpendapatandimuka[10] = 0; $totpendapatandimuka[11] = 0; 
	$tothutangpanjang[0] = 0; $tothutangpanjang[1] = 0; $tothutangpanjang[2] = 0; $tothutangpanjang[3] = 0; $tothutangpanjang[4] = 0; $tothutangpanjang[5] = 0; $tothutangpanjang[6] = 0; $tothutangpanjang[7] = 0; $tothutangpanjang[8] = 0; $tothutangpanjang[9] = 0; $tothutangpanjang[10] = 0; $tothutangpanjang[11] = 0; 
	$tothutangnonusaha[0] = 0; $tothutangnonusaha[1] = 0; $tothutangnonusaha[2] = 0; $tothutangnonusaha[3] = 0; $tothutangnonusaha[4] = 0; $tothutangnonusaha[5] = 0; $tothutangnonusaha[6] = 0; $tothutangnonusaha[7] = 0; $tothutangnonusaha[8] = 0; $tothutangnonusaha[9] = 0; $tothutangnonusaha[10] = 0; $tothutangnonusaha[11] = 0; 
	$tothutanglain[0] = 0; $tothutanglain[1] = 0; $tothutanglain[2] = 0; $tothutanglain[3] = 0; $tothutanglain[4] = 0; $tothutanglain[5] = 0; $tothutanglain[6] = 0; $tothutanglain[7] = 0; $tothutanglain[8] = 0; $tothutanglain[9] = 0; $tothutanglain[10] = 0; $tothutanglain[11] = 0; 

    // modal
	$totmodal[0] = 0; $totmodal[1] = 0; $totmodal[2] = 0; $totmodal[3] = 0; $totmodal[4] = 0; $totmodal[5] = 0; $totmodal[6] = 0; $totmodal[7] = 0; $totmodal[8] = 0; $totmodal[9] = 0; $totmodal[10] = 0; $totmodal[11] = 0; 
	$totlaba[0] = 0; $totlaba[1] = 0; $totlaba[2] = 0; $totlaba[3] = 0; $totlaba[4] = 0; $totlaba[5] = 0; $totlaba[6] = 0; $totlaba[7] = 0; $totlaba[8] = 0; $totlaba[9] = 0; $totlaba[10] = 0; $totlaba[11] = 0; 
	$modaltot[0] = 0; $modaltot[1] = 0; $modaltot[2] = 0; $modaltot[3] = 0; $modaltot[4] = 0; $modaltot[5] = 0; $modaltot[6] = 0; $modaltot[7] = 0; $modaltot[8] = 0; $modaltot[9] = 0; $modaltot[10] = 0; $modaltot[11] = 0; 
    $kewajiban[0] = 0; $kewajiban[1] = 0; $kewajiban[2] = 0; $kewajiban[3] = 0; $kewajiban[4] = 0; $kewajiban[5] = 0; $kewajiban[6] = 0; $kewajiban[7] = 0; $kewajiban[8] = 0; $kewajiban[9] = 0; $kewajiban[10] = 0; $kewajiban[11] = 0; 	
	
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0,$em=0,$ey=0)
	{
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$m,$y)->row();
		return floatval($res->vamount + get_beginning($cur,$acc,$m,$y));
	}
	
	function get_vamount_balance($cur='IDR',$acc,$m=0,$y=0,$em=0,$ey=0)
	{
		$bl = new Balances();
		$bl->where('account_id', $acc);
        $bl->where('month', $m);
        $bl->where('year', $y)->get();
		$bl->beginning;

		// get vamount
		$am = new Account_model();
		$res = $am->get_period_vamount($cur,$acc,$m,$y,$m,$y)->row();	
        $res_trans = $am->get_period_balance($cur,$acc,$m,$y,$em,$ey)->row();
		
//		return floatval($bl->beginning + $res->vamount + $res_trans->vamount);
     	return floatval($bl->end + $res_trans->vamount);
	}
	
	function get_beginning($cur='IDR',$acc,$m=0,$y=0)
	{
		$bl = new Balances();
		$bl->where('account_id', $acc);
        $bl->where('month', $m);
        $bl->where('year', $y)->get();
		return floatval($bl->beginning);
	}
	
	function get_end($cur='IDR',$acc,$m=0,$y=0)
	{
		$bl = new Balances();
		$bl->where('account_id', $acc);
        $bl->where('month', $m);
        $bl->where('year', $y)->get();
		return floatval($bl->end);
	}
	
?>


<a name="PageN1"></a>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
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
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="20" class="s2"> Balance Sheet </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
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

<!-- Harta -->

<tr style="height:16px">
<td colspan="18" class="s7"> Asset </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Kas -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Kas </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($kas as $res)
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
		
		
		$totkas[0]  = $totkas[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totkas[1]  = $totkas[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totkas[2]  = $totkas[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totkas[3]  = $totkas[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totkas[4]  = $totkas[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totkas[5]  = $totkas[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totkas[6]  = $totkas[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totkas[7]  = $totkas[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totkas[8]  = $totkas[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totkas[9]  = $totkas[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totkas[10] = $totkas[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totkas[11] = $totkas[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Kas </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totkas[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totkas[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totkas[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totkas[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Kas -->

<!-- Bank -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Bank </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($bank as $res)
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
		
		$totbank[0]  = $totbank[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totbank[1]  = $totbank[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totbank[2]  = $totbank[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totbank[3]  = $totbank[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totbank[4]  = $totbank[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totbank[5]  = $totbank[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totbank[6]  = $totbank[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totbank[7]  = $totbank[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totbank[8]  = $totbank[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totbank[9]  = $totbank[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totbank[10] = $totbank[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totbank[11] = $totbank[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Bank </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totbank[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totbank[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totbank[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbank[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Bank -->

<!-- Piutang Usaha -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Piutang Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($piutangusaha as $res)
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
		
		$totpiutangusaha[0]  = $totpiutangusaha[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totpiutangusaha[1]  = $totpiutangusaha[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totpiutangusaha[2]  = $totpiutangusaha[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totpiutangusaha[3]  = $totpiutangusaha[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totpiutangusaha[4]  = $totpiutangusaha[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totpiutangusaha[5]  = $totpiutangusaha[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totpiutangusaha[6]  = $totpiutangusaha[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totpiutangusaha[7]  = $totpiutangusaha[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totpiutangusaha[8]  = $totpiutangusaha[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totpiutangusaha[9]  = $totpiutangusaha[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totpiutangusaha[10] = $totpiutangusaha[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totpiutangusaha[11] = $totpiutangusaha[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Piutang Usaha </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totpiutangusaha[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totpiutangusaha[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totpiutangusaha[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangusaha[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Piutang Usaha -->

<!-- Piutang Non Usaha -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Piutang Non Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($piutangnonusaha as $res)
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
		
		$totpiutangnonusaha[0]  = $totpiutangnonusaha[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totpiutangnonusaha[1]  = $totpiutangnonusaha[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totpiutangnonusaha[2]  = $totpiutangnonusaha[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totpiutangnonusaha[3]  = $totpiutangnonusaha[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totpiutangnonusaha[4]  = $totpiutangnonusaha[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totpiutangnonusaha[5]  = $totpiutangnonusaha[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totpiutangnonusaha[6]  = $totpiutangnonusaha[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totpiutangnonusaha[7]  = $totpiutangnonusaha[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totpiutangnonusaha[8]  = $totpiutangnonusaha[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totpiutangnonusaha[9]  = $totpiutangnonusaha[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totpiutangnonusaha[10] = $totpiutangnonusaha[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totpiutangnonusaha[11] = $totpiutangnonusaha[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Piutang Non Usaha </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totpiutangnonusaha[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totpiutangnonusaha[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totpiutangnonusaha[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpiutangnonusaha[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Piutang Non Usaha -->

<!-- Persediaan -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Persediaan </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($persediaan as $res)
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
		
		$totpersediaan[0]  = $totpersediaan[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totpersediaan[1]  = $totpersediaan[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totpersediaan[2]  = $totpersediaan[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totpersediaan[3]  = $totpersediaan[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totpersediaan[4]  = $totpersediaan[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totpersediaan[5]  = $totpersediaan[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totpersediaan[6]  = $totpersediaan[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totpersediaan[7]  = $totpersediaan[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totpersediaan[8]  = $totpersediaan[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totpersediaan[9]  = $totpersediaan[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totpersediaan[10] = $totpersediaan[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totpersediaan[11] = $totpersediaan[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Persediaan </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totpersediaan[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totpersediaan[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totpersediaan[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpersediaan[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Persediaan -->

<!-- Biaya Dibayar Dimuka -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Biaya Dibayar Dimuka </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($biayadimuka as $res)
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
		
		$totbiayadimuka[0]  = $totbiayadimuka[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totbiayadimuka[1]  = $totbiayadimuka[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totbiayadimuka[2]  = $totbiayadimuka[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totbiayadimuka[3]  = $totbiayadimuka[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totbiayadimuka[4]  = $totbiayadimuka[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totbiayadimuka[5]  = $totbiayadimuka[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totbiayadimuka[6]  = $totbiayadimuka[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totbiayadimuka[7]  = $totbiayadimuka[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totbiayadimuka[8]  = $totbiayadimuka[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totbiayadimuka[9]  = $totbiayadimuka[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totbiayadimuka[10] = $totbiayadimuka[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totbiayadimuka[11] = $totbiayadimuka[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Biaya Dibayar Dimuka </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totbiayadimuka[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totbiayadimuka[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totbiayadimuka[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totbiayadimuka[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Dibayar Dimuka -->

<!-- Investasi Jangka Panjang -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Investasi Jangka Panjang </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($investasi as $res)
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
		
		$totinvestasi[0]  = $totinvestasi[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totinvestasi[1]  = $totinvestasi[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totinvestasi[2]  = $totinvestasi[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totinvestasi[3]  = $totinvestasi[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totinvestasi[4]  = $totinvestasi[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totinvestasi[5]  = $totinvestasi[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totinvestasi[6]  = $totinvestasi[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totinvestasi[7]  = $totinvestasi[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totinvestasi[8]  = $totinvestasi[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totinvestasi[9]  = $totinvestasi[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totinvestasi[10] = $totinvestasi[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totinvestasi[11] = $totinvestasi[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Investasi Jangka Panjang </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totinvestasi[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totinvestasi[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totinvestasi[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totinvestasi[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Investasi Jangka Panjang -->

<!-- Harta Tetap Berwujud -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Harta Tetap Berwujud </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($hartawujud as $res)
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
		
		$tothartawujud[0]  = $tothartawujud[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$tothartawujud[1]  = $tothartawujud[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$tothartawujud[2]  = $tothartawujud[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$tothartawujud[3]  = $tothartawujud[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$tothartawujud[4]  = $tothartawujud[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$tothartawujud[5]  = $tothartawujud[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$tothartawujud[6]  = $tothartawujud[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$tothartawujud[7]  = $tothartawujud[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$tothartawujud[8]  = $tothartawujud[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$tothartawujud[9]  = $tothartawujud[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$tothartawujud[10] = $tothartawujud[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$tothartawujud[11] = $tothartawujud[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Harta Tetap Berwujud </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($tothartawujud[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($tothartawujud[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($tothartawujud[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartawujud[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Tetap Berwujud -->

<!-- Harta Tetap Tidak Berwujud -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($hartatakwujud as $res)
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
		
		$tothartatakwujud[0]  = $tothartatakwujud[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$tothartatakwujud[1]  = $tothartatakwujud[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$tothartatakwujud[2]  = $tothartatakwujud[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$tothartatakwujud[3]  = $tothartatakwujud[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$tothartatakwujud[4]  = $tothartatakwujud[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$tothartatakwujud[5]  = $tothartatakwujud[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$tothartatakwujud[6]  = $tothartatakwujud[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$tothartatakwujud[7]  = $tothartatakwujud[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$tothartatakwujud[8]  = $tothartatakwujud[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$tothartatakwujud[9]  = $tothartatakwujud[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$tothartatakwujud[10] = $tothartatakwujud[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$tothartatakwujud[11] = $tothartatakwujud[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($tothartatakwujud[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($tothartatakwujud[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($tothartatakwujud[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartatakwujud[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Tetap Tidak Berwujud -->

<!-- Harta Lainnya -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Harta Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($hartalain as $res)
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
		
		$tothartalain[0]  = $tothartalain[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$tothartalain[1]  = $tothartalain[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$tothartalain[2]  = $tothartalain[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$tothartalain[3]  = $tothartalain[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$tothartalain[4]  = $tothartalain[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$tothartalain[5]  = $tothartalain[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$tothartalain[6]  = $tothartalain[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$tothartalain[7]  = $tothartalain[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$tothartalain[8]  = $tothartalain[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$tothartalain[9]  = $tothartalain[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$tothartalain[10] = $tothartalain[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$tothartalain[11] = $tothartalain[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
		
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Harta Lainnya </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($tothartalain[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($tothartalain[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($tothartalain[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothartalain[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Lainnya -->

<tr style="height:18px">
<td colspan="11" class="s7">Total Asset</td><td></td><td></td>
<td colspan="2" class="s9"> <?php $harta[0] = $totkas[0] + $totbank[0] + $totpiutangusaha[0] + $totpiutangnonusaha[0] + $totpersediaan[0] + $totbiayadimuka[0] +  $totinvestasi[0] + $tothartawujud[0] + $tothartatakwujud[0] + $tothartalain[0] ;  echo num_format($harta[0]); ?> </td><td></td>
<td colspan="3" class="s9"> <?php $harta[1] = $totkas[1] + $totbank[1] + $totpiutangusaha[1] + $totpiutangnonusaha[1] + $totpersediaan[1] + $totbiayadimuka[1] +  $totinvestasi[1] + $tothartawujud[1] + $tothartatakwujud[1] + $tothartalain[1] ;  echo num_format($harta[1]); ?> </td><td></td>
<td class="s9"> <?php $harta[2] = $totkas[2] + $totbank[2] + $totpiutangusaha[2] + $totpiutangnonusaha[2] + $totpersediaan[2] + $totbiayadimuka[2] +  $totinvestasi[2] + $tothartawujud[2] + $tothartatakwujud[2] + $tothartalain[2] ;  echo num_format($harta[2]); ?> </td><td></td>
<td class="s9"> <?php $harta[3] = $totkas[3] + $totbank[3] + $totpiutangusaha[3] + $totpiutangnonusaha[3] + $totpersediaan[3] + $totbiayadimuka[3] +  $totinvestasi[3] + $tothartawujud[3] + $tothartatakwujud[3] + $tothartalain[3] ;  echo num_format($harta[3]); ?> </td><td></td>
<td class="s9"> <?php $harta[4] = $totkas[4] + $totbank[4] + $totpiutangusaha[4] + $totpiutangnonusaha[4] + $totpersediaan[4] + $totbiayadimuka[4] +  $totinvestasi[4] + $tothartawujud[4] + $tothartatakwujud[4] + $tothartalain[4] ;  echo num_format($harta[4]); ?> </td><td></td>
<td class="s9"> <?php $harta[5] = $totkas[5] + $totbank[5] + $totpiutangusaha[5] + $totpiutangnonusaha[5] + $totpersediaan[5] + $totbiayadimuka[5] +  $totinvestasi[5] + $tothartawujud[5] + $tothartatakwujud[5] + $tothartalain[5] ;  echo num_format($harta[5]); ?> </td><td></td>
<td class="s9"> <?php $harta[6] = $totkas[6] + $totbank[6] + $totpiutangusaha[6] + $totpiutangnonusaha[6] + $totpersediaan[6] + $totbiayadimuka[6] +  $totinvestasi[6] + $tothartawujud[6] + $tothartatakwujud[6] + $tothartalain[6] ;  echo num_format($harta[6]); ?> </td><td></td>
<td class="s9"> <?php $harta[7] = $totkas[7] + $totbank[7] + $totpiutangusaha[7] + $totpiutangnonusaha[7] + $totpersediaan[7] + $totbiayadimuka[7] +  $totinvestasi[7] + $tothartawujud[7] + $tothartatakwujud[7] + $tothartalain[7] ;  echo num_format($harta[7]); ?> </td><td></td>
<td colspan="4" class="s9"> <?php $harta[8] = $totkas[8] + $totbank[8] + $totpiutangusaha[8] + $totpiutangnonusaha[8] + $totpersediaan[8] + $totbiayadimuka[8] +  $totinvestasi[8] + $tothartawujud[8] + $tothartatakwujud[8] + $tothartalain[8] ;  echo num_format($harta[8]); ?> </td><td></td>
<td class="s9"> <?php $harta[9] = $totkas[9] + $totbank[9] + $totpiutangusaha[9] + $totpiutangnonusaha[9] + $totpersediaan[9] + $totbiayadimuka[9] +  $totinvestasi[9] + $tothartawujud[9] + $tothartatakwujud[9] + $tothartalain[9] ;  echo num_format($harta[9]); ?> </td><td></td>
<td class="s9"> <?php $harta[10] = $totkas[10] + $totbank[10] + $totpiutangusaha[10] + $totpiutangnonusaha[10] + $totpersediaan[10] + $totbiayadimuka[10] +  $totinvestasi[10] + $tothartawujud[10] + $tothartatakwujud[10] + $tothartalain[10] ;  echo num_format($harta[10]); ?> </td><td></td>
<td class="s9"> <?php $harta[11] = $totkas[11] + $totbank[11] + $totpiutangusaha[11] + $totpiutangnonusaha[11] + $totpersediaan[11] + $totbiayadimuka[11] +  $totinvestasi[11] + $tothartawujud[11] + $tothartatakwujud[11] + $tothartalain[11] ;  echo num_format($harta[11]); ?> </td><td></td>
</tr>

<!-- Harta -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Kewajiban -->

<tr style="height:16px">
<td colspan="18" class="s7"> Liabilities </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Usaha -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Hutang Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($hutangusaha as $res)
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
		
		
		$tothutangusaha[0]  = $tothutangusaha[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$tothutangusaha[1]  = $tothutangusaha[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$tothutangusaha[2]  = $tothutangusaha[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$tothutangusaha[3]  = $tothutangusaha[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$tothutangusaha[4]  = $tothutangusaha[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$tothutangusaha[5]  = $tothutangusaha[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$tothutangusaha[6]  = $tothutangusaha[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$tothutangusaha[7]  = $tothutangusaha[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$tothutangusaha[8]  = $tothutangusaha[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$tothutangusaha[9]  = $tothutangusaha[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$tothutangusaha[10] = $tothutangusaha[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$tothutangusaha[11] = $tothutangusaha[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Hutang Usaha </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($tothutangusaha[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($tothutangusaha[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($tothutangusaha[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangusaha[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Usaha -->

<!-- Pendapatan Terima Dimuka -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Pendapatan Terima Dimuka </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($pendapatandimuka as $res)
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
		
		
		$totpendapatandimuka[0]  = $totpendapatandimuka[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totpendapatandimuka[1]  = $totpendapatandimuka[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totpendapatandimuka[2]  = $totpendapatandimuka[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totpendapatandimuka[3]  = $totpendapatandimuka[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totpendapatandimuka[4]  = $totpendapatandimuka[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totpendapatandimuka[5]  = $totpendapatandimuka[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totpendapatandimuka[6]  = $totpendapatandimuka[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totpendapatandimuka[7]  = $totpendapatandimuka[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totpendapatandimuka[8]  = $totpendapatandimuka[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totpendapatandimuka[9]  = $totpendapatandimuka[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totpendapatandimuka[10] = $totpendapatandimuka[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totpendapatandimuka[11] = $totpendapatandimuka[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Pendapatan Terima Dimuka </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totpendapatandimuka[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totpendapatandimuka[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totpendapatandimuka[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totpendapatandimuka[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Terima Dimuka -->

<!-- Hutang Jangka Panjang -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Hutang Jangka Panjang </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($hutangpanjang as $res)
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
		
		
		$tothutangpanjang[0]  = $tothutangpanjang[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$tothutangpanjang[1]  = $tothutangpanjang[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$tothutangpanjang[2]  = $tothutangpanjang[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$tothutangpanjang[3]  = $tothutangpanjang[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$tothutangpanjang[4]  = $tothutangpanjang[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$tothutangpanjang[5]  = $tothutangpanjang[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$tothutangpanjang[6]  = $tothutangpanjang[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$tothutangpanjang[7]  = $tothutangpanjang[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$tothutangpanjang[8]  = $tothutangpanjang[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$tothutangpanjang[9]  = $tothutangpanjang[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$tothutangpanjang[10] = $tothutangpanjang[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$tothutangpanjang[11] = $tothutangpanjang[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Hutang Jangka Panjang </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($tothutangpanjang[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($tothutangpanjang[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($tothutangpanjang[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangpanjang[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Jangka Panjang -->

<!-- Hutang Non Usaha -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Hutang Non Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($hutangnonusaha as $res)
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
		
		
		$tothutangnonusaha[0]  = $tothutangnonusaha[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$tothutangnonusaha[1]  = $tothutangnonusaha[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$tothutangnonusaha[2]  = $tothutangnonusaha[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$tothutangnonusaha[3]  = $tothutangnonusaha[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$tothutangnonusaha[4]  = $tothutangnonusaha[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$tothutangnonusaha[5]  = $tothutangnonusaha[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$tothutangnonusaha[6]  = $tothutangnonusaha[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$tothutangnonusaha[7]  = $tothutangnonusaha[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$tothutangnonusaha[8]  = $tothutangnonusaha[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$tothutangnonusaha[9]  = $tothutangnonusaha[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$tothutangnonusaha[10] = $tothutangnonusaha[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$tothutangnonusaha[11] = $tothutangnonusaha[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Hutang Non Usaha </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($tothutangnonusaha[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($tothutangnonusaha[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($tothutangnonusaha[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutangnonusaha[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Non Usaha -->

<!-- Hutang Lainnya -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Hutang Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($hutanglain as $res)
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
		
		
		$tothutanglain[0]  = $tothutanglain[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$tothutanglain[1]  = $tothutanglain[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$tothutanglain[2]  = $tothutanglain[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$tothutanglain[3]  = $tothutanglain[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$tothutanglain[4]  = $tothutanglain[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$tothutanglain[5]  = $tothutanglain[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$tothutanglain[6]  = $tothutanglain[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$tothutanglain[7]  = $tothutanglain[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$tothutanglain[8]  = $tothutanglain[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$tothutanglain[9]  = $tothutanglain[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$tothutanglain[10] = $tothutanglain[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$tothutanglain[11] = $tothutanglain[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Hutang Lainnya </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($tothutanglain[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($tothutanglain[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($tothutanglain[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($tothutanglain[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Lainnya -->

<tr style="height:18px">
<td colspan="11" class="s7"> Total Liabilities </td><td></td><td></td>
<td colspan="2" class="s9"> <?php $kewajiban[0] = $tothutangusaha[0] + $totpendapatandimuka[0] + $tothutangpanjang[0] + $tothutangnonusaha[0] + $tothutanglain[0];  echo num_format($kewajiban[0]); ?> </td><td></td>
<td colspan="3" class="s9"> <?php $kewajiban[1] = $tothutangusaha[1] + $totpendapatandimuka[1] + $tothutangpanjang[1] + $tothutangnonusaha[1] + $tothutanglain[1];  echo num_format($kewajiban[1]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[2] = $tothutangusaha[2] + $totpendapatandimuka[2] + $tothutangpanjang[2] + $tothutangnonusaha[2] + $tothutanglain[2];  echo num_format($kewajiban[2]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[3] = $tothutangusaha[3] + $totpendapatandimuka[3] + $tothutangpanjang[3] + $tothutangnonusaha[3] + $tothutanglain[3];  echo num_format($kewajiban[3]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[4] = $tothutangusaha[4] + $totpendapatandimuka[4] + $tothutangpanjang[4] + $tothutangnonusaha[4] + $tothutanglain[4];  echo num_format($kewajiban[4]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[5] = $tothutangusaha[5] + $totpendapatandimuka[5] + $tothutangpanjang[5] + $tothutangnonusaha[5] + $tothutanglain[5];  echo num_format($kewajiban[5]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[6] = $tothutangusaha[6] + $totpendapatandimuka[6] + $tothutangpanjang[6] + $tothutangnonusaha[6] + $tothutanglain[6];  echo num_format($kewajiban[6]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[7] = $tothutangusaha[7] + $totpendapatandimuka[7] + $tothutangpanjang[7] + $tothutangnonusaha[7] + $tothutanglain[7];  echo num_format($kewajiban[7]); ?> </td><td></td>
<td colspan="4" class="s9"> <?php $kewajiban[8] = $tothutangusaha[8] + $totpendapatandimuka[8] + $tothutangpanjang[8] + $tothutangnonusaha[8] + $tothutanglain[8];  echo num_format($kewajiban[8]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[9] = $tothutangusaha[9] + $totpendapatandimuka[9] + $tothutangpanjang[9] + $tothutangnonusaha[9] + $tothutanglain[9];  echo num_format($kewajiban[9]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[10] = $tothutangusaha[10] + $totpendapatandimuka[10] + $tothutangpanjang[10] + $tothutangnonusaha[10] + $tothutanglain[10];  echo num_format($kewajiban[10]); ?> </td><td></td>
<td class="s9"> <?php $kewajiban[11] = $tothutangusaha[11] + $totpendapatandimuka[11] + $tothutangpanjang[11] + $tothutangnonusaha[11] + $tothutanglain[11];  echo num_format($kewajiban[11]); ?> </td><td></td>
</tr>

<!-- Kewajiban -->


<!-- Modal -->

<tr style="height:16px">
<td colspan="18" class="s7"> Equity </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Modal -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Capital </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($modal as $res)
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
		
		
		$totmodal[0]  = $totmodal[0] + floatval(get_acc_amount($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totmodal[1]  = $totmodal[1] + floatval(get_acc_amount($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totmodal[2]  = $totmodal[2] + floatval(get_acc_amount($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totmodal[3]  = $totmodal[3] + floatval(get_acc_amount($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totmodal[4]  = $totmodal[4] + floatval(get_acc_amount($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totmodal[5]  = $totmodal[5] + floatval(get_acc_amount($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totmodal[6]  = $totmodal[6] + floatval(get_acc_amount($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totmodal[7]  = $totmodal[7] + floatval(get_acc_amount($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totmodal[8]  = $totmodal[8] + floatval(get_acc_amount($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totmodal[9]  = $totmodal[9] + floatval(get_acc_amount($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totmodal[10] = $totmodal[10] + floatval(get_acc_amount($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totmodal[11] = $totmodal[11] + floatval(get_acc_amount($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Capital </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totmodal[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totmodal[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totmodal[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totmodal[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Modal -->

<!-- Laba -->

<tr style="height:16px">
<td></td><td></td><td colspan="15" class="s8"> Earnings </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping Account -->

<!--<tr style="height:16px">
<td></td><td></td><td></td><td colspan="3" class="s0">410-10</td><td></td><td colspan="5" class="s0">Penjualan Produk 1</td><td></td><td colspan="2" class="s1">300.000</td><td></td><td colspan="3" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td colspan="4" class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td><td class="s1">0</td><td></td>
</tr>-->

<?php 
	foreach($laba as $res)
	{
		echo "
		<tr style=\"height:16px\">
		<td></td><td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
		<td colspan=\"5\" class=\"s0\">".$res->name."</td><td></td>
		<td colspan=\"2\" class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[1][0],$mo[1][1]))."</td><td></td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[2][0],$mo[2][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[3][0],$mo[3][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[4][0],$mo[4][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[5][0],$mo[5][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[6][0],$mo[6][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[7][0],$mo[7][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[8][0],$mo[8][1]))."</td><td></td>
		<td colspan=\"4\" class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[9][0],$mo[9][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[10][0],$mo[10][1]))."</td><td></td> 
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[11][0],$mo[11][1]))."</td><td></td>
		<td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$mo[12][0],$mo[12][1]))."</td><td></td>
		</tr>
		";
		
		
		$totlaba[0]  = $totlaba[0] + floatval(get_vamount_balance($currency,$res->id,$mo[1][0],$mo[1][1]));
		$totlaba[1]  = $totlaba[1] + floatval(get_vamount_balance($currency,$res->id,$mo[2][0],$mo[2][1]));
		$totlaba[2]  = $totlaba[2] + floatval(get_vamount_balance($currency,$res->id,$mo[3][0],$mo[3][1]));
		$totlaba[3]  = $totlaba[3] + floatval(get_vamount_balance($currency,$res->id,$mo[4][0],$mo[4][1]));
		$totlaba[4]  = $totlaba[4] + floatval(get_vamount_balance($currency,$res->id,$mo[5][0],$mo[5][1]));
		$totlaba[5]  = $totlaba[5] + floatval(get_vamount_balance($currency,$res->id,$mo[6][0],$mo[6][1]));
		$totlaba[6]  = $totlaba[6] + floatval(get_vamount_balance($currency,$res->id,$mo[7][0],$mo[7][1]));
		$totlaba[7]  = $totlaba[7] + floatval(get_vamount_balance($currency,$res->id,$mo[8][0],$mo[8][1]));
		$totlaba[8]  = $totlaba[8] + floatval(get_vamount_balance($currency,$res->id,$mo[9][0],$mo[9][1]));
		$totlaba[9]  = $totlaba[9] + floatval(get_vamount_balance($currency,$res->id,$mo[10][0],$mo[10][1]));
		$totlaba[10] = $totlaba[10] + floatval(get_vamount_balance($currency,$res->id,$mo[11][0],$mo[11][1]));
		$totlaba[11] = $totlaba[11] + floatval(get_vamount_balance($currency,$res->id,$mo[12][0],$mo[12][1]));
	}
?>

<!-- Looping Account -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Earnings </td><td></td><td></td><td></td>
<td colspan="2" class="s9"><?php echo num_format($totlaba[0]); ?></td><td></td>
<td colspan="3" class="s9"><?php echo num_format($totlaba[1]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[2]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[3]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[4]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[5]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[6]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[7]); ?></td><td></td>
<td colspan="4" class="s9"><?php echo num_format($totlaba[8]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[9]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[10]); ?></td><td></td>
<td class="s9"><?php echo num_format($totlaba[11]); ?></td><td></td>
</tr>

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Modal -->

<tr style="height:18px">
<td colspan="11" class="s7"> Total Equity </td><td></td><td></td>
<td colspan="2" class="s9"> <?php $modaltot[0] = $totmodal[0] + $totlaba[0];  echo num_format($modaltot[0]); ?> </td><td></td>
<td colspan="3" class="s9"> <?php $modaltot[1] = $totmodal[1] + $totlaba[1];  echo num_format($modaltot[1]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[2] = $totmodal[2] + $totlaba[2];  echo num_format($modaltot[2]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[3] = $totmodal[3] + $totlaba[3];  echo num_format($modaltot[3]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[4] = $totmodal[4] + $totlaba[4];  echo num_format($modaltot[4]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[5] = $totmodal[5] + $totlaba[5];  echo num_format($modaltot[5]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[6] = $totmodal[6] + $totlaba[6];  echo num_format($modaltot[6]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[7] = $totmodal[7] + $totlaba[7];  echo num_format($modaltot[7]); ?> </td><td></td>
<td colspan="4" class="s9"> <?php $modaltot[8] = $totmodal[8] + $totlaba[8];  echo num_format($modaltot[8]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[9] = $totmodal[9] + $totlaba[9];  echo num_format($modaltot[9]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[10] = $totmodal[10] + $totlaba[10];  echo num_format($modaltot[10]); ?> </td><td></td>
<td class="s9"> <?php $modaltot[11] = $totmodal[11] + $totlaba[11];  echo num_format($modaltot[11]); ?> </td><td></td>
</tr>

<!-- Modal -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Net Profit -->
<tr style="height:18px">
<td colspan="11" class="s6"> Total Liabilities & Equity </td><td></td><td></td>
<td colspan="2" class="s5"> <?php echo num_format($kewajiban[0]+$modaltot[0]); ?> </td><td></td>
<td colspan="3" class="s5"> <?php echo num_format($kewajiban[1]+$modaltot[1]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[2]+$modaltot[2]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[3]+$modaltot[3]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[4]+$modaltot[4]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[5]+$modaltot[5]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[6]+$modaltot[6]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[7]+$modaltot[7]); ?> </td><td></td>
<td colspan="4" class="s5"> <?php echo num_format($kewajiban[8]+$modaltot[8]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[9]+$modaltot[9]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[10]+$modaltot[10]); ?> </td><td></td>
<td class="s5"> <?php echo num_format($kewajiban[11]+$modaltot[11]); ?> </td><td></td>
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
