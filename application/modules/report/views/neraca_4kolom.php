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
	
	// harta
	$totkas = 0; $totkas2 = 0; $totkas_budget = 0; $totkas2_budget = 0;
    $totbank = 0; $totbank2 = 0; $totbank_budget = 0; $totbank2_budget = 0;
	$totpiutangusaha = 0; $totpiutangusaha2 = 0; $totpiutangusaha_budget = 0; $totpiutangusaha2_budget = 0;
    $totpiutangnonusaha = 0; $totpiutangnonusaha2 = 0; $totpiutangnonusaha_budget = 0; $totpiutangnonusaha2_budget = 0;
	$totpersediaan = 0; $totpersediaan2 = 0; $totpersediaan_budget = 0; $totpersediaan2_budget = 0;
  	$totbiayadimuka = 0; $totbiayadimuka2 = 0; $totbiayadimuka_budget = 0; $totbiayadimuka2_budget = 0;
	$totinvestasi = 0; $totinvestasi2 = 0; $totinvestasi_budget = 0; $totinvestasi2_budget = 0;
	$tothartawujud = 0; $tothartawujud2 = 0; $tothartawujud_budget = 0; $tothartawujud2_budget = 0;
	$tothartatakwujud = 0; $tothartatakwujud2 = 0; $tothartatakwujud_budget = 0; $tothartatakwujud2_budget = 0;
	$tothartalain = 0; $tothartalain2 = 0; $tothartalain_budget = 0; $tothartalain2_budget = 0;
	$harta = 0; $harta2 = 0; $harta_budget = 0; $harta2_budget = 0;
	
	// kewajiban
	$tothutangusaha = 0; $tothutangusaha2 = 0; $tothutangusaha_budget = 0; $tothutangusaha2_budget = 0;
	$totpendapatandimuka = 0; $totpendapatandimuka2 = 0; $totpendapatandimuka_budget = 0; $totpendapatandimuka2_budget = 0;
	$tothutangpanjang = 0; $tothutangpanjang2 = 0; $tothutangpanjang_budget = 0; $tothutangpanjang2_budget = 0;
	$tothutangnonusaha = 0; $tothutangnonusaha2 = 0; $tothutangnonusaha_budget = 0; $tothutangnonusaha2_budget = 0;
	$tothutanglain = 0; $tothutanglain2 = 0; $tothutanglain_budget = 0; $tothutanglain2_budget = 0;
	
	// modal & laba
	$totmodal = 0; $totmodal2 = 0; $totmodal_budget = 0; $totmodal2_budget = 0;
	$totlaba = 0; $totlaba2 = 0; $totlaba_budget = 0; $totlaba2_budget = 0;
	$modaltot = 0; $modaltot2 = 0; $modaltot_budget = 0; $modaltot2_budget = 0;
	$kewajiban = 0; $kewajiban2 = 0; $kewajiban_budget = 0; $kewajiban2_budget = 0;
	
	function get_acc_amount($cur='IDR',$acc,$m=0,$y=0)
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
	
	function get_acc_budget($cur='IDR',$acc,$m=0,$y=0)
	{
		$am = new Account_model();
		$res = $am->get_budget($cur,$acc,$m,$y)->row();
		return floatval($res->budget);
	}
	
?>

<table align="center" width="80%" border="0" cellspacing="0" cellpadding="0">
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
<td colspan="23" class="s2"> Balance Sheet </td><td></td>
</tr>
<tr style="height:44px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="5" class="s4"><?php echo get_month($months).' '.$years; ?></td><td></td><td></td><td></td><td colspan="3" class="s4"><?php echo get_month($emonths).' '.$eyears; ?></td><td></td>
</tr>

<!-- Harta -->
<tr style="height:16px">
<td colspan="10" class="s5"> Asset </td><td></td><td></td><td rowspan="2" class="s1">Real (<?php echo $currency; ?>)</td><td></td><td colspan="4" rowspan="2" class="s1">Budget (<?php echo $currency; ?>)</td><td></td><td colspan="2" rowspan="2" class="s1">Real (<?php echo $currency; ?>)</td><td></td><td colspan="2" rowspan="2" class="s1">Budget (<?php echo $currency; ?>)</td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Kas -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Kas </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($kas as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totkas = $totkas + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totkas_budget = $totkas_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totkas2 = $totkas2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totkas2_budget = $totkas2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Kas </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totkas); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totkas_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totkas2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totkas2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Kas -->

<!-- Bank -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Bank </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($bank as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totbank = $totbank + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totbank_budget = $totbank_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totbank2 = $totbank2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totbank2_budget = $totbank2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Bank </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totbank); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totbank_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totbank2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totbank2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Bank -->

<!-- Piutang Usaha -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Piutang Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($piutangusaha as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totpiutangusaha = $totpiutangusaha + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totpiutangusaha_budget = $totpiutangusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totpiutangusaha2 = $totpiutangusaha2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totpiutangusaha2_budget = $totpiutangusaha2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Piutang Usaha </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totpiutangusaha); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totpiutangusaha_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totpiutangusaha2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totpiutangusaha2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Piutang Usaha -->

<!-- Piutang Non Usaha -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Piutang Non Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($piutangnonusaha as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totpiutangnonusaha = $totpiutangnonusaha + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totpiutangnonusaha_budget = $totpiutangnonusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totpiutangnonusaha2 = $totpiutangnonusaha2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totpiutangnonusaha2_budget = $totpiutangnonusaha2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5">Total Piutang Non Usaha </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totpiutangnonusaha); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totpiutangnonusaha_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totpiutangnonusaha2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totpiutangnonusaha2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Piutang Non Usaha -->

<!-- Persediaan -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Persediaan </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($persediaan as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totpersediaan = $totpersediaan + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totpersediaan_budget = $totpersediaan_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totpersediaan2 = $totpersediaan2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totpersediaan2_budget = $totpersediaan2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Persediaan </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totpersediaan); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totpersediaan_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totpersediaan2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totpersediaan2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Persediaan -->

<!-- Biaya Dibayar Dimuka -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Biaya Dibayar Dimuka </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($biayadimuka as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totbiayadimuka = $totbiayadimuka + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totbiayadimuka_budget = $totbiayadimuka_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totbiayadimuka2 = $totbiayadimuka2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totbiayadimuka2_budget = $totbiayadimuka2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Biaya Dibayar Dimuka </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totbiayadimuka); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totbiayadimuka_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totbiayadimuka2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totbiayadimuka2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Biaya Dibayar Dimuka -->

<!-- Investasi Jangka Panjang -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Investasi Jangka Panjang </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($investasi as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totinvestasi = $totinvestasi + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totinvestasi_budget = $totinvestasi_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totinvestasi2 = $totinvestasi2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totinvestasi2_budget = $totinvestasi2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Investasi Jangka Panjang </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totinvestasi); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totinvestasi_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totinvestasi2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totinvestasi2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Investasi Jangka Panjang -->

<!-- Harta Tetap Berwujud -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Harta Tetap Berwujud </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($hartawujud as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$tothartawujud = $tothartawujud + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$tothartawujud_budget = $tothartawujud_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$tothartawujud2 = $tothartawujud2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $tothartawujud2_budget = $tothartawujud2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Harta Tetap Berwujud </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($tothartawujud); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($tothartawujud_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothartawujud2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothartawujud2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Harta Tetap Berwujud -->

<!-- Harta Tetap Tidak Berwujud -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($hartatakwujud as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$tothartatakwujud = $tothartatakwujud + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$tothartatakwujud_budget = $tothartatakwujud_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$tothartatakwujud2 = $tothartatakwujud2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $tothartatakwujud2_budget = $tothartatakwujud2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($tothartatakwujud); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($tothartatakwujud_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothartatakwujud2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothartatakwujud2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Harta Tetap Tidak Berwujud -->

<!-- Harta Lainnya -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Harta Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($hartalain as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$tothartalain = $tothartalain + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$tothartalain_budget = $tothartalain_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$tothartalain2 = $tothartalain2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $tothartalain2_budget = $tothartalain2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Harta Lainnya </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($tothartalain); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($tothartalain_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothartalain2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothartalain2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Harta Lainnya -->



<tr style="height:18px">
<td colspan="11" class="s5"> Total Asset </td><td></td>
<td class="s6"> <?php $harta = $totkas + $totbank + $totpiutangusaha + $totpiutangnonusaha + $totpersediaan + $totbiayadimuka +  $totinvestasi + $tothartawujud + $tothartatakwujud + $tothartalain ;  echo num_format($harta); ?> </td><td></td>
<td colspan="4" class="s6"> <?php $harta_budget = $totkas_budget + $totbank_budget + $totpiutangusaha_budget + $totpiutangnonusaha_budget + $totpersediaan_budget + $totbiayadimuka_budget +  $totinvestasi_budget + $tothartawujud_budget + $tothartatakwujud_budget + $tothartalain_budget ;  echo num_format($harta_budget); ?> </td><td></td>
<td colspan="2" class="s6"> <?php $harta2 = $totkas2 + $totbank2 + $totpiutangusaha2 + $totpiutangnonusaha2 + $totpersediaan2 + $totbiayadimuka2 +  $totinvestasi2 + $tothartawujud2 + $tothartatakwujud2 + $tothartalain2 ;  echo num_format($harta2); ?> </td><td></td>
<td colspan="2" class="s6"> <?php $harta2_budget = $totkas2_budget + $totbank2_budget + $totpiutangusaha2_budget + $totpiutangnonusaha2_budget + $totpersediaan2_budget + $totbiayadimuka2_budget +  $totinvestasi2_budget + $tothartawujud2_budget + $tothartatakwujud2_budget + $tothartalain2_budget ;  echo num_format($harta2_budget); ?> </td>
</tr>
<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Total Harta -->


<!-- Kewajiban -->
<tr style="height:16px">
<td colspan="10" class="s5"> Liabilities </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Usaha -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Hutang Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($hutangusaha as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$tothutangusaha = $tothutangusaha + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$tothutangusaha_budget = $tothutangusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$tothutangusaha2 = $tothutangusaha2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $tothutangusaha2_budget = $tothutangusaha2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Hutang Usaha </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($tothutangusaha); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($tothutangusaha_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothutangusaha2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothutangusaha2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Hutang Usaha -->

<!-- Pendapatan Terima Dimuka -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Pendapatan Terima Dimuka </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($pendapatandimuka as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totpendapatandimuka = $totpendapatandimuka + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totpendapatandimuka_budget = $totpendapatandimuka_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totpendapatandimuka2 = $totpendapatandimuka2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totpendapatandimuka2_budget = $totpendapatandimuka2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Pendapatan Terima Dimuka </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totpendapatandimuka); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totpendapatandimuka_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totpendapatandimuka2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totpendapatandimuka2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Pendapatan Terima Dimuka -->

<!-- Hutang Jangka Panjang -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Hutang Jangka Panjang </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($hutangpanjang as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$tothutangpanjang = $tothutangpanjang + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$tothutangpanjang_budget = $tothutangpanjang_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$tothutangpanjang2 = $tothutangpanjang2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $tothutangpanjang2_budget = $tothutangpanjang2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Hutang Jangka Panjang </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($tothutangpanjang); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($tothutangpanjang_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothutangpanjang2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothutangpanjang2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Hutang Jangka Panjang -->

<!-- Hutang Non Usaha -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Hutang Non Usaha </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($hutangnonusaha as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$tothutangnonusaha = $tothutangnonusaha + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$tothutangnonusaha_budget = $tothutangnonusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$tothutangnonusaha2 = $tothutangnonusaha2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $tothutangnonusaha2_budget = $tothutangnonusaha2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Hutang Non Usaha </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($tothutangnonusaha); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($tothutangnonusaha_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothutangnonusaha2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothutangnonusaha2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Hutang Non Usaha -->

<!-- Hutang Lainnya -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Hutang Lainnya </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($hutanglain as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$tothutanglain = $tothutanglain + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$tothutanglain_budget = $tothutangnonusaha_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$tothutanglain2 = $tothutanglain2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $tothutanglain2_budget = $tothutanglain2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Hutang Lainnya </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($tothutanglain); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($tothutanglain_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothutanglain2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($tothutanglain2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Hutang Lainnya -->



<tr style="height:18px">
<td colspan="11" class="s5"> Total Liabilities   </td><td></td>
<td class="s6"> <?php $kewajiban = $tothutangusaha + $totpendapatandimuka + $tothutangpanjang + $tothutangnonusaha + $tothutanglain;  echo num_format($kewajiban); ?> </td><td></td>
<td colspan="4" class="s6"> <?php $kewajiban_budget = $tothutangusaha_budget + $totpendapatandimuka_budget + $tothutangpanjang_budget + $tothutangnonusaha_budget + $tothutanglain_budget;  echo num_format($kewajiban_budget); ?> </td><td></td>
<td colspan="2" class="s6"> <?php $kewajiban2 = $tothutangusaha2 + $totpendapatandimuka2 + $tothutangpanjang2 + $tothutangnonusaha2 + $tothutanglain2;  echo num_format($kewajiban2); ?> </td><td></td>
<td colspan="2" class="s6"> <?php $kewajiban2_budget = $tothutangusaha2_budget + $totpendapatandimuka2_budget + $tothutangpanjang2_budget + $tothutangnonusaha2_budget + $tothutanglain2_budget;  echo num_format($kewajiban2_budget); ?> </td>
</tr>

<!-- Modal & Laba -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Modal -->
<tr style="height:16px">
<td colspan="10" class="s5"> Equity </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Modal -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Capital </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($modal as $res)
	{
	   if (get_acc_amount($currency,$res->id,$months,$years,$emonths,$eyears) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_amount($currency,$res->id,$emonths,$eyears,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totmodal = $totmodal + floatval(get_acc_amount($currency,$res->id,$months,$years));
		$totmodal_budget = $totmodal_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totmodal2 = $totmodal2 + floatval(get_acc_amount($currency,$res->id,$emonths,$eyears));  
   	    $totmodal2_budget = $totmodal2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Capital </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totmodal); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totmodal_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totmodal2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totmodal2_budget); ?></td>
</tr>

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<!-- Modal -->

<!-- Laba -->
<tr style="height:16px">
<td></td><td colspan="9" class="s5"> Earnings </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Looping -->
<?php 
	foreach($laba as $res)
	{
	   if (get_vamount_balance($currency,$res->id,$months,$years) != 0)
	   {
		      echo "<tr style=\"height:15px\">
              <td></td><td></td> <td colspan=\"3\" class=\"s0\">".$res->code."</td><td></td>
			  <td colspan=\"4\" class=\"s0\">".$res->name."</td><td></td><td></td>
			  <td class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$months,$years,$months,$years))."</td><td></td>
			  <td colspan=\"4\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$months,$years))."</td><td></td>
			  <td colspan=\"2\" class=\"s1\">".num_format(get_vamount_balance($currency,$res->id,$months,$years,$emonths,$eyears))."</td><td></td> 
			  <td colspan=\"2\" class=\"s1\">".num_format(get_acc_budget($currency,$res->id,$emonths,$eyears))."</td>
			  </tr>";
	   }
		
		$totlaba = $totlaba + floatval(get_vamount_balance($currency,$res->id,$months,$years,$months,$years));
		$totlaba_budget = $totlaba_budget + floatval(get_acc_budget($currency,$res->id,$months,$years));
		
		$totlaba2 = $totlaba2 + floatval(get_vamount_balance($currency,$res->id,$months,$years,$emonths,$eyears));  
   	    $totlaba2_budget = $totlaba2_budget + floatval(get_acc_budget($currency,$res->id,$emonths,$eyears));
		
	}
?>
<!-- Looping -->

<tr style="height:18px">
<td></td><td colspan="8" class="s5"> Total Earnings </td><td></td><td></td><td></td>
<td class="s6"><?php echo num_format($totlaba); ?></td><td></td>
<td colspan="4" class="s6"><?php echo num_format($totlaba_budget); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totlaba2); ?></td><td></td>
<td colspan="2" class="s6"><?php echo num_format($totlaba2_budget); ?></td>
</tr>

<!-- Laba -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:18px">
<td colspan="11" class="s5"> Total Equity </td><td></td>
<td class="s6"> <?php $modaltot = $totmodal + $totlaba;  echo num_format($modaltot); ?> </td><td></td>
<td colspan="4" class="s6"> <?php $modaltot_budget = $totmodal_budget + $totlaba_budget;  echo num_format($modaltot_budget); ?> </td><td></td>
<td colspan="2" class="s6"> <?php $modaltot2 = $totmodal2 + $totlaba2;  echo num_format($modaltot2); ?> </td><td></td>
<td colspan="2" class="s6"> <?php $modaltot2_budget = $totmodal2_budget + $totlaba2_budget;  echo num_format($modaltot2_budget); ?> </td>
</tr>

<!-- Modal & Laba -->

<tr style="height:8px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:18px">
<td colspan="11" class="s7"> Total Liabilities & Equity </td><td></td>
<td class="s8"> <?php echo num_format($kewajiban+$totmodal+$totlaba); ?> </td><td></td>
<td colspan="4" class="s8"> <?php echo num_format($kewajiban_budget+$totmodal_budget+$totlaba_budget); ?> </td><td></td>
<td colspan="2" class="s8"> <?php echo num_format($kewajiban2+$totmodal2+$totlaba2); ?> </td><td></td>
<td colspan="2" class="s8"> <?php echo num_format($kewajiban2_budget+$totmodal2_budget+$totlaba2_budget); ?> </td>
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
