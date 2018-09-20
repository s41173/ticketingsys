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
	
    $('#ds1,#ds2').daterangepicker({
        locale: {format: 'YYYY/MM/DD'},
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
		
		$("#myModal2").modal('show');
		
		$.ajax({
			type: 'POST',
			url: url,
    	    cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(result) {
				
				res = result.split("|");

				$("#tid_update").val(res[0]);
				$('#cclassi_update').val(res[1]).change();
				$('#ccur_update').val(res[2]).change();
				$("#tcode_update").val(res[3]);
				$("#tno_update").val(res[4]);
				$("#tname_update").val(res[5]);
				$("#talias_update").val(res[6]);

				if (res[7] == 1){ $('#cactive_update').prop('checked', true); }else{ $('#cactive_update').prop('checked', false); }
				if (res[8] == 1){ $('#cbank_update').prop('checked', true); }else{ $('#cbank_update').prop('checked', false); }
			}
		})
		return false;	
		
	});

	// fungsi jquery ledger
	$(document).on('click','.text-ledger',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_ledger +"/"+ del_id;
		
		window.location.href = url;
		
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

	// fungsi ajax classification
	$(document).on('change','#cclassi,#cclassi_update',function(e)
	{	
		e.preventDefault();
		var value = $(this).val();
		var url = sites_ajax+'/get_ajax_code/';

		$.ajax({
			type: 'POST',
			url: url,
    	    data: "value="+ value,
			success: function(result) {
			  $("#tcode,#tcode_update").val(result);
			}
		})
		return false;	
	});
	
	
	$('#searchform').submit(function() {
		
		var classi = $("#cclassification").val();
		var publish = $("#cpublish").val();
		var param = ['searching',classi,publish];
		
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
						  if (s[i][9] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }	
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										s[i][3],
										s[i][4],
										s[i][5],
										s[i][1],
										s[i][2],
'<div class="btn-group" role"group">'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Primary Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-warning btn-xs text-ledger" id="' +s[i][4]+ '" title=""> <i class="fa fas-2x fa-book"> </i> </a>'+
// '<a href="" class="btn btn-warning btn-xs text-balance" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-money"> </i> </a>'+
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
						  if (s[i][9] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }	
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										s[i][3],
										s[i][4],
										s[i][5],
										s[i][1],
										s[i][2],
'<div class="btn-group" role"group">'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Primary Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-warning btn-xs text-ledger" id="' +s[i][4]+ '" title=""> <i class="fa fas-2x fa-book"> </i> </a>'+
// '<a href="" class="btn btn-warning btn-xs text-balance" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-money"> </i> </a>'+
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
		  $("#tcode, #tno, #tname, #talias").val("");
		  $("#cclassi option:selected").prop("selected", false);
		  $("#ccur option:selected").prop("selected", false);
		  $("#cactive option:checked").prop("selected", false);
		  $("#cbank option:checked").prop("selected", false);
	  });
	}
	
