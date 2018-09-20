$(document).ready(function (e) {
	
    // function general
	
	$('#datatable-buttons').dataTable({dom: 'T<"clear">lfrtip', tableTools: {"sSwfPath": site}});
	 
	// // date time picker
	$('#d1,#d2,#d3,#d4,#d5').daterangepicker({
		 locale: {format: 'YYYY/MM/DD'}
    }); 


	$('#ds1,#ds2,#ds3').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
		singleDatePicker: true,
        showDropdowns: true
     });

	 $("#titems").focus();

	load_data();  
	
	// batas dtatable
	
	// fungsi jquery update
	$(document).on('click','.text-primary',function(e)
	{	e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		
		var url = sites_primary +"/"+ del_id;
		window.location.href = url;
	});
	
		// fungsi jquery update
	$(document).on('click','.text-print',function(e)
	{	e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_print_invoice +"/"+ del_id +"/invoice";
		
		// window.location.href = url;
		window.open(url, "_blank", "scrollbars=1,resizable=0,height=600,width=500");
		
	});



	// get product price
	$(document).on('click','#bget',function(e)
	{	
		e.preventDefault();
		var value = $("#titems").val();
		var url = sites+"/get_product_based_sku/"+value;

		if (value){
		  // batas
			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				headers: { "cache-control": "no-cache" },
				success: function(result) {
					$("#tprice").val(result);
				}
			})
			return false;
		}
		
	});

	// invoice print
	$(document).on('click','#bprintinv',function(e)
	{	
		e.preventDefault();
		var value = $("#torder").val();
		var url = sites+"/valid_orderid/"+value;

		if (value){
			// batas
			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				headers: { "cache-control": "no-cache" },
				success: function(result) {
					if (result == 'true'){

						var url = sites_print_invoice +"/"+ value +"/invoice";
						window.open(url, "_blank", "scrollbars=1,resizable=0,height=600,width=500");
					}else{
						error_mess(3,"Can't Print - No Transaction..!",0);
					}
					
				}
			})
			return false;
		}
		
	});


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


	$('#searchform').submit(function() {
		
		var payment = $("#cpayment").val();
		var dates = $("#ds1").val();
		var param = ['searching',payment,dates];
		
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

	$('#bpos').click(function() {
		
		var payment = $("#cpayment").val();
		var dates = $("#ds1").val();
		var orderid = $("#torder").val();

		var product  = $("#titems").val();
		var qty      = $("#tqty").val();
		var price    = $("#tprice").val();
		var discount = $("#tdiscount").val();
		var tax      = $("#ctax").val();

		// console.log(product+" : "+qty+" : "+price+" : "+discount+" : "+tax);
		$.ajax({
			type: 'POST',
			url: sites+"/add_item/",
			data: "payment=" + payment + "&date=" + dates + "&orderid=" + orderid + "&product=" + product +"&qty="+ qty +"&price="+ price +"&discount="+ discount +"&tax="+ tax,
			cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(data) {
				
				console.log(data);
				res = data.split("|");
				if (res[0] == "true")
				{   
					error_mess(1,res[1],0);
					var url = sites +"/add/"+ res[2];
		            window.location.href = url;
					load_form();
				}
				else if (res[0] == 'warning'){ error_mess(2,res[1],0); }
				else{ error_mess(3,res[1],0); }

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
			if (s[i][8] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }
			oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
						  i+1,
						  s[i][1],
						  s[i][3],
						  s[i][4],
						  s[i][5],
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-success btn-xs text-print" id="' +s[i][1]+ '" title="Invoice Status"> <i class="fa fa-print"> </i> </a> '+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][1]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a> '+
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
						  if (s[i][8] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										s[i][1],
										s[i][3],
										s[i][4],
										s[i][5],
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-success btn-xs text-print" id="' +s[i][1]+ '" title="Invoice Status"> <i class="fa fa-print"> </i> </a> '+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][1]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a> '+
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
	