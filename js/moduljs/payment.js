$(document).ready(function (e) {
	
	$('#datatable-buttons').dataTable({
	 dom: 'T<"clear">lfrtip',
		tableTools: {"sSwfPath": site}
	 });
	
    // function general
    load_data();
	
	// reset form
	$("#breset,#bclose").click(function(){
	   resets();
	});

	// default status
	$(document).on('click','.default_status',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_default +"/"+ del_id;
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
				resets();
				$("#tid_update").val(res[0]);
				$("#tname_update").val(res[1]);
				$('#torder_update').val(res[2]);
				$('#taccname_update').val(res[4]);
				$('#taccno_update').val(res[3]);
				$("#catimg_update").attr("src",res[5]);

				if (res[6] == 1){ $('#cpos_update').prop('checked', true); }else{ $('#cpos_update').prop('checked', false); }
				if (res[7] == 1){ $('#cdefault_update').prop('checked', true); }else{ $('#cdefault_update').prop('checked', false); }
				
			}
		})
		return false;	
	});
		
// document ready end	
});

    function resets()
    {
	  $(document).ready(function (e) {
		  
		 $("#tname,#torder,#uploadImage").val("");
		 $("#catimg,#catimg_update").attr("src","");
	  });
    }

// fungsi load data
	function load_data()
	{
		$(document).ready(function (e) {
			
			var oTable = $('#datatable-buttons').dataTable();

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
						$(".chkselect").remove();
							
		$("#chkbox").append('<input type="checkbox" name="newsletter" value="accept1" onclick="cekall('+s.length+')" id="chkselect" class="chkselect">');
							
							for(var i = 0; i < s.length; i++) {
		if (s[i][6] == 1){ stts1 = 'btn btn-success'; }else { stts1 = 'btn btn-danger'; }	
							 oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										'<img src="'+s[i][2]+'" class="img_product" alt="'+s[i][1]+'">',
										s[i][1],
										s[i][3],
										s[i][4] + " <br> " + s[i][5],
'<div class="btn-group" role"group">'+
'<a href="" class="'+stts1+' btn-xs default_status" id="' +s[i][0]+ '" title="Primary Status"> <i class="fa fa-key"> </i> </a>'+
'<a href="" class="btn btn-primary btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> </i> </a>' + 
'<a href="#" class="btn btn-danger btn-xs text-danger" id="'+s[i][0]+'" title="delete"> <i class="fa fas-2x fa-trash"> </i> </a>'+
'</div>'
											   ]);										
											} // End For
											
											
				},
				error: function(e){
				   console.log(e.responseText);	
				   oTable.fnClearTable(); 
				}
				
			});  // end document ready	
			
        });
	}
	// batas fungsi load data