<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" >
<title> <?php echo isset($title) ? $title : ''; ?>  </title>
<style media="all">
	table{ font-family:"Arial", Times, serif; font-size:11px;}
	h4{ font-family:"arial", Times, serif; font-size:17px; font-weight:600; margin:2px;}
	.clear{clear:both;}
	table th{ background-color:#EFEFEF; padding:4px 0px 4px 0px; border-top:1px solid #000000; border-bottom:1px solid #000000;}
    p{ font-family:"Arial", Times, serif; font-size:12px; margin:0; padding:0;}
	legend{font-family:"Arial", Times, serif; font-size:13px; margin:0; padding:0; font-weight:600;}
	.tablesum{ font-size:13px;}
	.strongs{ font-weight:normal; font-size:12px; border-top:1px dotted #000000; }
	.poder{ border-bottom:0px solid #000000; color:#0000FF;}
	tr.border_bottom td { border-bottom:1pt solid black;}
	.acname{ color:#009;}
</style>

<style media="print">
    #backbutton{ visibility: hidden;}    
</style>    
    
<script type="text/javascript">
        
    function closeWindow() {
setTimeout(function() {
window.close();
}, 30000);
}
    
</script>
    
</head>

<body onLoad="closeWindow()">

<div style="width:99%; border:0px solid blue; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	
	<div style="border:0px solid red; float:left;">
		<table border="0">
			<tr> <td> Period </td> <td> : </td> <td> <?php echo tglin($start).' - '.tglin($end); ?> </td> </tr>
			<tr> <td> Currency </td> <td> : </td> <td> <?php echo $cur; ?> </td> </tr>
		</table>
	</div>
	
	<div style="border:0px solid red; float:right;">
		<table border="0">
			<tr> <td> Print Date </td> <td> : </td> <td> <?php echo tglin(date('Y-m-d')); ?> </td> </tr>
		</table>
	</div>

	<center>
	   <div style="border:0px solid green; width:250px;">	
	       <h4> <?php echo isset($company) ? $company : ''; ?> </h4>
           <h4 class="acname"> General Ledger </h4>
	   </div>
	</center>
	
	<div class="clear"></div>
	
	<div style="width:100%; border:0px solid brown; margin-top:20px; border-bottom:0px dotted #000000; ">
		   
		   <?php
				
			    function get_begin_balance($acc,$date)
				{	
                   $acc_lib = new Account_lib();
                   $cla_lib = new Classification_lib();
                    
                   $type = $cla_lib->get_type($acc_lib->get_classi($acc));    
                    
				   $month = date('n', strtotime($date));	
				   $year = date('Y', strtotime($date));	
				   $bl = new Balances();
				   $bl->where('account_id', $acc);
				   $bl->where('month', $month);
				   $bl->where('year', $year)->get();
                    
                   if ($type == 'pendapatan' ){ return 0; }
                   elseif ($type == 'biaya'){ return 0; }
                   else{ return $bl->beginning; }
				}
				
				function get_journal($acc,$start,$end)
				{
					$model = new Ledger_model();
					$result = $model->get_ledger($acc,$start,$end)->result();
					
					$begin = get_begin_balance($acc,$start);
					
					foreach($result as $res)
					{
						$begin = $begin + $res->vamount;
					
						echo "
						
                        <tr class=\"border_bottom\"> 
						    <td> ".tglin($res->dates)." </td> 
							<td> ".$res->code." </td> 
							<td> ".$res->code.'-00'.$res->no." </td> 
							<td> ".$res->notes." </td> 
							<td align=\"right\"> ".num_format($res->debit)." </td> 
							<td align=\"right\"> ".num_format($res->credit)." </td> 
							<td align=\"right\"> ".num_format($begin)." </td>  
						</tr>
						";
					}
				}
				
				function get_end_balance($acc,$start,$end)
				{
					$model = new Ledger_model();
					$result = $model->get_sum_balance($acc,$start,$end)->row_array();
					return $result['vamount'];
				}
				
				function get_debit($acc,$start,$end)
				{
					$model = new Ledger_model();
					$result = $model->get_sum_balance($acc,$start,$end)->row_array();
					return $result['debit'];
				}
				
				function get_credit($acc,$start,$end)
				{
					$model = new Ledger_model();
					$result = $model->get_sum_balance($acc,$start,$end)->row_array();
					return $result['credit'];
				}
				
		   
		   		foreach($accounts as $account)
				{
				  echo"
					
					<fieldset> <legend class=\"acname\"> ".$account->code.'   :  '.$account->name." </legend>
					<table border=\"0\" width=\"100%\">
	                <tr> <td colspan=\"6\"> Beginning Balance : </td> <td align=\"right\"> ".num_format(get_begin_balance($account->id,$start))." </td> </tr>
					<tr> <th> Date </th> <th> Tp </th> <th> Ref. No </th> <th> Description </th> <th> Debit </th> <th> Credit </th> <th> Balance </th> </tr>";   
	
					get_journal($account->id,$start,$end);
	
	echo "<tr> <td> Beginning Balance : </td> <td align=\"right\">".num_format(get_begin_balance($account->id,$start))."</td> <td></td> 
	           <td align=\"right\"> Total : </td> <td align=\"right\">".num_format(get_debit($account->id,$start,$end))."</td> 
	           <td align=\"right\">".num_format(get_credit($account->id,$start,$end))."</td> </tr>				 
	      <tr> <td> Ending Balance : </td> 
		       <td align=\"right\"> ".num_format(intval(get_begin_balance($account->id,$start)+get_end_balance($account->id,$start,$end)))." </td> <td></td> 
		       <td align=\"right\"> Change : </td> <td align=\"right\">".num_format(get_end_balance($account->id,$start,$end))."</td>  </tr>				 
					   
					</table>
					</fieldset> <br>
					
					"; 
				}
				
		   ?>
		
	</div>

<a id="backbutton" style="float:left; margin:10px;" title="Back" href="<?php echo site_url('ledger'); ?>"> 
  <img src="<?php echo base_url().'images/back.png'; ?>"> 
</a>
    
</div>

</body>
</html>
