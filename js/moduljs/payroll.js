$(document).ready(function (e) {
	
    // function general
	
	$('#datatable-buttons').dataTable({
	 dom: 'T<"clear">lfrtip',
		tableTools: {"sSwfPath": site}
	 });
	 
	// date time picker
	$('#d1,#d2,#d3,#d4,#d5').daterangepicker({
		 locale: {format: 'YYYY/MM/DD'}
    }); 
	
    $('#ds1,#ds2,#ds3,#ds4').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
		singleDatePicker: true,
        showDropdowns: true
     });
	
	load_data();  
	
	// batas dtatable
	
	// fungsi jquery update
	$(document).on('click','.text-primary',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_get +"/"+ del_id;
		$(".error").fadeOut();
		
		$("#myModal2").modal('show');
		// batas
		$.ajax({
			type: 'POST',
			url: url,
    	    cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(result) {
				
				res = result.split("|");
				
				$("#tid_update").val(res[0]);
				$("#ccurrency").val(res[6]).change(); // currency
				$("#cmonth_update").val(res[2]).change(); // month
				$("#tyear_update").val(res[3]); // year
				$("#ds3").val(res[4]); // start
				$("#ds4").val(res[5]); // end
				$("#ds2").val(res[1]); // dates
				$("#cacc").val(res[7]).change(); // acc
				$("#tnote").val(res[8]); // note
			}
		})
		return false;	
	});

	// fungsi jquery ledger
	$(document).on('click','.text-invoice',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_ajax +"/invoice/"+ del_id;
		
		$("#myModal4").modal('show');

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
			        // error_mess(1,res[1],0);
				}
				else if (res[0] == 'warning'){ error_mess(2,res[1],0); }
				else{ error_mess(3,res[1],0); }
			}
		})
		return false;	

	});

			// fungsi text details
	$(document).on('click','.text-details',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_details +"/"+ del_id;
		
		window.location.href = url;
	});
	
	// publish status
	$(document).on('click','.primary_status',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_ajax +"/confirmation/"+ del_id;
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

	// gl transaction delete
	$(document).on('click','.text-remove',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites +"/delete_item/"+ del_id;
		$(".error").fadeOut();
		
		// batas
		$.ajax({
			type: 'POST',
			url: url,
    	    cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(result) {
				
				res = result.split("|");
				if (res[0] == "true")
				{   error_mess(1,res[1],0);
					location.reload();
				}
				else if (res[0] == 'warning'){ error_mess(2,res[1],0); }
				else{ error_mess(3,res[1],0); }
			}
		})
		return false;	
	});

	// fungsi ajax form sales
	$('#journalformdata').submit(function() {

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
					
				    var urlx = sites +"/add_trans/"+ res[2];
		            window.location.href = urlx;
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

	// fungsi ajax transform
	$('#ajaxtransform').submit(function() {

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
					location.reload();
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
	
	
	$('#searchform').submit(function() 
	{
		var month = $("#cmonth").val();
		var year = $("#tyear").val();
		var param = ['searching',month,year];
		
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
		})
		return false;
		swal('Error Load Data...!', "", "error");
		
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
						  if (s[i][13] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }	
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										"PYJ-0"+s[i][0],
										s[i][2],
										s[i][3],
										s[i][4]+" - "+s[i][5],
										s[i][7],
										s[i][8],
										s[i][9],
										s[i][10],
										s[i][11],
										s[i][12],
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-warning btn-xs text-details" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-money"> </i> </a>'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Primary Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-success btn-xs text-invoice" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-book"> </i> </a>'+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a>'+
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
						  if (s[i][13] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }	
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										"PYJ-0"+s[i][0],
										s[i][2],
										s[i][3],
										s[i][4]+" - "+s[i][5],
										s[i][7],
										s[i][8],
										s[i][9],
										s[i][10],
										s[i][11],
										s[i][12],
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-warning btn-xs text-details" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-money"> </i> </a>'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Primary Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-success btn-xs text-invoice" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-book"> </i> </a>'+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a>'+
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
	
	// batas fungsi load data
	function resets()
	{  
	   $(document).ready(function (e) {
		  // reset form
		  $("#breset,#breset_add,#breset_update").click();
	  });
	}
	
