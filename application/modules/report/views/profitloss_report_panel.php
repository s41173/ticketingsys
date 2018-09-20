<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> Profit Loss - Report </title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script type="text/javascript" src="<?php echo base_url();?>js-old/register.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js-old/jquery.min.js"></script>

<script type="text/javascript">
    
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

<div class="container-fluid">
<div class="row">
	<div class="col-lg-12 border">
	<fieldset class="field"> <legend> Profit & Loss Report </legend>
	<form name="modul_form" class="form-horizontal" id="form" method="post" action="<?php echo $form_action; ?>" target="_blank" >
    <table style="width:90%;">
					
			<tr>	
			<td> <label for="tname"> Currency </label> </td> <td>:</td>
			<td> <?php $js = 'class="form-control input-sm"'; echo form_dropdown('ccurrency', $currency, isset($default['currency']) ? $default['currency'] : '', $js); ?> </td>
			</tr>
					
					<tr>	
						 <td> <label> From </label> </td> <td> : </td>
						 <td>  
						    <select name="csmonth" class="form-control input-sm" style="margin-right:10px;">
                            	<option value="1"> January </option>
                                <option value="2"> February </option>
                                <option value="3"> March </option>
                                <option value="4"> April </option>
                                <option value="5"> May </option>
                                <option value="6"> June </option>
                                <option value="7"> July </option>
                                <option value="8"> August </option>
                                <option value="9"> September </option>
                                <option value="10"> October </option>
                                <option value="11"> November </option>
                                <option value="12"> December </option>
                            </select>
						</td> 
<td> <input type="number" name="tsyear" id="tsyear" maxlength="4" size="4" class="form-control input-sm"
                value="<?php echo $years; ?>" style="width:80px;" />  </td>
					</tr>
                    
                    <tr>	
						 <td> <label for="tstart"> To </label> </td> <td>:</td>
						 <td>  
						    <select name="cemonth" class="form-control input-sm" style="margin-right:10px;">
                            	<option value="1"> January </option>
                                <option value="2"> February </option>
                                <option value="3"> March </option>
                                <option value="4"> April </option>
                                <option value="5"> May </option>
                                <option value="6"> June </option>
                                <option value="7"> July </option>
                                <option value="8"> August </option>
                                <option value="9"> September </option>
                                <option value="10"> October </option>
                                <option value="11"> November </option>
                                <option value="12"> December </option>
                            </select>        
						</td> 				
                        <td>
<input type="text" name="teyear" id="teyear" maxlength="4" size="4" class="form-control input-sm" style="width:80px;"
                value="<?php echo $years; ?>" />
                        </td>
					</tr>
                    
                    <tr> <td> <label for="tstart"> Type </label> </td> <td>:</td>
                    <td> <select name="ctype" class="form-control input-sm" style="width:230px;">
                         <option value="0"> Standard </option> 
                         <option value="1"> Comparation - 2 Coloumn </option>
                         <option value="2"> Comparation - 4 Coloumn </option> 
                         <option value="4"> Comparation - 12 Month </option>
                         <option value="3"> Year To Date </option>
                         <option value="5"> Real Vs Budget </option>
                         </select> 
                    </td>
                    </tr>
                    
                    <tr> <td> <label for="tstart"> File Type </label> </td> <td>:</td>
                    <td> <select name="cfile" class="form-control" style="width:100px;">
                         <option value="0"> HTML </option> 
                         <option value="1"> XLS </option>
                         </select> 
                    </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2"></td>
                        <td> <button type="submit" class="btn btn-primary"> Submit </button>
                             <button type="reset" class="btn btn-danger" onclick="window.close()"> Cancel </button> 
                        </td>
                    </tr>
                    
				</table>
			</form>			  
	</fieldset>
    </div>
</div>
    </div>

</body>
</html>