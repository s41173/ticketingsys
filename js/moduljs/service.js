$(document).ready(function (e) {
	
    // function general
	
	$('#datatable-buttons').dataTable({dom: 'T<"clear">lfrtip', tableTools: {"sSwfPath": site}});
	 
	// // date time picker
	$('#d1,#d2,#d3,#d4,#d5').daterangepicker({
		 locale: {format: 'YYYY/MM/DD'}
    }); 


	$('#ds1,#ds2,#ds0').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
		singleDatePicker: true,
        showDropdowns: true
	 });
	 
	 $('#ds3,#ds4,#ds3_update,#ds4_update').daterangepicker({
        locale: {format: 'YYYY-MM-DD hh:mm A'},
		singleDatePicker: true,
		timePicker:true,
        showDropdowns: true
	 });

	 $('#ds4').val(''); 
	// ckreturn
	$('#ckservice').change(function() {
        if($(this).is(":checked")) {
		  $("#ds3,#ds4").prop('disabled', true);
		  $("#ds3,#ds4").val('');
		}else {
		  $("#ds3,#ds4").prop('disabled', false);
	    }
	});
	
	$('#ckservice_update').change(function() {
        if($(this).is(":checked")) {
		  $("#ds4_update,#ds3_update").prop('disabled', true);
		  $("#ds4_update,#ds3_update").val('');
		}else {
			$("#ds4_update,#ds3_update").prop('disabled', false);
	    }
    });

	load_data();  
	
	// batas dtatable

	// fungsi jquery konfirmasi pembayaran
	$(document).on('click','.text-confirmation',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_confirmation +"/"+ del_id;
		$(".error").fadeOut();
		
		$("#myModal").modal('show');

		// batas
		$.ajax({
			type: 'POST',
			url: url,
    	    cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(result) {
				
				res = result.split("|");
				
				$("#hid").val(res[0]);
				$("#taccname").val(res[1]);
				$("#taccno").val(res[2]);
				$('#taccbank').val(res[3]);
				$('#tamount').val(res[4]);
			    $('#cbank').val(res[5]);
				$('#ds3').val(res[9]);
				
				$("#tccname").val(res[7]);
				$("#tccno").val(res[6]);
				$('#tccbank').val(res[8]);
			}
		})
		return false;	
	});
	
	// fungsi jquery update
	$(document).on('click','.text-primary',function(e)
	{	e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_get +"/"+ del_id;
		
		window.location.href = url;
		
	});

	// fungsi jquery update transaction item
	$(document).on('click','.text-update',function(e)
	{	e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_get_item+"/"+ del_id;
		
		$("#myModal").modal('show');

		$.ajax({
			type: 'POST',
			url: url,
    	    cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(result) {

				res = result.split("|");

			// 0 $acc->id.'|'.
			// 1 $acc->service_id.'|'.
			// 2 $acc->passenger.'|'.
			// 3 $acc->idcard.'|'.
			// 4 $acc->checkin.'|'.
			// 5 $acc->checkout.'|'.
			// 6 $acc->description.'|'.
			// 7 $acc->bookcode.'|'.
			// 8 $acc->vendor.'|'.
			// 9 $acc->price.'|'.
			// 10 $acc->amount.'|'.
			// 11 $acc->hpp.'|'.
			// 12 $acc->discount.'|'.
			// 13 $acc->tax;

				$("#tid").val(res[0]);
				$("#tsid").val(res[1]);
				$("#tpassenger_update").val(res[2]);
				$("#tidcard_update").val(res[3]);
				$("#ds3_update").val(res[4]);
				$("#ds4_update").val(res[5]);
				$("#tdesc_update").val(res[6]);
				$("#tbook_update").val(res[7]);
				$("#cvendor_update").val(res[8]).change();
				$("#tprice_update").val(res[9]);
				$("#tcapital_update").val(res[11]);
				$("#tdiscount_update").val(res[12]);
				$("#ctax_update").val(res[13]);
				$("#ttax").val(res[13]);
			}
		})
		return false;	
		
	});
	
		// fungsi jquery update
	$(document).on('click','.text-print',function(e)
	{	e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_print_invoice +"/"+ del_id +"/invoice";
		
		// window.location.href = url;
		window.open(url, "_blank", "scrollbars=1,resizable=0,height=600,width=800");
		
	});

	$(document).on('click','.text-shipping',function(e)
	{	e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_print_invoice +"/"+ del_id +"/shipping";
		
		// window.location.href = url;
		window.open(url, "Invoice SO-0"+del_id, "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=600,width=800,height=600");
		
	});	
	
	// publish status
	$(document).on('click','.primary_status',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_primary +"/"+ del_id;
		$(".error").fadeOut();
		
		// $("#myModal2").modal('show');
		// batas
		$.ajax({
			type: 'POST',
			url: url,
    	    cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(result) {
				
				res = result.split("|");
				if (res[0] == "true")
				{   
			        error_mess(1,res[1],0);
					load_data();
				}
				else if (res[0] == 'warning'){ error_mess(2,res[1],0); }
				else{ error_mess(3,res[1],0); }
			}
		})
		return false;
	});
	
   // fungsi ajax form sales
	$('#salesformdata').submit(function() {

		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data) {
				
				res = data.split("|");
				if (res[0] == "true")
				{   
			        error_mess(1,res[1],0);
					
				    var url = sites_get +"/"+ res[2];
		            window.location.href = url;
				}
				else if (res[0] == 'warning'){ error_mess(2,res[1],0); }
				else{ error_mess(3,res[1],0); }
			},
			error: function(e) 
	    	{
				$("#error").html(e).fadeIn();
				console.log(e.responseText);	
	    	} 
		})
		return false;
	});

	// ajax form non upload data
	$("#edit_ajax_item").on('submit',(function(e) {
		
		var elem = $(this);
		e.preventDefault();
		$.ajax({
        	url: $(this).attr('action'),
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend : function()
			{
				//$("#preview").fadeOut();
			},
			success: function(data)
		    {
				res = data.split("|");
				
				if(res[0]=='true')
				{
					// invalid file format.
					error_mess(1,res[1]);
					location.reload(true);
					// if (elem.attr('id') == "upload_form_non"){ resets(); }
				}
				else if(res[0] == 'warning'){ error_mess(2,res[1]); }
				else if(res[0] == 'error'){ error_mess(3,res[1]); }
		    },
		  	error: function(e) 
	    	{
				//$("#error").html(e).fadeIn();
				error_mess(3,e);
				console.log(e.responseText);	
	    	} 	        
	   });
	     
	}));

	// ajax transaction data 
	$('#ajaxtransform,#ajaxtransform1').submit(function() {

		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data) {
				
				res = data.split("|");
				if (res[0] == "true")
				{   
			        error_mess(1,res[1],0);
					location.reload(true);
				}
				else if (res[0] == 'warning'){ error_mess(2,res[1],0); }
				else{ error_mess(3,res[1],0); }
			},
			error: function(e) 
	    	{
				$("#error").html(e).fadeIn();
				console.log(e.responseText);	
	    	} 
		})
		return false;
	});

		// fungsi ajax get customer
	$(document).on('change','#ccustomer',function(e)
	{	
		e.preventDefault();
		var value = $("#ccustomer").val();
		var url = sites+'/get_customer/'+value;

		if (value){ 
		    // batas
			$.ajax({
				type: 'POST',
				url: url,
	    	    cache: false,
				headers: { "cache-control": "no-cache" },
				success: function(result) {
				var res = result.split('|');
				$("#temail").val(res[0]);
				$("#tshipadd,#tshipaddkurir").val(res[1]);
				}
			})
			return false;

		}else { swal('Error Load Data...!', "", "error"); }

	});

	$(document).on('change','#cpassenger',function(e)
	{	
		e.preventDefault();
		var value = $(this).val();

		if (value){ 
			var res = value.split('|');
			$("#tpassenger").val(res[0]);
			$("#tidcard").val(res[1]);
		}
	});

	// get details product
	$(document).on('change','#cpayment',function(e)
	{	
		e.preventDefault();

		if ($(this).val() == 5){
			$("#caccount").prop('disabled', false);
		}else{ $("#caccount").prop('disabled', true); }
	});

	$('#searchform').submit(function() {
		
		var cust = $("#ccustomer").val();
		var paid = $("#cpaid").val();
		var param = ['searching',cust,paid];
		
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data) {
				
				if (!param[1]){ param[1] = 'null'; }
				if (!param[2]){ param[2] = 'null'; }
				load_data_search(param);
			}
		});
		return false;
		swal('Error Load Data...!', "", "error");
		
	});	


		
// document ready end	
});


	function load_data_search(search)
	{
		$(document).ready(function (e) {
			
			var oTable = $('#datatable-buttons').dataTable();
			var stts = 'btn btn-danger';
			
		    $.ajax({
				type : 'GET',
				url: source+"/"+search[0]+"/"+search[1]+"/"+search[2],
				//force to handle it as text
				contentType: "application/json",
				dataType: "json",
				success: function(s) 
				{   
					console.log(s);
					oTable.fnClearTable();
					$(".chkselect").remove()
	
		$("#chkbox").append('<input type="checkbox" name="newsletter" value="accept1" onclick="cekall('+s.length+')" id="chkselect" class="chkselect">');
							
		for(var i = 0; i < s.length; i++) {
			if (s[i][6] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }
			oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
						  i+1,
						  s[i][1],
						  s[i][2],
						  s[i][3],
						  s[i][4],
						  s[i][7],
'<div class="btn-group" role"group">'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Confirmation Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-success btn-xs text-print" id="' +s[i][0]+ '" title="Invoice Status"> <i class="fa fa-print"> </i> </a> '+
'<a href="" class="btn btn-default btn-xs text-confirmation" id="' +s[i][0]+ '" title="Payment Confirmation"> <i class="fa fa-credit-card-alt"> </i> </a> '+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a> '+
'<a href="#" class="btn btn-danger btn-xs text-danger" id="'+s[i][0]+'" title="delete"> <i class="fa fas-2x fa-trash"> </i> </a>'+
'</div>'
							  ]);										
							  } // End For 
											
				},
				error: function(e){
				   oTable.fnClearTable();  
				   //console.log(e.responseText);	
				}
				
			});  // end document ready	
			
        });
	}

    // fungsi load data
	function load_data()
	{
		$(document).ready(function (e) {
			
			var oTable = $('#datatable-buttons').dataTable();
			var stts = 'btn btn-danger';
			
		    $.ajax({
				type : 'GET',
				url: source,
				//force to handle it as text
				contentType: "application/json",
				dataType: "json",
				success: function(s) 
				{   
				       console.log(s);
					  
						oTable.fnClearTable();
						$(".chkselect").remove()
	
		$("#chkbox").append('<input type="checkbox" name="newsletter" value="accept1" onclick="cekall('+s.length+')" id="chkselect" class="chkselect">');
							
							for(var i = 0; i < s.length; i++) {
						  if (s[i][6] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										s[i][1],
										s[i][2],
										s[i][3],
										s[i][4],
										s[i][7],
'<div class="btn-group" role"group">'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Confirmation Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-success btn-xs text-print" id="' +s[i][0]+ '" title="Invoice Status"> <i class="fa fa-print"> </i> </a> '+
'<a href="" class="btn btn-default btn-xs text-confirmation" id="' +s[i][0]+ '" title="Payment Confirmation"> <i class="fa fa-credit-card-alt"> </i> </a> '+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a> '+
'<a href="#" class="btn btn-danger btn-xs text-danger" id="'+s[i][0]+'" title="delete"> <i class="fa fas-2x fa-trash"> </i> </a>'+
'</div>'
										    ]);										
											} // End For 
											
				},
				error: function(e){
				   oTable.fnClearTable();  
				   console.log(e.responseText);	
				}
				
			});  // end document ready	
			
        });
	}
	
	// batas fungsi load data
	function resets()
	{  
	   $(document).ready(function (e) {
		  // reset form
		  $("#tname, #tmodel, #tsku").val("");
		  $("#catimg").attr("src","");
	  });
	}
	
	function load_form()
	{
		$(document).ready(function (e) {
			
		  	$.ajax({
				type : 'GET',
				url: source,
				//force to handle it as text
				contentType: "application/json",
				dataType: "json",
				success: function(data) 
				{   
					// alert(data[0][1]);
					$("#tname").val(data[0][1]);
					$("#taddress").val(data[0][2]);
					$("#ccity").val(data[0][13]).change();
					$("#tzip").val(data[0][9]);
					$("#tphone").val(data[0][3]);
					$("#tphone2").val(data[0][4]);
					$("#tmail").val(data[0][5]);
					$("#tbillmail").val(data[0][6]);
					$("#ttechmail").val(data[0][7]);
					$("#tccmail").val(data[0][8]);
					$("#taccount_name").val(data[0][10]);
					$("#taccount_no").val(data[0][11]);
					$("#tbank").val(data[0][12]);
					$("#tsitename").val(data[0][14]);
					$("#tmetadesc").val(data[0][15]);
					$("#tmetakey").val(data[0][16]);
					$("#catimg_update").attr("src","");
					$("#catimg_update").attr("src",base_url+"images/property/"+data[0][17]);
			   
				},
				error: function(e){
				   //console.log(e.responseText);	
				}
				
			});  
			
	    });  // end document ready	
	}
	