<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name=Generator content="FastReport 3.0 http://www.fast-report.com">
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" >
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
 text-align: Center; vertical-align: Top;
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
 font-size: 11px;
 color: #000000; font-style: normal;
 background-color: transparent;
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
 border-top-width: 1;
 border-bottom-width: 0px;
 text-align: Right; vertical-align: Top;
}
.s8 {
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
.s9 {
 font-family: Arial;
 font-size: 12px;
 color: #434889; font-weight: bold; font-style: normal;
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
 font-size: 12px;
 color: #434889; font-weight: bold; font-style: normal;
 background-color: transparent;
 text-align: Right; vertical-align: Top;
}
.s11 {
 font-family: Arial;
 font-size: 12px;
 color: #434889; font-weight: bold; font-style: normal;;
 background-color: transparent;
 border-color:#000000; border-style: solid;
 border-left-width: 0px;
 border-right-width: 0px;
 border-top-width: 1;
 border-bottom-width: 1;
 text-align: Right; vertical-align: Middle;
}
--></style>
</head>
<body bgcolor="#FFFFFF" text="#000000">

<?php

// Operating Activities
	$tot_piutang_usaha = 0;
	$tot_piutang_non_usaha = 0;
	$tot_persediaan = 0;
    $tot_hutang_usaha = 0;
    $tot_pendapatan_dimuka = 0;
	$tot_pendapatan_usaha = 0;
	$tot_pendapatan_usaha_lain = 0;
    $tot_biaya_usaha = 0;
	$tot_biaya_usaha_lain = 0;
   	$tot_biaya_adm = 0;			
// Operating Activities

// Investing Activities
    $tot_biaya_dimuka = 0;
	$tot_investasi_panjang = 0;
	$tot_harta_berwujud = 0;
	$tot_harta_tak_berwujud = 0;
	$tot_harta_lain = 0;
	$tot_biaya_non_operasional = 0;
// Investing Activities

// Financing Activities
   	$tot_hutang_panjang = 0;
    $tot_hutang_non_usaha = 0;
	$tot_hutang_lain = 0;
	$tot_modal = 0;
	$tot_laba = 0;
	$tot_pendapatan_luar_usaha = 0;
	$tot_pengeluaran_luar_usaha = 0;
// Financing Activities

	function get_acc_type($acc)
	{
		$cl = new Classification_lib();
		$ac = new Account_lib();
		
		$cla = $ac->get_classi($acc);
		$type = $cl->get_type($cla);
		return $type;
	}

	function get_trans($cur='IDR',$acc,$start,$end)
	{
		$am = new Account_model();
		$res = $am->get_cash_flow($cur,$acc,$start,$end);
		$type = get_acc_type($acc);
		$result = 0;
		
		if ($type == 'harta'){ if ($res > 0){ $result = 0 - $res; }else { $result = abs($res); } }
		elseif ($type == 'biaya'){ if ($res > 0){ $result = 0 - $res; }else { $result = abs($res); } }
		elseif ($type == 'pendapatan'){ if ($res > 0){ $result = $res; }else { $result = 0-$res; } }
		elseif ($type == 'kewajiban'){ if ($res > 0){ $result = $res; }else { $result = 0-$res; } }
		elseif ($type == 'modal'){ if ($res > 0){ $result = $res; }else { $result = 0-$res; } }
		
		return $result;
	}
	
	function get_begin_balance($cur='IDR',$start)
	{
		$bl = new Balance();
		$am = new Account_model();
		$start_kas = $am->get_start_balance_by_classification($cur,7,$start);
		$start_bank = $am->get_start_balance_by_classification($cur,8,$start);
		$start_saldo = floatval($start_kas + $start_bank);
		
		$beginning_kas = $am->get_begining_balance_classification($cur,7,$start);
		$beginning_bank = $am->get_begining_balance_classification($cur,8,$start);
		$beginning_saldo = floatval($beginning_kas + $beginning_bank);
		return $start_saldo + $beginning_saldo;	
		return $beginning_bank;
	}
	

?>

<a name="PageN1"></a>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr style="height: 1px"><td width="68"></td><td width="4"></td><td width="34"></td><td width="23"></td><td width="21"></td><td width="28"></td><td width="9"></td><td width="6"></td><td width="28"></td><td width="100"></td><td width="100"></td><td width="2"></td><td width="2"></td><td width="9"></td><td width="8"></td><td width="8"></td><td width="9"></td><td width="2"></td><td width="2"></td><td width="1"></td><td width="18"></td><td width="4"></td><td width="94"></td><td width="19"></td><td width="38"></td><td width="81"></td></tr>
<tr style="height:18px">
<td class="s0"></td><td></td><td colspan="6" class="s0"></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="12" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:22px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:24px">
<td colspan="26" rowspan="2" class="s3"> <?php echo isset($company) ? $company : ''; ?> </td>
</tr>
<tr style="height:2px">
</tr>
<tr style="height:35px">
<td colspan="26" class="s2"> Cash Flow </td>
</tr>
<tr style="height:1px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td colspan="26" class="s4"> <?php echo $period; ?> </td>
</tr>
<tr style="height:34px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Aktifitas Operasional -->
<tr style="height:18px">
<td></td><td></td><td></td><td colspan="22" class="s5"> Operating Activities </td><td></td>
</tr>

<!-- Piutang Usaha -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0">Piutang Usaha</td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($piutangusaha as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_piutang_usaha = $tot_piutang_usaha + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0">Piutang Usaha Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_piutang_usaha); ?> </td><td></td><td></td>
</tr>
<!-- Piutang Usaha -->

<!-- Piutang Non Usaha -->
<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0">Piutang Non Usaha</td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($piutangnonusaha as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_piutang_non_usaha = $tot_piutang_non_usaha + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0">Piutang Non Usaha Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_piutang_non_usaha); ?> </td><td></td><td></td>
</tr>
<!-- Piutang Non Usaha -->

<!-- Persediaan -->
<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Persediaan </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($persediaan as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_persediaan = $tot_persediaan + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Persediaan Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_persediaan); ?> </td><td></td><td></td>
</tr>
<!-- Persediaan -->

<!-- Hutang Usaha -->
<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Hutang Usaha </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($hutangusaha as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_hutang_usaha = $tot_hutang_usaha + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Hutang Usaha Total :</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_hutang_usaha); ?> </td><td></td><td></td>
</tr>
<!-- Hutang Usaha -->

<!-- Pendapatan Terima DiMuka -->
<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Pendapatan Terima DiMuka </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($pendapatanmuka as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_pendapatan_dimuka  = $tot_pendapatan_dimuka  + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Pendapatan Terima DiMuka Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_pendapatan_dimuka); ?> </td><td></td><td></td>
</tr>
<!-- Pendapatan Terima DiMuka -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Usaha -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Pendapatan Usaha</td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($pendapatanusaha as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_pendapatan_usaha  = $tot_pendapatan_usaha  + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Pendapatan Usaha Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_pendapatan_usaha); ?> </td><td></td><td></td>
</tr>
<!-- Pendapatan Usaha -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Usaha Lainnya -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Pendapatan Usaha Lainnya </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($pendapatanusahalain as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_pendapatan_usaha_lain  = $tot_pendapatan_usaha_lain  + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Pendapatan Usaha Lainnya Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_pendapatan_usaha_lain); ?> </td><td></td><td></td>
</tr>
<!-- Pendapatan Usaha Lainnya -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Biaya Usaha </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($biayausaha as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_biaya_usaha  = $tot_biaya_usaha  + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Biaya Usaha Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_biaya_usaha); ?> </td><td></td><td></td>
</tr>
<!-- Biaya Usaha -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Usaha Lainnya -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Biaya Usaha Lainnya </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($biayausahalain as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_biaya_usaha_lain = $tot_biaya_usaha_lain + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Biaya Usaha Lainnya Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_biaya_usaha_lain); ?> </td><td></td><td></td>
</tr>
<!-- Biaya Usaha Lain -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Operasional -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Biaya Operasional </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($biayaadm as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_biaya_adm = $tot_biaya_adm + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Biaya Operasional Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_biaya_adm); ?> </td><td></td><td></td>
</tr>
<!-- Biaya Operasional -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

<?php

	$tot_operating_activies = floatval($tot_piutang_usaha + $tot_piutang_non_usaha + $tot_persediaan + $tot_hutang_usaha + $tot_pendapatan_dimuka + 
	$tot_pendapatan_usaha + $tot_pendapatan_usaha_lain + $tot_biaya_usaha + $tot_biaya_usaha_lain + $tot_biaya_adm);
?>

</tr>
<tr style="height:17px">
<td></td><td></td><td></td><td colspan="12" rowspan="2" class="s5"> Operating Activities Total : </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2" class="s9"> <?php echo num_format($tot_operating_activies); ?> </td><td></td><td></td>
</tr>
<!-- Aktifitas Operasional -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Aktifitas Investment -->
<tr style="height:18px">
<td></td><td></td><td></td><td colspan="22" class="s5"> Investing Activities </td><td></td>
</tr>

<!-- Biaya Dibayar Dimuka -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Biaya Dibayar Dimuka </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($biayadimuka as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_biaya_dimuka  = $tot_biaya_dimuka + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Biaya Dibayar Dimuka Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_biaya_dimuka); ?> </td><td></td><td></td>
</tr>
<!-- Biaya Dibayar Dimuka -->

<tr style="height:10px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Investasi Jangka Panjang -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Investasi Jangka Panjang </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($investasipanjang as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_investasi_panjang = $tot_investasi_panjang + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Investasi Jangka Panjang Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_investasi_panjang); ?> </td><td></td><td></td>
</tr>
<!-- Investasi Jangka Panjang -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Tetap Berwujud -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Harta Tetap Berwujud </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($hartaberwujud as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_harta_berwujud = $tot_harta_berwujud + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Harta Tetap Berwujud Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_harta_berwujud); ?> </td><td></td><td></td>
</tr>
<!-- Harta Tetap Berwujud -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Tetap Tidak Berwujud -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Harta Tetap Tidak Berwujud </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($hartatakberwujud as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_harta_tak_berwujud = $tot_harta_tak_berwujud + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Harta Tetap Tidak Berwujud Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_harta_tak_berwujud); ?> </td><td></td><td></td>
</tr>
<!-- Harta Tetap Tidak Berwujud -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Harta Lainnya -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Harta Lainnya </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($hartalain as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_harta_lain = $tot_harta_lain + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Harta Lainnya Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_harta_lain); ?> </td><td></td><td></td>
</tr>
<!-- Harta Lainnya -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Biaya Non Operasional -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Biaya Non Operasional </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($biayanonoperasional as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_biaya_non_operasional = $tot_biaya_non_operasional + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Biaya Non Operasional Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_biaya_non_operasional); ?> </td><td></td><td></td>
</tr>
<!-- Biaya Non Operasional -->


<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php $tot_investing = floatval($tot_biaya_dimuka + $tot_investasi_panjang + $tot_harta_berwujud + $tot_harta_tak_berwujud + $tot_harta_lain + $tot_biaya_non_operasional); ?>

<tr style="height:17px">
<td></td><td></td><td></td><td colspan="12" rowspan="2" class="s5"> Investing Activities Total :</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2" class="s9"> <?php echo num_format($tot_investing); ?> </td><td></td><td></td>
</tr>
<!-- Aktifitas Investment -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:15px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Aktifitas Financial -->
<tr style="height:18px">
<td></td><td></td><td></td><td colspan="22" class="s5">Financing Activities</td><td></td>
</tr>

<!-- Hutang Jangka Panjang -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Hutang Jangka Panjang </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($hutangpanjang as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_hutang_panjang = $tot_hutang_panjang + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Hutang Jangka Panjang Total :</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_hutang_panjang); ?> </td><td></td><td></td>
</tr>
<!-- Hutang Jangka Panjang -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Non Usaha -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Hutang Non Usaha </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($hutangnonusaha as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_hutang_non_usaha = $tot_hutang_non_usaha + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Hutang Non Usaha Total :</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_hutang_non_usaha); ?> </td><td></td><td></td>
</tr>

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Non Usaha -->

<!-- Hutang Lainnya -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Hutang Lainnya </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($hutanglain as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_hutang_lain = $tot_hutang_lain + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Hutang Lainnya Total :</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_hutang_lain); ?> </td><td></td><td></td>
</tr>

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Hutang Lainnya -->

<!-- Modal -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Modal </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($modal as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_modal = $tot_modal + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Modal Total :</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_modal); ?> </td><td></td><td></td>
</tr>
<!-- Modal -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Laba -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Laba </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($laba as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_laba = $tot_laba + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Laba Total :</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_laba); ?> </td><td></td><td></td>
</tr>
<!-- Laba -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<!-- Pendapatan Luar Usaha -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0"> Pendapatan Luar Usaha </td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($pendapatanluarusaha as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_pendapatan_luar_usaha = $tot_pendapatan_luar_usaha + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0"> Pendapatan Luar Usaha Total :</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_pendapatan_luar_usaha); ?> </td><td></td><td></td>
</tr>
<!-- Pendapatan Luar Usaha -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>


<!-- Pengeluaran Luar Usaha -->
<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="19" class="s0">Pengeluaran Luar Usaha</td><td></td><td></td><td></td>
</tr>

<!-- Loop -->
<?php
	
	foreach($pengeluaranluarusaha as $res)
	{
		echo "
		<tr style=\"height:17px\"> <td></td><td></td><td></td><td></td><td></td> <td colspan=\"2\" class=\"s0\">".$res->code."</td> 
		<td></td><td></td> <td colspan=\"12\" class=\"s6\">".$res->name."</td>
		<td colspan=\"3\" class=\"s1\">".num_format(get_trans($cur,$res->id,$start,$end))."</td><td></td><td></td>
        </tr>
		";
		$tot_pengeluaran_luar_usaha = $tot_pengeluaran_luar_usaha + get_trans($cur,$res->id,$start,$end);
	}
?>
<!-- Loop -->

<tr style="height:17px">
<td></td><td></td><td></td><td></td><td colspan="16" class="s0">Pengeluaran Luar Usaha Total:</td><td></td><td></td>
<td colspan="2" class="s7"> <?php echo num_format($tot_pengeluaran_luar_usaha); ?> </td><td></td><td></td>
</tr>
<!-- Pengeluaran Luar Usaha -->

<tr style="height:11px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php

	$tot_financing = floatval($tot_hutang_panjang + $tot_hutang_non_usaha + $tot_hutang_lain + $tot_modal + $tot_laba + $tot_pendapatan_luar_usaha + $tot_pengeluaran_luar_usaha);
	
?>

<tr style="height:17px">
<td></td><td></td><td></td><td colspan="12" rowspan="2" class="s5">Total Financing Activities Total :</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2" class="s9"> <?php echo num_format($tot_financing); ?> </td><td></td><td></td>
</tr>
<!-- Aktifitas Financial -->

<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<?php $tot_flow = $tot_operating_activies + $tot_investing + $tot_financing; ?>

<tr style="height:18px">
<td></td><td></td><td></td><td colspan="8" class="s5">Total Keluar/Masuk Kas:</td><td colspan="6" class="s5">Rp</td><td></td><td></td><td colspan="5" rowspan="2" class="s10"> <?php echo num_format($tot_flow); ?> </td><td></td><td></td>
</tr>
<tr style="height:4px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:9px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:17px">
<td></td><td></td><td></td><td colspan="7" class="s5">Saldo Awal:</td><td></td><td></td><td colspan="6" rowspan="2" class="s5">Rp</td><td></td><td colspan="5" rowspan="3" class="s10"> <?php echo num_format(get_begin_balance($cur,$start)); ?> </td><td></td><td></td>
</tr>
<tr style="height:2px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:4px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:7px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>

<tr style="height:6px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="5" rowspan="3" class="s11"> <?php echo num_format(get_begin_balance($cur,$start) + $tot_flow); ?> </td><td></td><td></td>
</tr>
<tr style="height:18px">
<td></td><td></td><td></td><td colspan="7" class="s5">Saldo Akhir:</td><td></td><td></td><td colspan="6" class="s5">Rp</td><td></td><td></td><td></td>
</tr>
<tr style="height:4px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:25px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:1px">
<td colspan="26" class="s8" style="font-size:1px">&nbsp;</td>
</tr>
<tr style="height:3px">
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<tr style="height:18px">
<td colspan="6" class="s0"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="10" class="s1" style="font-size:1px">&nbsp;</td>
</tr>
</table>
</body></html>
