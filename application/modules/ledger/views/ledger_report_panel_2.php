<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> General Ledger - Report </title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
    
 <!-- Include Date Range Picker -->
<script type="text/javascript" src="http://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script type="text/javascript">
 
$(function () {
    $('#ds1,#ds2').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
		singleDatePicker: true,
        showDropdowns: true
     });
});    
    
function closeWindow() {
setTimeout(function() {
window.close();
}, 60000);
}
    
</script>    
    
</head>

<body onload="closeWindow()">
    
<style type="text/css">
    .form-control{ margin: 3px;}
</style>

<?php 
		
$atts1 = array(
	  'class'      => 'refresh',
	  'title'      => 'add cust',
	  'width'      => '600',
	  'height'     => '400',
	  'scrollbars' => 'no',
	  'status'     => 'yes',
	  'resizable'  => 'yes',
	  'screenx'    =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
	  'screeny'    =>  '\'+((parseInt(screen.height) - 400)/2)+\'',
);
    
$atts2 = array(
	  'class'      => 'btn btn-primary button_inline',
	  'title'      => 'COA - List',
	  'width'      => '600',
      'style'      => 'float:left; margin-right:5px; margin-left:5px;',
	  'height'     => '400',
	  'scrollbars' => 'yes',
	  'status'     => 'yes',
	  'resizable'  => 'yes',
	  'screenx'    =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
	  'screeny'    =>  '\'+((parseInt(screen.height) - 400)/2)+\'',
);

?>

<div class="container-fluid">
<div class="row">
	<div class="col-lg-12 border">

<div id="webadmin">	
	<fieldset class="field"> <legend> Cash Flow Report </legend>
<form name="modul_form" class="myform" id="form" method="post" action="<?php echo $form_action; ?>" target="_blank" >
          
          <table style="width:90%;">
					
			<tr>	
			<td> <label for="tname"> Currency </label> </td> <td>:</td>
			<td> <?php $js = 'class="form-control input-sm" style="width:150px;"  '; echo form_dropdown('ccurrency', $currency, isset($default['currency']) ? $default['currency'] : '', $js); ?> </td>
			</tr>
					
            <tr>	
                 <td> <label for="tstart"> Period </label> </td> <td>:</td>
                 <td>  
<input type="text" readonly style="width:100px; float:left; margin-right:10px;" name="tstart" id="ds1" class="form-control active" value=""> 
<input type="text" readonly style="width: 100px" name="tend" id="ds2" class="form-control active" value=""> 	
                </td> 
            </tr>
              
             <tr>	
                 <td> <label for="tstart"> Account </label> </td> <td>:</td>
<td> <input type="text" name="taccstart" id="titem1" class="form-control" style="width:90px; margin: 0 0 0 5px; float:left;"> <?php echo anchor_popup(site_url("account/get_list/titem1/"), '[ ... ]', $atts2); ?> &nbsp; - &nbsp; 
             
              <input type="text" name="taccend" id="titem2" class="form-control" style="width:90px; margin:0px; float:left;"> <?php echo anchor_popup(site_url("account/get_list/titem2/"), '[ ... ]', $atts2); ?> &nbsp; </td>
            </tr>
                    
                    
            <tr>
                <td colspan="2"></td>
                <td> <br> <button type="submit" class="btn btn-primary"> Submit </button>
                     <button type="reset" class="btn btn-danger" onclick="window.close()"> Cancel </button> 
                </td>
            </tr>  
              
				</table>	
			</form>			  
	</fieldset>
        </div> </div> </div> </div>
</body>
</html>
