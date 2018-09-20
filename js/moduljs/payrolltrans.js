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
	$(document).on('click','.text-invoice',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var del_id = element.attr("id");
		var url = sites_details +"/"+ del_id;
		window.open(url, "_blank", "scrollbars=1,resizable=0,height=600,width=800");
	});

	// get payroll transaction
	$(document).on('click','#bget',function(e)
	{	
		e.preventDefault();
		var element = $(this);
		var url = sites_ajax +"/get_salary/";
		var nip = $("#titem1").val();
		var month = $("#tmonth").val();
		var year  = $("#tyear").val();
		var dept = 0;

		$(".error").fadeOut();

		// batas
		$.ajax({
			type: 'POST',
			url: url,
			data: "nip="+ nip + "&month=" + month + "&year=" + year+ "&dept=" + dept,
    	    cache: false,
			headers: { "cache-control": "no-cache" },
			success: function(result) {
				
				res = result.split("|");

			    document.getElementById("tbasic").value = res[0];
				document.getElementById("tconsumption").value = res[1];
				document.getElementById("ttransport").value = res[2];
				document.getElementById("tovertime").value = res[3];
				document.getElementById("texperience").value = res[4];
				document.getElementById("tbonus").value = res[5];
				document.getElementById("tinsurance").value = res[11];
				calculate_aid();
			}
		})
		return false;	
	});


    $('#bgetloan').click(function(e) {
	   
	    e.preventDefault();
		var element = $(this);
		var url = sites_ajax +"/get_loan/";
		var nip = $("#titem1").val();
		
		$.ajax({
		type: 'POST',
		url: url +'get_loan',
		data: "nip="+ nip,
		cache: false,
			headers: { "cache-control": "no-cache" },
		success: function(data)
		{
		   document.getElementById("tloan").value = data;
		   calculate_aid();
		}
		})
		return false;
	   
	});


	$('#searchform').submit(function() 
	{
		var nip = $("#titem").val();
		var dates = $("#ds1").val();
		var type = $("#ctype").val();
		var param = ['searching',nip,dates,type];
		
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
										i+1,
										s[i][3],
										s[i][18],
										s[i][2],
										s[i][15],
										s[i][16],
										
'<div class="btn-group" role"group">'+
'<a href="" class="btn btn-success btn-xs text-invoice" id="' +s[i][0]+ '" title=""> <i class="fa fas-2x fa-book"> </i> </a>'+
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
		  $("#breset,#breset_add").click();
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
	
	// calculation

function clear()
{
	document.getElementById("tbasic").value=0; 
	document.getElementById("texperience").value=0; 
	document.getElementById("tovertime").value=0; 
	document.getElementById("tlate").value=0; 
    document.getElementById("tconsumption").value=0; 
	
    document.getElementById("ttransport").value=0; 
    document.getElementById("tbonus").value=0; 
    document.getElementById("tloan").value=0; 
    document.getElementById("ttax").value=0; 
    document.getElementById("tinsurance").value=0; 
    document.getElementById("tother").value=0;  
   
	document.getElementById("ttotal").value=0; 
}

function calculate_aid()
{
	var p1 = parseFloat($("#tbasic").val());
	var p2 = parseFloat($("#texperience").val());
	var p3 = parseFloat($("#tovertime").val());
	var p4 = parseFloat($("#tconsumption").val());
	var p5 = parseFloat($("#ttransport").val());
	var p6 = parseFloat($("#tbonus").val());
	
	var p12 = parseFloat($("#tlate").val());
	var p13 = parseFloat($("#tloan").val());
	var p14 = parseFloat($("#ttax").val());
	var p15 = parseFloat($("#tinsurance").val());
	var p16 = parseFloat($("#tother").val());
	
	var res = p1+p2+p3+p4+p5+p6;
	var loan = p12+p13+p14+p15+p16;
	
	document.getElementById("ttotal").value = res-loan;
}