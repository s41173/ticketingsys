<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name=Generator content="FastReport 3.0 http://www.fast-report.com">
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" >
<title> <?php echo isset($title) ? $title : ''; ?>  </title>
<style type="text/css"><!-- 

table td{ padding:2px 3px 2px 0;}

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
 color: #000000; font-style: normal;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 1;
 border-right-width: 0px;
 border-top-width: 0px;
 border-bottom-width: 1;
 text-align: Center; vertical-align: Middle;
}
.s6 {
 font-family: Arial;
 font-size: 1px;
 color: #000000; font-style: normal;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 2;
 border-bottom-width: 0px;
 text-align: Left; vertical-align: Top;
}
.s7 {
 font-family: Arial;
 font-size: 11px;
 color: #000000; font-style: normal;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 0px;
 border-bottom-width: 1;
 text-align: Left; vertical-align: Middle;
}
.s8 {
 font-family: Arial;
 font-size: 11px;
 color: #000000; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Top;
}
.s9 {
 font-family: Arial;
 font-size: 11px;
 color: #000000; font-style: normal;;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 1;
 border-right-width: 0px;
 border-top-width: 0px;
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
.s11 {
 font-family: Arial;
 font-size: 11px;
 color: #000000; font-weight: bold; font-style: normal;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 1;
 border-right-width: 0px;
 border-top-width: 0px;
 border-bottom-width: 0px;
 text-align: Right; vertical-align: Middle;
}
.s12 {
 font-family: Arial;
 font-size: 11px;
 color: #000000; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Left; vertical-align: Middle;
}
.s13 {
 font-family: Arial;
 font-size: 11px;
 color: #000000; font-style: normal;;
 background-color: transparent;
 text-align: Center; vertical-align: Middle;
}
--></style>
</head>
<body bgcolor="#FFFFFF" text="#000000">

<?php

	function cek_acc($clid)
	{
		$cl = new Classification();
		$cl->where('id', $clid)->get();
		$type = $cl->type;
		if ($type == 'harta'){ return $type; } 
		elseif ($type == 'kewajiban'){ return $type; }
		elseif ($type == 'modal'){ return $type; }
		else { return FALSE; }
	}
	
	function get_cla($clid)
	{
		$cl = new Classification();
		$cl->where('id', $clid)->get();
		return $cl->type;
	}
	
	function get_begin_balance($acc,$clid,$m,$y,$type)
	{
		$bl = new Balances();
		$debit = 0;
		$credit = 0;
		
		if (cek_acc($clid) == FALSE){ $debit=0; $credit=0;}
		else
		{
			$bl->where('account_id', $acc);
			$bl->where('month', $m);
			$bl->where('year', $y)->get();
			
			if (cek_acc($clid) == 'harta'){if ($bl->beginning > 0){ $debit = $bl->beginning; }else{ $credit = abs($bl->beginning); }}
			if (cek_acc($clid) == 'kewajiban'){if ($bl->beginning > 0){ $credit = $bl->beginning; }else{ $debit = abs($bl->beginning); }}
			if (cek_acc($clid) == 'modal'){if ($bl->beginning > 0){ $credit = $bl->beginning; }else{ $debit = abs($bl->beginning); }}
		}
		
		if ($type == 'debit'){ return $debit; } elseif ($type == 'credit'){ return $credit; }
	}
	
	function get_trans($cur='IDR',$acc,$m,$y,$clid,$type)
	{
		$ps = new Period();
		$ps->get();
		
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$m,$y)->row();
		$res = $res->vamount;
		
		$debit = 0;
		$credit = 0;
		
		if (get_cla($clid) == 'harta'){ if ($res > 0){ $debit = $res; } else{ $credit = abs($res); }}
		if (get_cla($clid) == 'biaya'){ if ($res > 0){ $debit = $res;} else{ $credit = abs($res); }}
		if (get_cla($clid) == 'kewajiban'){ if ($res > 0){ $credit = $res;} else{ $debit = abs($res); }}
		if (get_cla($clid) == 'modal'){ if ($res > 0){ $credit = $res;} else{ $debit = abs($res); }}
		if (get_cla($clid) == 'pendapatan'){ if ($res > 0){ $credit = $res;} else{ $debit = abs($res); }}
		
		if ($type == 'debit'){ return $debit; } elseif ($type == 'credit'){ return $credit; }
	}
	
	function get_end_balance($cur='IDR',$acc,$m,$y,$clid,$type)
	{
		$ps = new Period();
		$ps->get();
		
		$bl = new Balances();
		$bl->where('account_id', $acc);
        $bl->where('month', $m);
        $bl->where('year', $y)->get();
		
		$am = new Account_model();
		$res = $am->get_period_balance($cur,$acc,$m,$y,$m,$y)->row();
		$res = floatval($res->vamount + $bl->beginning);
		
		$debit = 0;
		$credit = 0;
		
		if (get_cla($clid) == 'harta'){ if ($res > 0){ $debit = $res; } else{ $credit = abs($res); }}
		if (get_cla($clid) == 'biaya'){ if ($res > 0){ $debit = $res;} else{ $credit = abs($res); }}
		if (get_cla($clid) == 'kewajiban'){ if ($res > 0){ $credit = $res;} else{ $debit = abs($res); }}
		if (get_cla($clid) == 'modal'){ if ($res > 0){ $credit = $res;} else{ $debit = abs($res); }}
		if (get_cla($clid) == 'pendapatan'){ if ($res > 0){ $credit = $res;} else{ $debit = abs($res); }}
		
		if ($type == 'debit'){ return $debit; } elseif ($type == 'credit'){ return $credit; }
	}
	
?>

<a name="PageN1"></a>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr style="height: 1px"><td width="68"></td><td width="4"></td><td width="7"></td><td width="86"></td><td width="13"></td><td width="15"></td><td width="151"></td><td width="21"></td><td width="2"></td><td width="113"></td><td width="113"></td><td width="113"></td><td width="57"></td><td width="15"></td><td width="42"></td><td width="62"></td><td width="51"></td><td width="113"></td></tr>
<tr style="height:18px">
<td></td><td colspan="4" class="s0"> <?php echo date('F d Y'); ?> </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="5" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:24px">
<td></td><td></td><td></td><td></td><td colspan="12" rowspan="2" class="s3"> <?php echo isset($company) ? $company : ''; ?> </td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:31px">
<td></td><td></td><td></td><td></td><td colspan="12" class="s2">Trial Balance</td><td></td><td></td>
</tr>
<tr style="height:4px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:26px">
<td></td><td></td><td></td><td></td>
<td colspan="12" class="s4"><?php echo get_month($months).' '.$years.' - '.get_month($emonths).' '.$eyears; ?></td><td></td><td></td>
</tr>
<tr style="height:1px;">
<td colspan="9" rowspan="3" class="s7"> Chart of Account </td> 
<td colspan="9" class="s7" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:20px">
<td colspan="2" class="s13">Beginning Balance</td><td colspan="4" class="s13">This Month Activity</td><td colspan="3" class="s13">Ending Balance</td>
</tr>
<tr style="height:21px">
<td class="s5">Debit</td><td class="s5">Credit</td><td class="s5">Debit</td><td colspan="3" class="s5">Credit</td><td colspan="2" class="s5">Debit</td><td class="s5">Credit</td>
</tr>

<!-- Account List -->
<!--<tr style="height:17px">
<td colspan="3" class="s8">110-20</td><td colspan="5" class="s8">Kas</td><td></td><td class="s9">31.180.347.00</td><td class="s9" style="font-size:1px">&nbsp;</td><td class="s9" style="font-size:1px">&nbsp;</td><td colspan="3" class="s9">28.066.978.00</td><td colspan="2" class="s9">3.113.369.00</td><td class="s9" style="font-size:1px">&nbsp;</td>
</tr>-->

<?php
	
	$totbegin_d = 0;
	$totbegin_c = 0;
	$tottrans_d = 0;
	$tottrans_c = 0;
	$totend_d = 0;
	$totend_c = 0;
	
	foreach($accounts as $res)
	{
		echo "
		<tr style=\"height:17px\">
        <td colspan=\"3\" class=\"s8\">".$res->code."</td> <td colspan=\"5\" class=\"s8\">".$res->name."</td> 
		<td></td> <td class=\"s9\">".num_format(get_begin_balance($res->id,$res->classification_id,$months,$years,'debit'))."</td> 
		<td class=\"s9\">".num_format(get_begin_balance($res->id,$res->classification_id,$months,$years,'credit'))."</td> 
		<td class=\"s9\">".num_format(get_trans($currency,$res->id,$months,$years,$res->classification_id,'debit'))."</td> 
		<td colspan=\"3\" class=\"s9\">".num_format(get_trans($currency,$res->id,$months,$years,$res->classification_id,'credit'))."</td> 
		<td colspan=\"2\" class=\"s9\">".num_format(get_end_balance($currency,$res->id,$months,$years,$res->classification_id,'debit'))."</td> 
		<td class=\"s9\">".num_format(get_end_balance($currency,$res->id,$months,$years,$res->classification_id,'credit'))."</td>
        </tr>
		";
		
		$totbegin_d = floatval($totbegin_d + get_begin_balance($res->id,$res->classification_id,$months,$years,'debit'));
		$totbegin_c = floatval($totbegin_c + get_begin_balance($res->id,$res->classification_id,$months,$years,'credit'));
		$tottrans_d = floatval($tottrans_d + get_trans($currency,$res->id,$months,$years,$res->classification_id,'debit'));
		$tottrans_c = floatval($tottrans_c + get_trans($currency,$res->id,$months,$years,$res->classification_id,'credit'));
		$totend_d = floatval($totend_d + get_end_balance($currency,$res->id,$months,$years,$res->classification_id,'debit'));
		$totend_c = floatval($totend_c + get_end_balance($currency,$res->id,$months,$years,$res->classification_id,'credit'));
	}
	
?>


<!-- Account List -->

<!-- end -->

<tr style="height:1px">
<td colspan="7" rowspan="2" class="s12">Total:</td><td colspan="2" class="s10" style="font-size:1px">&nbsp;</td>
<td rowspan="2" class="s11"> <?php echo num_format($totbegin_d); ?> </td>
<td rowspan="2" class="s11"> <?php echo num_format($totbegin_c); ?> </td>
<td rowspan="2" class="s11"> <?php echo num_format($tottrans_d); ?> </td>
<td colspan="3" rowspan="2" class="s11"> <?php echo num_format($tottrans_c); ?> </td>
<td colspan="2" rowspan="2" class="s11"> <?php echo num_format($totend_d); ?> </td>
<td rowspan="2" class="s11"> <?php echo num_format($totend_c); ?> </td>
</tr>

</table>
</body></html>
