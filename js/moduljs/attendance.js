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
// fungsi jquery update
	$(document).on('click','.text-primary',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_details +"/"+ del_id;
		$(".error").fadeOut();
		window.location.href = url;
	});
	
		// fungsi jquery update
	$(document).on('click','.text-details',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_details +"/"+ del_id;
		
		window.open(url, "_blank", "scrollbars=1,resizable=0,height=600,width=800");
	});

	// text remove
	$(document).on('click','.text-remove',function(e){
	
	e.preventDefault();
	
	var element = $(this);
	var del_id = element.attr("id");
	
	 swal({
		title: "Are you sure?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, I am sure!',
		cancelButtonText: "No, cancel it!",
		closeOnConfirm: true,
		closeOnCancel: true
	   },
	   function(isConfirm)
	   {
			if (isConfirm){  
			 
			  $.ajax({
				type: 'POST',
				url: sites_del_attendance +"/"+ del_id,
				data: $(this).serialize(),
				success: function(data)
				{
					console.log(data);
					res = data.split("|");
					if (res[0] == 'true'){ error_mess(1,res[1],0); }
					else if(res[0] == 'error') { error_mess(3,res[1],0); }
					else { error_mess(2,res[1],0); }
				    load_data();
				}
				})
				return false; 
			}
	   });
	
	});

	$('#searchform').submit(function() 
	{
		var nip = $("#titem").val();
		var month = $("#cmonth").val();
		var year = $("#tyear").val();
		var param = ['searching',nip,month,year];
		
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
			
		    $.ajax({
				type : 'GET',
				url: source+"/"+search[0]+"/"+search[1]+"/"+search[2]+"/"+search[3],
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
                                        s[i][1],
										s[i][2],
										
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-success btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> Details </i> </a> '+
'<a href="" class="btn btn-danger btn-xs text-remove" id="' +s[i][3]+'-'+s[i][4]+ '" title=""> <i class="fa fas-2x fa-edit"> Remove </i> </a> '+
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
                                        s[i][1],
										s[i][2],
										
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-success btn-xs text-primary" id="' +s[i][3]+'-'+s[i][4]+ '" title=""> <i class="fa fas-2x fa-edit"> Details </i> </a> '+
'<a href="" class="btn btn-danger btn-xs text-remove" id="' +s[i][3]+'-'+s[i][4]+ '" title=""> <i class="fa fas-2x fa-edit"> Remove </i> </a> '+
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
		  $("#breset").click();
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
	