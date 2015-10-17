function sort(how) {
	for(var i = 0; i < items.length; i++) 
		table.deleteRow(1);	
	if(how == 1) {	
		for(var i = 0; i < items.length; i++)
 			items[i].price = parseFloat(items[i].price + "<br>");
 			for(var i = 0; i < items.length; i++) {
 				for(var j = i; j < items.length; j++) {
 					if(items[i].price > items[j].price) {
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
 					if(items[i].name > items[j].name) {
 						temp = items[i];
 						items[i] = items[j];
 						items[j] = temp;
 					}
 				}
 			}
		}

    	for(var i = 0; i < items.length; i++) 
		    $('table tr:last').after("<tr><td class='deleterow'><div class='glyphicon glyphicon-remove'></div></td>"+"<td>"+items[i].name +"</td><td>"+"$"+items[i].price +"</td><td>"+items[i].storeName+"</tr>");
	}


function addToTable() {
		var table = document.getElementById("productTable");
			table.deleteRow(0);			
		}