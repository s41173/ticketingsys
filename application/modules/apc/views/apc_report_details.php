<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" >
<title> <?php echo isset($title) ? $title : ''; ?>  </title>
<style media="all">
	table{ font-family:"Arial", Times, serif; font-size:11px;}
	h4{ font-family:"Arial", Times, serif; font-size:14px; font-weight:600;}
	.clear{clear:both;}
	table th{ background-color:#EFEFEF; padding:4px 0px 4px 0px; border-top:1px solid #000000; border-bottom:1px solid #000000;}
    p{ font-family:"Arial", Times, serif; font-size:12px; margin:0; padding:0;}
	legend{font-family:"Arial", Times, serif; font-size:13px; margin:0; padding:0; font-weight:600;}
	.tablesum{ font-size:13px;}
	.strongs{ font-weight:normal; font-size:12px; border-top:1px dotted #000000; }
	.poder{ border-bottom:0px solid #000000; color:#0000FF;}
</style>
</head>

<body>

<div style="width:100%; border:0px solid blue; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	
	<div style="border:0px solid red; float:left;">
		<table border="0">
    		<tr> <td> Currency </td> <td> : </td> <td> <?php echo $currency; ?> </td> </tr>
			<tr> <td> Period </td> <td> : </td> <td> <?php echo tglin($start); ?> to <?php echo tglin($end); ?> </td> </tr>
			<tr> <td> Run Date </td> <td> : </td> <td> <?php echo $rundate; ?> </td> </tr>
			<tr> <td> Log </td> <td> : </td> <td> <?php echo $log; ?> </td> </tr>
		</table>
	</div>

	<center>
	   <div style="border:0px solid green; width:230px;">	
	      <h4> <?php echo isset($company) ? $company : ''; ?> <br> APC - Report </h4>
	   </div>
	</center>
	
	<div class="clear"></div>
	
	<div style="width:100%; border:0px solid brown; margin-top:20px; border-bottom:1px dotted #000000; ">
	
		<table border="0" width="100%">
		   <tr>
 	         <th> No </th> <th> Date </th> <th> Order No </th> <th> Vendor </th> <th> Notes </th> <th> Acc </th> <th> Balance </th>
		   </tr>
		    
		  <?php 	
			  
                 function acc($val){
                    $acc = new Account_lib();
                    return $acc->get_code($val).' : '.$acc->get_name($val);
                }
            
		      $i=1; 
			  $val = 0;
			  if ($aps)
			  {
				foreach ($aps as $ap)
				{	
				   echo " 
				   <tr> <td align=\"left\" colspan=\"7\"> <h3>".strtoupper('')."</h3></td> </tr>
				   <tr> 
				       <td class=\"strongs\">".$i."</td> 
					   <td class=\"strongs\">".tgleng($ap->dates)."</td> 
					   <td class=\"strongs\"> DJC-00".$ap->no."</td> 
					   <td class=\"strongs\"> </td> 
					   <td class=\"strongs\">".$ap->notes."</td>
					   <td class=\"strongs\">".acc($ap->account)."</td>
					   <td class=\"strongs\" align=\"right\">".number_format($ap->amount)."</td> 
				   </tr>";
				   poder($ap->id);
				   $val = $val + $ap->amount;
				   $i++; 
				}
			  }  
			  
			  function poder($po)
			  {
				 $model = new Apc_trans_model();
				 $cost = new Cost_lib();
				 $acc = new Account_lib();
				 $poder = $model->get_last_item($po)->result();
				 $i=1;
			
				foreach ($poder as $res)
				{
				   echo "
				   <tr>
				   <td class=\"poder\"> </td>
				   <td align=\"right\" class=\"poder\"></td>
				   <td class=\"poder\">".$cost->get_acc($res->cost)."</td>
				   <td class=\"poder\">".$cost->get_name($res->cost)."</td>
				   <td class=\"poder\">".$res->notes."</td>
				   <td class=\"poder\">".$res->staff."</td>
				   <td class=\"poder\" align=\"right\">".number_format($res->amount)."</td>
				   </tr>";
				   $i++;
				} 
			
			  }
		  ?>
		   
		</table>
	</div>
	
	<div style="border:0px solid red; float:right; margin:15px 0px 0px 0px;">
	   <fieldset> <legend>Summary</legend>
			<table class="tablesum">			
				<tr> <td> Balance </td> <td> : </td> <td align="right"> <?php echo number_format($val); ?> </td> </tr>
			</table>
		</fieldset>
	</div>


	<div style="border:0px solid red; float:left; margin:15px 0px 0px 0px;">
		<p> Prepared By : <br/> <br/> <br/>  <br/> <br/>
		    (_______________________) 
		</p>
	</div>
	
	<div style="border:0px solid red; float:left; margin:15px 0px 0px 40px;">
		<p> Approval By : <br/> <br/> <br/>  <br/> <br/>
		    (_______________________) 
		</p>
	</div>

</div> <div style="clear:both;"></div>
<a style="float:left; margin:10px;" title="Back" href="<?php echo site_url('apc'); ?>"> 
  <img src="<?php echo base_url().'images/back.png'; ?>"> 
</a>
</body>
</html>
