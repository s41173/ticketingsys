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
.s5 {
 font-family: Arial;
 font-size: 12px;
 color: #434889; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s6 {
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
.s7 {
 font-family: Arial;
 font-size: 12px;
 color: #80334A; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s8 {
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
	
	// harta
	$totkas = 0; $totkas_budget = 0;
    $totbank = 0; $totbank_budget = 0;
	$totpiutangusaha = 0; $totpiutangusaha_budget = 0;
    $totpiutangnonusaha = 0; $totpiutangnonusaha_budget = 0;
	$totpersediaan = 0; $totpersediaan_budget = 0;
  	$totbiayadimuka = 0; $totbiayadimuka_budget = 0;
	$totinvestasi = 0; $totinvestasi_budget = 0;
	$tothartawujud = 0; $tothartawujud_budget = 0;
	$tothartatakwujud = 0; $tothartatakwujud_budget = 0;
	$tothartalain = 0; $tothartalain_budget = 0;
	$harta = 0; $harta_budget = 0;
	
	// kewajiban
	$tothutangusaha = 0; $tothutangusaha_budget = 0;
	$totpendapatandimuka = 0; $totpendapatandimuka_budget = 0;
	$tothutangpanjang = 0; $tothutangpanjang_budget = 0;
	$tothutangnonusaha = 0; $tothutangnonusaha_budget = 0;
	$tothutanglain = 0; $tothutanglain_budget = 0;
	
	// modal & laba
	$totmodal = 0; $totmodal_budget = 0;
	$totlaba = 0; $totlaba_budget = 0;
	$modaltot = 0; $modaltot_budget = 0;
	$kewajiban = 0; $kewajiban_budget = 0;
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0,$em=0,$ey=0)
	{
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$em,$ey)->row();
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
		$res = $am->get_period_vamount($cur,$acc,$m,$y,$em,$ey)->row();		
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
	
	function get_acc_budget($cur='IDR',$acc,$m=0,$y=0,$em=0,$ey=0)
	{
	   $am = new Account_model();
	   $res = $am->get_period_budget($cur,$acc,$m,$y,$em,$ey)->row();
	   return floatval($res->budget);
	}
	
?>

<table align="center" width="920px" border="0" cellspacing="0" cellpadding="0">
<tr style="height: 1px"><td width="34"></td><td width="34"></td><td width="4"></td><td width="26"></td><td width="17"></td><td width="58"></td><td width="1"></td><td width="4"></td><td width="15"></td><td width="162"></td><td width="53"></td><td width="4"></td><td width="11"></td><td width="7"></td><td width="5"></td><td width="15"></td><td width="87"></td><td width="8"></td><td width="113"></td><td width="61"></td></tr>
<tr style="height:18px">
<td colspan="2" class="s0"> </td><td></td><td colspan="6" class="s0"> <?php echo date('d M Y').' - '.waktuindo(); ?> </td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="5" class="s1" style="font-size:1px">&nbsp;</td>
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
<td colspan="20" class="s2"> Balance Sheet </td>
</tr>
<tr style="height:39px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="4" class="s4"> Balance </td><td></td><td class="s4"> Budget </td><td></td>
</tr>

<!-- Harta -->

<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Asset </td><td></td><td></td><td></td><td colspan="4" rowspan="2" class="s1"> <?php echo $currency; ?> </td><td></td><td rowspan="2" class="s1"> <?php echo $currency; ?> </td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Kas -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Kas </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($kas as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totkas = $totkas + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totkas_budget = $totkas_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5">Total Kas</td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totkas); ?> </td><td></td>  <td class="s6"> <?php echo num_format($totkas_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Kas -->

<!-- Bank -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Bank </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($bank as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totbank = $totbank + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totbank_budget = $totbank_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5">Total Bank</td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totbank); ?> </td><td></td>  <td class="s6"> <?php echo num_format($totbank_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Bank -->

<!-- Piutang Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Piutang Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($piutangusaha as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totpiutangusaha = $totpiutangusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totpiutangusaha_budget = $totpiutangusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Piutang Usaha </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totpiutangusaha); ?> </td><td></td>  <td class="s6"> <?php echo num_format($totpiutangusaha_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Piutang Usaha -->

<!-- Piutang Non Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Piutang Non Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($piutangnonusaha as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totpiutangnonusaha = $totpiutangnonusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totpiutangnonusaha_budget = $totpiutangnonusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Piutang Non Usaha </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totpiutangnonusaha); ?> </td><td></td>  
<td class="s6"> <?php echo num_format($totpiutangnonusaha_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Piutang Non Usaha -->

<!-- Persediaan -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Persediaan </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($persediaan as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totpersediaan = $totpersediaan + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totpersediaan_budget = $totpersediaan_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Persediaan </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totpersediaan); ?> </td><td></td>  
<td class="s6"> <?php echo num_format($totpersediaan_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Persediaan -->

<!-- Biaya Dibayar Dimuka -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Biaya Dibayar Dimuka </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($biayadimuka as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totbiayadimuka = $totbiayadimuka + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totbiayadimuka_budget = $totbiayadimuka_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Biaya Dibayar Dimuka </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totbiayadimuka); ?> </td><td></td>  
<td class="s6"> <?php echo num_format($totbiayadimuka_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Biaya Dibayar Dimuka -->

<!-- Investasi Jangka Panjang -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Investasi Jangka Panjang </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($investasi as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totinvestasi = $totinvestasi + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totinvestasi_budget = $totinvestasi_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Investasi Jangka Panjang </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totinvestasi); ?> </td><td></td>  
<td class="s6"> <?php echo num_format($totinvestasi_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Investasi Jangka Panjang -->

<!-- Harta Tetap Berwujud -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Harta Tetap Berwujud </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($hartawujud as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$tothartawujud = $tothartawujud + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothartawujud_budget = $tothartawujud_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Harta Tetap Berwujud </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($tothartawujud); ?> </td><td></td>  
<td class="s6"> <?php echo num_format($tothartawujud_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Harta Tetap Berwujud -->

<!-- Harta Tetap Tidak Berwujud -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($hartatakwujud as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$tothartatakwujud = $tothartatakwujud + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothartatakwujud_budget = $tothartatakwujud_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Harta Tetap Tidak Berwujud </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($tothartatakwujud); ?> </td><td></td>  
<td class="s6"> <?php echo num_format($tothartatakwujud_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Harta Tetap Tidak Berwujud -->

<!-- Harta Lainnya -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Harta Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($hartalain as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$tothartalain = $tothartalain + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothartalain_budget = $tothartalain_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Harta Lainnya </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($tothartalain); ?> </td><td></td>  
<td class="s6"> <?php echo num_format($tothartalain_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Harta Lainnya -->




<tr style="height:18px">
<td></td><td colspan="9" class="s5"> Total Asset </td><td></td><td></td><td></td>
<td colspan="4" class="s8"> <?php $harta = $totkas + $totbank + $totpiutangusaha + $totpiutangnonusaha + $totpersediaan + $totbiayadimuka +  $totinvestasi + $tothartawujud + $tothartatakwujud + $tothartalain ;  echo num_format($harta); ?> </td><td></td>
<td class="s8"> <?php $harta_budget = $totkas_budget + $totbank_budget + $totpiutangusaha_budget + $totpiutangnonusaha_budget + $totpersediaan_budget + $totbiayadimuka_budget +  $totinvestasi_budget + $tothartawujud_budget + $tothartatakwujud_budget + $tothartalain_budget ;  echo num_format($harta_budget); ?> </td><td></td>
</tr>

<!-- Harta -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Kewajiban -->

<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Liabilities </td><td></td><td></td><td></td><td colspan="4" rowspan="2" class="s1"> </td><td></td><td rowspan="2" class="s1"> </td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Hutang Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($hutangusaha as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$tothutangusaha = $tothutangusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothutangusaha_budget = $tothutangusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Hutang Usaha </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($tothutangusaha); ?> </td><td></td>  <td class="s6"> <?php echo num_format($tothutangusaha_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Hutang Usaha -->

<!-- Pendapatan Terima Dimuka -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Pendapatan Terima Dimuka </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($pendapatandimuka as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totpendapatandimuka = $totpendapatandimuka + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totpendapatandimuka_budget = $totpendapatandimuka_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Pendapatan Terima Dimuka </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totpendapatandimuka); ?> </td><td></td>  <td class="s6"> <?php echo num_format($totpendapatandimuka_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Pendapatan Terima Dimuka -->

<!-- Hutang Jangka Panjang -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Hutang Jangka Panjang </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($hutangpanjang as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$tothutangpanjang = $tothutangpanjang + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothutangpanjang_budget = $tothutangpanjang_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Hutang Jangka Panjang </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($tothutangpanjang); ?> </td><td></td>  <td class="s6"> <?php echo num_format($tothutangpanjang_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Hutang Jangka Panjang -->

<!-- Hutang Non Usaha -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Hutang Non Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($hutangnonusaha as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$tothutangnonusaha = $tothutangnonusaha + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothutangnonusaha_budget = $tothutangnonusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Hutang Non Usaha </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($tothutangnonusaha); ?> </td><td></td>  <td class="s6"> <?php echo num_format($tothutangnonusaha_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Hutang Non Usaha -->

<!-- Hutang Lainnya -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Hutang Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($hutanglain as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$tothutanglain = $tothutanglain + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$tothutanglain_budget = $tothutanglain_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Hutang Lainnya </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($tothutanglain); ?> </td><td></td>  <td class="s6"> <?php echo num_format($tothutanglain_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Hutang Lainnya -->



<tr style="height:18px">
<td></td><td colspan="9" class="s5"> Total Liabilities </td><td></td><td></td><td></td>
<td colspan="4" class="s8"> <?php $kewajiban = $tothutangusaha + $totpendapatandimuka + $tothutangpanjang + $tothutangnonusaha + $tothutanglain;  echo num_format($kewajiban); ?> </td><td></td>
<td class="s8"> <?php $kewajiban_budget = $tothutangusaha_budget + $totpendapatandimuka_budget + $tothutangpanjang_budget + $tothutangnonusaha_budget + $tothutanglain_budget;  echo num_format($kewajiban_budget); ?> </td><td></td>
</tr>

<!-- Kewajiban -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Modal & Laba -->

<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Equity </td><td></td><td></td><td></td><td colspan="4" rowspan="2" class="s1"> </td><td></td><td rowspan="2" class="s1"> </td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Modal -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Capital </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($modal as $res)
	{
		if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totmodal = $totmodal + floatval(get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears));
		$totmodal_budget = $totmodal_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Capital </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totmodal); ?> </td><td></td>  <td class="s6"> <?php echo num_format($totmodal_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Modal -->

<!-- Laba -->
<tr style="height:16px">
<td></td><td></td><td></td><td></td><td colspan="8" class="s5"> Earnings </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php 
	foreach($laba as $res)
	{
		if (get_vamount_balance($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
		{
			echo "
			<tr style=\"height:15px\">
			<td></td><td></td><td></td><td></td><td></td><td class=\"s0\">".$res->code."</td><td></td> 
			<td colspan=\"7\" class=\"s0\"> ".$res->name." </td><td></td> 
			<td colspan=\"2\" class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$months,$years,$emonths,$eyears))."</td> <td></td> 
			<td class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td>
			</tr>
			";
		}
		
		$totlaba = $totlaba + floatval(get_vamount_balance($currency,$res->id,$months,$years,$emonths,$eyears));
		$totlaba_budget = $totlaba_budget + floatval(get_acc_budget($currency,$res->id,$months,$years,$emonths,$eyears));  
	}
?>

<!-- Looping Account -->

<tr style="height:18px">
<td></td><td></td><td></td><td></td><td colspan="7" class="s5"> Total Earnings </td><td></td><td></td>
<td colspan="4" class="s6"> <?php echo num_format($totlaba); ?> </td><td></td>  <td class="s6"> <?php echo num_format($totlaba_budget); ?> </td><td></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Laba -->


<tr style="height:18px">
<td></td><td colspan="9" class="s5"> Total Equity  </td><td></td><td></td><td></td>
<td colspan="4" class="s8"> <?php $modaltot = $totmodal + $totlaba;  echo num_format($modaltot); ?> </td><td></td>
<td class="s8"> <?php $modaltot_budget = $totmodal_budget + $totlaba_budget;  echo num_format($modaltot_budget); ?> </td><td></td>
</tr>

<!-- Modal & Laba -->


<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:18px">
<td></td><td colspan="9" class="s7"> Total Liabilities & Equity </td><td></td><td></td><td></td>
<td colspan="4" class="s8"> <?php echo num_format($kewajiban+$modaltot); ?> </td><td></td>
<td class="s8"> <?php echo num_format($kewajiban_budget+$modaltot_budget); ?> </td><td></td>
</tr>

<tr style="height:23px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:1px">
<td colspan="20" class="s9" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:1px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td colspan="8" class="s0"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="4" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
</table>

</body> 
</html>
