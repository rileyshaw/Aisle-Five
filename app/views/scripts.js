$(document).ready(function(){
	$('#add').submit(function(e){
		document.getElementById('Loading').innerHTML = 'Loading...';
		e.preventDefault();
		var $form = $( this ), dataFrom = $form.serialize(), url = $form.attr( "action"), method = $form.attr( "method" );
		$.ajax({
			xhrFields: {
				onprogress: function (e) {
					console.log("hasdfere");
						if (e.lengthComputable) {
							console.log("he324re");
							console.log(e.loaded / e.total * 100 + '%');
						}
					}
				},
				type: method,
		    	url: "{{action('HomeController@addItem')}}",
				data: dataFrom,
				success: function (response) {
					document.getElementById('Loading').innerHTML = '';
					temp = response.substring(1);
					items = JSON.parse(temp);
					makeTable();
				}
			});
	});
});




function sort(how) {
	var table = document.getElementById("productTable");
	for(var i = 0; i < items.length; i++) 
		table.deleteRow(1);	
	if(how == 1) {	
 			for(var i = 0; i < items.length; i++) {
 				for(var j = i; j < items.length; j++) {
 					if(items[i]['price'] > items[j]['price']) {
 						temp = items[i];
 						items[i] = items[j];
 						items[j] = temp;
 					}
 				}
 			}
		}
	if(how == 2) {		
		for(var i = 0; i < items.length; i++)
 			for(var i = 0; i < items.length; i++) {
 				for(var j = i; j < items.length; j++) {
 					if(items[i]['name'] > items[j]['name']) {
 						temp = items[i];
 						items[i] = items[j];
 						items[j] = temp;
 					}
 				}
 			}
		}
	if(how == 3) {		
		for(var i = 0; i < items.length; i++)
 			for(var i = 0; i < items.length; i++) {
 				for(var j = i; j < items.length; j++) {
 					if(items[i]['storeName'] > items[j]['storeName']) {
 						temp = items[i];
 						items[i] = items[j];
 						items[j] = temp;
 					}
 				}
 			}
		}	

    	for(var i = 0; i < items.length; i++) 
		    $('table tr:last').after("<tr><td class='deleterow'><div class='glyphicon glyphicon-remove'></div></td>"+"<td>"+items[i]['name'] +"</td><td>"+"$"+items[i]['price'] +"</td><td>"+items[i]['storeName']+"</tr>");
	}

function makeTable() {
	var table = document.getElementById("productTable");
 	var j = 0;

 	for(var i = 0; i < items.length; i++) {
 		for(var j = i; j < items.length; j++) {
 			if(items[i]['price'] > items[j]['price']) {
 				temp = items[i];
 				items[i] = items[j];
 				items[j] = temp;
 			}
 		}
 	}

    for(var i = 0; i < items.length; i++) 
		$('table tr:last').after("<tr><td class='deleterow'><div class='glyphicon glyphicon-remove'></div></td>"+"<td>"+items[i]['name'] +"</td><td>"+"$"+items[i]['price'] +"</td><td>"+items[i]['storeName']+"</tr>");
		$(".deleterow").on("click", function(){
		var $killrow = $(this).parent('tr');
    	$killrow.addClass("danger");
			$killrow.fadeOut(2000, function(){
    			$(this).remove();
			});
	});
}

function addToTable() {
	document.write(items);
	document.write("items");
	var table = document.getElementById("productTable");
	table.deleteRow(0);			
}
	
function clearList() {
	var table = document.getElementById("productTable");
	for(var i = 0; i < items.length; i++) 
		table.deleteRow(1);			
}