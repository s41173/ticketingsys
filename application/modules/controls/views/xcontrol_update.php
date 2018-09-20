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
<script type="text/javascript" src="<?php echo base_url();?> js/complete.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/sortir.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script> 
<script type='text/javascript' src='<?php echo base_url();?>js/jquery.validate.js'></script>  

<script type="text/javascript">
var uri = "<?php echo site_url('ajax')."/"; ?>";
var baseuri = "<?php echo base_url(); ?>";
</script>

<?php

		$atts1 = array(
		  'class'      => 'refresh',
		  'title'      => 'add cust',
		  'width'      => '600',
		  'height'     => '400',
		  'scrollbars' => 'yes',
		  'status'     => 'yes',
		  'resizable'  => 'yes',
		  'screenx'    =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
		  'screeny'    =>  '\'+((parseInt(screen.height) - 400)/2)+\'',
	);


?>

<div id="webadmin">
	
	<div class="title"> <?php $flashmessage = $this->session->flashdata('message'); ?> </div>
	<p class="message"> <?php echo ! empty($message) ? $message : '' . ! empty($flashmessage) ? $flashmessage : ''; ?> </p>
	
	<div id="errorbox" class="errorbox"> <?php echo validation_errors(); ?> </div>
	
	<fieldset class="field"> <legend> Control </legend>
	    <form name="modul_form" class="myform" id="ajaxform3" method="post" action="<?php echo $form_action; ?>">
			
			<table>
			                
                <tr>
                    <td> <label for="tdesc"> Desc </label> </td>  <td>:</td>
                    <td> <input type="text" class="required" readonly="readonly" name="tdesc" size="35" title="Desc"
                         value="<?php echo set_value('tdesc', isset($default['desc']) ? $default['desc'] : ''); ?>" /> &nbsp; <br /> </td>

                	<td> <label for="titem"> Account </label> </td> <td>:</td>
                    <td>
				     <input type="text" class="required" readonly name="titem" id="titem" size="10" title="Name"
                     value="<?php echo set_value('titem', isset($default['account']) ? $default['account'] : ''); ?>" /> &nbsp;
				     <?php echo anchor_popup(site_url("accountc/get_list/"), '[ ... ]', $atts1); ?> &nbsp; &nbsp; </td> 
                     
                    <td> <label for="cmodul"> Modul </label> </td> <td>:</td>
                    <td> <?php $js = 'class="required"'; echo form_dropdown('cmodul', $component, isset($default['modul']) ? $default['modul'] : '', $js); ?> </td> 

			<td colspan="3"> <input type="submit" name="submit" class="button" title="Klik tombol untuk proses data" value=" Save " /> <input type="reset" name="reset" class="button" title="Klik tombol untuk proses data" value=" Cancel " /> </td>
			</tr> 
					
			</table>	
					
	    </form>			  
	</fieldset>
</div>

