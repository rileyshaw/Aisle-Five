/**
* 
*/
function sort(how) {
	clearList();
	if(how == 1) {
		for(var i = 0; i < items.length; i++) {
			items[i]['price'] = parseFloat(items[i]['price']).toFixed(2);
		}
 		for(var i = 0; i < items.length; i++) {
 				for(var j = 0; j < items.length; j++) {
 					if(items[i]['price'] > items[j]['price'] || items[i]['price'].length > items[j]['price'].length) {
 						temp = items[i];
 						items[i] = items[j];
 						items[j] = temp;
 					}
 				}
 			}
	}
	if(how == 2) {		
 		for(var i = 0; i < items.length; i++) {
 			for(var j = 0; j < items.length-1; j++) {
 				if(items[j]['name'] < items[j+1]['name']) {
 					temp = items[j+1];
 					items[j+1] = items[j];
 					items[j] = temp;
 				}
 			}
 		}
	}
	if(how == 3) {		
 		for(var i = 0; i < items.length; i++) {
 			for(var j = 0; j < items.length-1; j++)
 				if(items[j]['storeName'] < items[j+1]['storeName']) {
 					temp = items[j+1];
 					items[j+1] = items[j];
 					items[j] = temp;
 				}
 			}	
 		}
 	makeTable();	
}

function makeTable() {
	document.getElementById("Store").innerHTML = "Store";
	document.getElementById("Price").innerHTML = "Price";
	document.getElementById("Product").innerHTML = "Product";
 	var temp = $('body:last-child'); 
 	$(temp).after("<div id=\"box\" class=\"box\"><div id=\"box\"><div id=\"box\" class=\"image\">"+items[items.length-1]['images']+"</div><div id=\"box\" class=\"info\"><label id=\"box\" class=\"productLabel\">"+items[items.length-1]['name']+"</label><label id=\"box\" class=\"priceLabel\">"+"$"+items[items.length-1]['price'] +"</label><label id=\"box\" class=\"storeLabel\">"+items[items.length-1]['storeName']+"</label></div></div></div>");
   	for(var i = 0; i < items.length-1; i++) {
   		if(items[i]['storeName'] == "Target")
   			items[i]['images'] = items[i]['images'].substring(items[i]['images'].search("<img"), items[i]['images'].search("\">")) + "\">";
   		temp = document.getElementById("box");
		$(temp).after("<div id=\"box\" class=\"box\"><div id=\"box\"><div id=\"box\" class=\"image\">"+items[i]['images']+"</div><div id=\"box\" class=\"info\"><label id=\"box\" class=\"productLabel\">"+items[i]['name']+"</label><label id=\"box\" class=\"priceLabel\">"+"$"+items[i]['price'] +"</label><label id=\"box\" class=\"storeLabel\">"+items[i]['storeName']+"</label></div></div></div>");
	}

}
	
function clearList() {
	$('.box').remove();
	document.getElementById("Store").innerHTML = "";
	document.getElementById("Price").innerHTML = "";
	document.getElementById("Product").innerHTML = "";
}