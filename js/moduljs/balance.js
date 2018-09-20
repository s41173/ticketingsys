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
	
    // $('#ds1,#ds2').daterangepicker({
    //     locale: {format: 'YYYY/MM/DD'},
	// 	singleDatePicker: true,
    //     showDropdowns: true
    //  });
	
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
				$("#tcode_update").val(res[1]);
				$("#tname_update").val(res[2]);
				$("#tbalance_update").val(res[3]);
			}
		})
		return false;	
		
	});
	
		
// document ready end	
});


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
						  if (s[i][0] == 1){ stts = 'btn btn-success'; }else { stts = 'btn btn-danger'; }	
						  oTable.fnAddData([
'<input type="checkbox" name="cek[]" value="'+s[i][0]+'" id="cek'+i+'" style="margin:0px"  />',
										i+1,
										s[i][1],
										s[i][2],
										s[i][3],
										s[i][4],
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-default btn-xs text-primary" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-edit"> | Balance </i> </a>'+
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
	
