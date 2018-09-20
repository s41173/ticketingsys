<?php 

$atts = array(
		  'class'      => 'refresh',
		  'title'      => 'add po',
		  'width'      => '800',
		  'height'     => '600',
		  'scrollbars' => 'yes',
		  'status'     => 'yes',
		  'resizable'  => 'yes',
		  'screenx'    =>  '\'+((parseInt(screen.width) - 800)/2)+\'',
		  'screeny'    =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
		);
		
$atts1 = array(
	  'class'      => 'refresh',
	  'title'      => 'Purchase Invoice',
	  'width'      => '600',
	  'height'     => '400',
	  'scrollbars' => 'yes',
	  'status'     => 'yes',
	  'resizable'  => 'yes',
	  'screenx'    =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
	  'screeny'    =>  '\'+((parseInt(screen.height) - 400)/2)+\'',
);

$atts2 = array(
	  'class'      => 'refresh',
	  'title'      => 'Purchase Report',
	  'width'      => '550',
	  'height'     => '350',
	  'scrollbars' => 'no',
	  'status'     => 'yes',
	  'resizable'  => 'yes',
	  'screenx'    =>  '\'+((parseInt(screen.width) - 550)/2)+\'',
	  'screeny'    =>  '\'+((parseInt(screen.height) - 350)/2)+\'',
);

?>

<div id="webadmin">
	
	<div class="title"> <?php $flashmessage = $this->session->flashdata('message'); ?> </div>
	<p class="message"> <?php echo ! empty($message) ? $message : '' . ! empty($flashmessage) ? $flashmessage : ''; ?> </p>
	
	<div id="errorbox" class="errorbox"> <?php echo validation_errors(); ?> </div>
	
	<fieldset class="field"> <legend> Control Account </legend>	 
    	
          <form name="modul_form" class="myform" id="ajaxform" method="post" action="<?php echo $form_action; ?>">
				<table>
					<tr> 
                    		
                <td> <label for="tdesc"> Desc : </label> <br /> <input type="text" name="tdesc" size="30" title="Desc" /> &nbsp; </td> 
                
               
				<td> <label for="taccount"> Account : </label> <br />  
                     <input type="text" class="required" readonly name="titem" id="titem" size="10" title="Name"
                     value="<?php echo set_value('titem', isset($default['account']) ? $default['account'] : ''); ?>" /> &nbsp;
                     <?php echo anchor_popup(site_url("accountc/get_list/"), '[ ... ]', $atts1); ?> &nbsp;
                </td> 
                

                <td> <label for="tname"> Component : </label> <br />
                     <?php $js = 'class="required"'; echo form_dropdown('cmodul', $component, isset($default['modul']) ? $default['modul'] : '', $js); ?> &nbsp; 
                </td>
                							
                <td colspan="3" align="right"> <br />  
                   <input type="submit" name="submit" class="button" title="" value="Save" /> 
                   <input type="reset" name="reset" class="button" title="" value="Cancel" /> 
                </td>
					</tr> 
				</table>	
		</form>		
         
	</fieldset>
</div>


<div id="webadmin2">
	
	<form name="search_form" class="myform" method="post" action="<?php echo ! empty($form_action_del) ? $form_action_del : ''; ?>">
     <?php echo ! empty($table) ? $table : ''; ?>
	 <div class="paging"> <?php echo ! empty($pagination) ? $pagination : ''; ?> </div>
	</form>	
	
	<table align="right" style="margin:10px 0px 0 0; padding:3px; " width="100%" bgcolor="#D9EBF5">
	<tbody> </tbody>
	</table>

		
	<!-- links -->
	<div class="buttonplace"> <?php if (!empty($link)){foreach($link as $links){echo $links . '';}} ?> </div>

	
</div>

