<style type="text/css">@import url("<?php echo base_url() . 'css/style.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'development-bundle/themes/base/ui.all.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'css/jquery.fancybox-1.3.4.css'; ?>");</style>

<script type="text/javascript" src="<?php echo base_url();?>js/register.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/datetimepicker_css.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/development-bundle/ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/complete.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/sortir.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script> 
<script type='text/javascript' src='<?php echo base_url();?>js/jquery.validate.js'></script>  

<script type="text/javascript">
var uri = "<?php echo site_url('ajax')."/"; ?>";
var baseuri = "<?php echo base_url(); ?>";
</script>

<style>
        .refresh{ border:1px solid #AAAAAA; color:#000; padding:2px 5px 2px 5px; margin:0px 2px 0px 2px; background-color:#FFF;}
		.refresh:hover{ background-color:#CCCCCC; color: #FF0000;}
		.refresh:visited{ background-color:#FFF; color: #000000;}	
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

?>

<?php $flashmessage = $this->session->flashdata('message'); ?>

<div id="webadmin">
	<p class="message"> <?php echo ! empty($message) ? $message : '' . ! empty($flashmessage) ? $flashmessage : ''; ?> </p>
	
	<div id="errorbox" class="errorbox"> <?php echo validation_errors(); ?> </div>
	
	<fieldset class="field"> <legend> Trial Balance Report </legend>
	<form name="modul_form" class="myform" id="form" method="post" action="<?php echo $form_action; ?>" target="_blank" >
				<table>
					
			<tr>	
			<td> <label for="tname"> Currency </label> </td> <td>:</td>
			<td> <?php $js = 'class="required"'; echo form_dropdown('ccurrency', $currency, isset($default['currency']) ? $default['currency'] : '', $js); ?> &nbsp; <br /> </td>
			</tr>
					
					<tr>	
						 <td> <label for="tstart"> From </label> </td> <td>:</td>
						 <td>  
						    <select name="csmonth" class="required">
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
                            &nbsp; - &nbsp;
						   
		        <input type="text" name="tsyear" id="tsyear" maxlength="4" size="4" onkeyup="checkdigit(this.value, 'tsyear')" class="required"
                value="<?php echo $years; ?>" />
						</td> 						
					</tr>
                    
                    <tr>	
						 <td> <label for="tstart"> To </label> </td> <td>:</td>
						 <td>  
						    <select name="cemonth" class="required">
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
                            &nbsp; - &nbsp;
						   
		        <input type="text" name="teyear" id="teyear" maxlength="4" size="4" onkeyup="checkdigit(this.value, 'teyear')" class="required"
                value="<?php echo $years; ?>" />
						</td> 						
					</tr>
                    
                    <tr>
                    	<td colspan="2"></td> <td> Display zero value : <input type="checkbox" name="cdisplay" value="1" /> </td>
                    </tr>
					   
				</table>
				<p style="margin:15px 0 0 0; float:left;">
					<input type="submit" name="submit" class="button" title="SUBMIT" value=" SUBMIT " /> 
					<input type="reset" name="reset" class="button" title="CANCEL" value=" CANCEL " /> 
				</p>	
			</form>			  
	</fieldset>
</div>

