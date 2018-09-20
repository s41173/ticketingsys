$(document).ready(function (e) {
	
    // function general
	
	$('#datatable-buttons').dataTable({
	 dom: 'T<"clear">lfrtip',
		tableTools: {"sSwfPath": site}
	 });
	 
	// // date time picker
	// $('#d1,#d2,#d3,#d4,#d5').daterangepicker({
		 // locale: {format: 'YYYY/MM/DD'}
    // }); 
	
	load_data();  
	
	// batas dtatable
	
	// fungsi jquery update
	$(document).on('click','.text-primary',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_get +"/"+ del_id;
		
		window.location.href = url;
		
	});
	
		// fungsi jquery update
	$(document).on('click','.text-ledger',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_ledger +"/"+ del_id;
		
		window.open(url, "_blank", "scrollbars=1,resizable=0,height=600,width=800");
	});
	
	// fungsi attribute status
	$(document).on('click','.text-attribute',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_attribute +"/"+ del_id;
		$(".error").fadeOut();
		
		console.log(url);
		
		$("#myModal2").modal('show');
		$('#frame').attr('src',url);
		$('#frame_title').html('Product Attribute');	
	});

		// fungsi detail status
	$(document).on('click','.text-details',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_details +"/"+ del_id;
		$(".error").fadeOut();
		
		$("#myModal9").modal('show');
		$.post(url,
			{id:$(this).attr('data-id')},
			function(result)
			{
			   res = result.split("|");
				
			   $("#sku").html(res[0]);
			   $("#category").html(res[1]+" / "+res[2]);
			   $("#name").html(res[3]);
			   $("#model").html(res[4]);
			   $("#color").html(res[12]+" / "+res[13]);
			   $("#weight").html(res[10]);
			   $("#dimension").html(res[11]);
			   $("#dimensionclass").html(res[9]);
			   $("#price").html(res[6]);
			   $("#title_name").html(res[3]+" - "+res[4]);
			   $("#proimage").attr("src",res[8]);
			   $("#unitcost").html(res[15]);
			   $("#lastcost").html(res[16]);
			   
			}   
		);
	});
	
	$(document).on('click','.text-img',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_image +"/"+ del_id;
		$(".error").fadeOut();
		
		console.log(url);
		
		$("#myModal2").modal('show');
		$('#frame').attr('src',url);
		$('#frame_title').html('Product Image');	
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

	$('#bset').click(function() {
		
		var urx = sites+"/set_param";

		var cat = $("#ccategory").val();
		var size = $("#csize").val();
		var color = $("#ccolor").val();
		var publish = $("#cpublish").val();

		$.ajax({
			type: 'POST',
			url: urx,
		    data: "category=" + cat + "&size=" + size + "&color=" + color + "&publish=" + publish,
			success: function(data) {

				res = data.split("|");
				if (res[0] == "true")
				{
					error_mess(1,res[1],0);
				}
				else if(res[0] == 'error') { error_mess(3,res[1],0); }
				else{ 
				  error_mess(2,res[1],0);
			    }

			},
			error: function(e) 
			{
				$("#error").html(e).fadeIn();
				console.log(e.responseText);	
			} 
		})
		return false;
		
	});

	$('#cekallupdate').click(function() {
		
		var value = $('input[name="cek[]"]:checked');

		$.ajax({
			type: 'POST',
			url: sites_update,
			data: value,
			success: function(data) {

				res = data.split("|");
				if (res[0] == "true")
				{
					load_data();
					error_mess(1,res[1],0);
				}
				else if(res[0] == 'error') { error_mess(3,res[1],0); }
				else{ 
				  load_data();
				  error_mess(2,res[1],0);
			    }
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
		
		var branch = $("#cbranch").val();
		var cat = $("#ccategory").val();
		var color = $("#ccolor").val();
		var size = $("#csize").val();
		var publish = $("#cpublish").val();
		var sku = $("#tsku").val();
		var param = ['searching',branch,cat,color,size,publish,sku];
		
		// alert(publish+" - "+dates);
		
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
				if (!param[3]){ param[3] = 'null'; }
				if (!param[4]){ param[4] = 'null'; }
				if (!param[5]){ param[5] = 'null'; }
				if (!param[6]){ param[6] = 'null'; }
				load_data_search(param);
			}
		})
		return false;
		swal('Error Load Data...!', "", "error");
		
	});
	
	// fungsi kalkulasi persen
	$('#tdisc_p').keyup(function() {
		
		var percent = $('#tdisc_p').val();
		var price = $("#tprice").val();
		//var discount = $("#tdiscount").val();
		$("#tdiscount").val(price*percent/100);		
	});
	
	$('#tdiscount').keyup(function() {
		
		//var percent = $('#tdisc_p').val();
		var price = $("#tprice").val();
		var discount = $("#tdiscount").val();
		$("#tdisc_p").val(discount/price*100);		
	});
	
		
// document ready end	
});


	function load_data_search(search=null)
	{
		$(document).ready(function (e) {
			
			var oTable = $('#datatable-buttons').dataTable();
			var stts = 'btn btn-danger';
			
		    $.ajax({
				type : 'GET',
				url: source+"/"+search[0]+"/"+search[1]+"/"+search[2]+"/"+search[3]+"/"+search[4]+"/"+search[5]+"/"+search[6],
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
'<input type="checkbox" class="cek" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										s[i][13],
										s[i][1],
										s[i][3],
										s[i][4],
										s[i][5],
										// "<p class='normal_p'>" +s[i][6] + "</p>" +  "<p class='discount_p'>" +s[i][10]+ "</p>" ,
										s[i][11]+" - "+s[i][12],
										s[i][7],
										
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-success btn-xs text-details" id="' +s[i][0]+ '" title=""> <i class="fa fa-desktop"> </i> </a>'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Primary Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a> '+
'<a href="" class="btn btn-warning btn-xs text-ledger" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-book"> </i> </a> '+
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
						  if (s[i][8] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }
						  oTable.fnAddData([
        '<input type="checkbox" class="cek" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
s[i][13],
										s[i][1],
										s[i][3],
										s[i][4],
										s[i][5],
										// "<p class='normal_p'>" +s[i][6] + "</p>" +  "<p class='discount_p'>" +s[i][10]+ "</p>" ,
										s[i][11]+" - "+s[i][12],
										s[i][7],
										
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-success btn-xs text-details" id="' +s[i][0]+ '" title=""> <i class="fa fa-desktop"> </i> </a>'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Primary Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a> '+
'<a href="" class="btn btn-warning btn-xs text-ledger" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-book"> </i> </a> '+
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
	