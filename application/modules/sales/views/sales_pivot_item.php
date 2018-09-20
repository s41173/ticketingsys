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
	.poder{ border-bottom:0px solid #000000; color:#0000FF; font-size:9pt;}
	.red{ border-bottom:0px solid #000000; color:#900; font-size:10pt;}
</style>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'js-old/pivot/' ?>pivot.css">
	  <script type="text/javascript" src="<?php echo base_url().'js-old/pivot/' ?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'js-old/pivot/' ?>jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'js-old/pivot/' ?>jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'js-old/pivot/' ?>pivot.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

			var input = $("#input")
			$("#output").pivotUI(input);
			$("#input").hide();
        });
    </script>

</head>

<body>

<div style="width:100%; border:0px solid blue; font-family:Arial, Helvetica, sans-serif; font-size:12px;">

	<div style="border:0px solid red; float:left;">
		<table border="0">
			<tr> <td> Period </td> <td> : </td> <td> <?php echo $start.' - '.$end; ?> </td> </tr>
			<tr> <td> Run Date </td> <td> : </td> <td> <?php echo $rundate; ?> </td> </tr>
			<tr> <td> Log </td> <td> : </td> <td> <?php echo $log; ?> </td> </tr>
		</table>
	</div>

	<center>
	   <div style="border:0px solid green; width:230px;">
	      <h4> <?php echo isset($company) ? $company : ''; ?> <br> Sales - Transaction Report (Pivot Table) </h4>
	   </div>
	</center>

	<div class="clear"></div>

	<div style="width:100%; border:0px solid brown; margin-top:20px; border-bottom:0px dotted #000000; ">

    	<div id='jqxWidget'>
        <div style='margin-top: 10px;' id="output"> </div>
        </div>

		<table id="input" border="0" width="100%">
		   <thead>
           <tr>
<th> No </th> <th> Code </th> <th> Date </th> <th> Passenger </th> <th> Routing </th> <th> Routing Desc </th>
<th> Return </th> <th> Airline </th> <th> BookCode </th> <th> Ticket No </th> <th> Region </th> <th> Capital </th> <th> Price </th> <th> Discount </th>
<th> Tax </th> <th> Amount </th> <th> Profit </th> <th> Approved </th> 
           </tr>
           </thead>
		  
          <tbody> 
		  <?php 
              
              function payment($val)
              {
                  $res = new Payment_lib(); 
                  return strtoupper($res->get_name($val));
              }
              
              function pstatus($val){ if ($val == 0){ return 'N'; }else{ return 'Y'; } }
              function returns($val){
                  if ($val == NULL){return '-'; }else{
                      return tglin($val).'-'.timein($val);
                  }
              }
              
              function airport($val){
                    $lib = new Airport_lib();
                    return $lib->get_code($val);
              }
                
              function airline($val){
                    $lib = new Airline_lib();
                    return $lib->get_detail_field('code',$val);
              }
              
              function profit($hpp,$price,$discount){
                  return floatval($price-$discount-$hpp);
              }
              
			  		  
		      $i=1; 
			  if ($reports_item)
			  {
				foreach ($reports_item as $res)
				{	
				   echo " 
				   <tr> 
				       <td class=\"strongs\">".$i."</td> 
                       <td class=\"strongs\">".$res->code."</td> 
                       <td class=\"strongs\">".tglin($res->dates)."</td> 
                       <td class=\"strongs\">".strtoupper($res->passenger)."</td>
                       <td class=\"strongs\">".airport($res->source).' - '.airport($res->destination)."</td>
                       <td class=\"strongs\">".strtoupper($res->source_desc).' - '.strtoupper($res->destination_desc)."</td>
                       <td class=\"strongs\">".returns($res->return_dates)."</td>
                       <td class=\"strongs\">".airline($res->airline)."</td>
                       <td class=\"strongs\">".$res->bookcode."</td>
                       <td class=\"strongs\">".$res->ticketno."</td>
                       <td class=\"strongs\">".strtoupper($res->country)."</td>
                       <td class=\"strongs\">".$res->hpp."</td>
                       <td class=\"strongs\">".$res->price."</td>
                       <td class=\"strongs\">".$res->discount."</td>
                       <td class=\"strongs\">".$res->tax."</td>
                       <td class=\"strongs\">".$res->amount."</td>
                       <td class=\"strongs\">".profit($res->hpp,$res->price,$res->discount)."</td>
                       <td class=\"strongs\">".pstatus($res->approved)."</td>
				   </tr>";
				   $i++;
				}
			 }  
		  ?>
		</tbody>            
		</table>
        
	</div>
	
     <a style="float:left; margin:10px;" title="Back" href="<?php echo site_url('sales'); ?>"> 
        <img src="<?php echo base_url().'images/back.png'; ?>"> 
     </a>
    
</div>

</body>
</html>