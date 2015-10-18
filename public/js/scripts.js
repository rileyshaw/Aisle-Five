/**
* 
*/
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

    	for(var i = 0; i < items.length; i++) {
		$('table tr:last').after("<tr><td>"+items[i]['images']+"</td>"+"<td>"+items[i]['name'] +"</td><td>"+"$"+items[i]['price'] +"</td><td>"+items[i]['storeName']+"</tr>");
	}
}


function makeTable() {
	var table = document.getElementById("productTable");
 	var j = 0;
 	for(var i = 0; i < items.length; i++) {
 		if(typeof items[i]['images'] != null && typeof items[i]['images'] != undefined) {
 			//items[i]['images'].style.width = '50%';
			//items[i]['images'].style.height = 'auto';
		}
 	}

   for(var i = 0; i < items.length; i++) {
   		console.log(items[i]['images']);
		$('table tr:last').after("<tr><td>"+items[i]['images']+"</td><td>"+items[i]['name'] +"</><td>"+"$"+items[i]['price'] +"</td><td>"+items[i]['storeName']+"</tr>");
	}
}

function addToTable() {
	var table = document.getElementById("productTable");
	table.deleteRow(0);			
}
	
function clearList() {
	var table = document.getElementById("productTable");
	if(table.getElementsByTagName("tr").length > 1) {
		for(var i = 0; i < items.length; i++) 
			table.deleteRow(1);	
		}		
}