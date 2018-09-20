$(document).ready(function (e) {
	
    // function general
	
	$('#datatable-buttons').dataTable({
	 dom: 'T<"clear">lfrtip',
		tableTools: {"sSwfPath": site}
	 });
	 
	// date time picker
	// $('#d1,#d2,#d3,#d4,#d5').daterangepicker({
		 // locale: {format: 'YYYY/MM/DD'}
    // }); 
	
    $('#ds1,#ds2').daterangepicker({
        locale: {format: 'YYYY/MM/DD'},
		singleDatePicker: true,
        showDropdowns: true
     });

    $('#dtime1,#dtime2').daterangepicker({
        timePicker: true,
		singleDatePicker: true,
        showDropdowns: true,
        timePicker24Hour: true,
        locale: { format: 'YYYY/MM/DD H:mm'}
	});

	// // date time picker
	$('#d1,#d2,#d3,#d4,#d5').daterangepicker({
		 locale: {format: 'YYYY/MM/DD'},
		 autoUpdateInput: false
    });


    $('#d1,#d2,#d3,#d4,#d5').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });

	  $('#d1,#d2,#d3,#d4,#d5').on('cancel.daterangepicker', function(ev, picker) {
	      $(this).val('');
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
				var val = res[2].split(",");
				
				$("#tid_update").val(res[0]);
				$("#cfrom_update").val(res[1]).change();
				$("#cto_update").val(val).change();
				
				if (res[3] == 'email'){ $('#rtype1_update').prop('checked', true); }
				else { $('#rtype2_update').prop('checked', true); }
				
				$("#ccategory_article_update").val(res[5]).change();
				$("#carticle_update").val(res[6]).change();
				$("#tsubject_update").val(res[9]);
			}
		})
		return false;	
	});

	// text-print
	$(document).on('click','.text-print',function(e)
	{	e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_ajax +"/receipt/"+ del_id;

		window.open(url, "Campaign Receipt CMP-0"+del_id, "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=600,width=800,height=600");
	});
	
	// publish status
	$(document).on('click','.primary_status',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_get +"/"+ del_id;
		$(".error").fadeOut();
		
		$("#myModal3").modal('show');
		// batas
		$.ajax({
			type: 'POST',
			url: url,
    	    cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(result) {
				
				res = result.split("|");
				$("#dtime1").val(res[7]);
				$("#cstts").val(res[8]).change();
			}
		})
		return false;	
	});
	

	// fungsi ajax get article id
	$(document).on('change','#ccategory_article,#ccategory_article_update',function(e)
	{
		e.preventDefault();
		var value = $(this).val();
		var url = sites_ajax+'/get_article_combo/'+value;

		if (value){ 
		    // batas
			$.ajax({
				type: 'POST',
				url: url,
	    	    cache: false,
				headers: { "cache-control": "no-cache" },
				success: function(result) {
				  $("#carticlebox,#carticleboxupdate").html(result);
				}
			})
			return false;

		}else { swal('Error Load Data...!', "", "error"); }

	});
	
	$('#searchform').submit(function() {
		
		var cat = $("#ccategory").val();
		var type = $("#ctype").val();
		var publish = $("#cpublish").val();
		var param = ['searching',cat,type,publish];
		
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
			
				console.log(source+"/"+search[0]+"/"+search[1]+"/"+search[2]+"/"+search[3]);
			
		    $.ajax({
				type : 'GET',
				url: source+"/"+search[0]+"/"+search[1]+"/"+search[2]+"/"+search[3]+"/",
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
						  if (s[i][7] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }	
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										s[i][1],
										s[i][4],
										s[i][6],
										s[i][3],
										s[i][5],
'<div class="btn-group" role"group">'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Confirmation Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-warning btn-xs text-print" id="' +s[i][0]+ '" title="Invoice Status"> <i class="fa fa-print"> </i> </a> '+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a> '+
'<a href="" class="btn btn-danger btn-xs text-danger" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-trash"> </i> </a> '+
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
						  if (s[i][7] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }	
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										s[i][1],
										s[i][4],
										s[i][6],
										s[i][3],
										s[i][5],
'<div class="btn-group" role"group">'+
'<a href="" class="'+stts+' btn-xs primary_status" id="' +s[i][0]+ '" title="Confirmation Status"> <i class="fa fa-power-off"> </i> </a> '+
'<a href="" class="btn btn-warning btn-xs text-print" id="' +s[i][0]+ '" title="Invoice Status"> <i class="fa fa-print"> </i> </a> '+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a> '+
'<a href="" class="btn btn-danger btn-xs text-danger" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-trash"> </i> </a> '+
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
		  $("#cfrom option:selected").prop("selected", false);
		  $("#cto option:selected").prop("selected", false);
		  $("#ccategory_article option:selected").prop("selected", false);
		  $("#carticlebox").html('');
		  $("#rtype1,#rtype2").prop('checked', false);
		  $('#cto').val([]);
		  $('#tsubject').val('');
	  });
	}
	
