/**
* 
*/
function sort(how) {
	clearList();
	if(how == 1) {
 		for(var i = 0; i < items.length; i++) {
 			for(var j = 0; j < items.length; j++) {
 				if(items[j]['price'] < items[i]['price']) {
 					temp = items[i];
 					items[i] = items[j];
 					items[j] = temp;
 				}
 			}
 		}
	}
	if(how == 2) {		
 		for(var i = 0; i < items.length; i++) {
 			for(var j = 0; j < items.length; j++) {
 				if(items[j]['name'] < items[i]['name']) {
 					temp = items[i];
 					items[i] = items[j];
 					items[j] = temp;
 				}
 			}
 		}
	}
	if(how == 3) {		
 		for(var i = 0; i < items.length; i++) {
 			for(var j = 0; j < items.length; j++) {
 				if(items[j]['storeName'] < items[i]['storeName']) {
 					temp = items[i];
 					items[i] = items[j];
 					items[j] = temp;
 				}
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
 	console.log(items[0]["price"]);
   	for(var i = 0; i < items.length; i++) {
   		if(items[i]['storeName'] == "Target")
   			items[i]['images'] = items[i]['images'].substring(items[i]['images'].search("<img"), items[i]['images'].search("\">")) + "\">";
		//$('table tr:last').after("<tr><td class=\"imageCell\">"+items[i]['images']+"</td><td>"+items[i]['name'] +"</><td>"+"$"+items[i]['price'] +"</td><td>"+items[i]['storeName']+"</tr>");
		$(temp).after("<div id=\"box\" class=\"box\"><div id=\"box\"><div id=\"box\" class=\"image\">"+items[i]['images']+"</div><div id=\"box\" class=\"info\"><label id=\"box\" class=\"productLabel\">"+items[i]['name']+"</label><label id=\"box\" class=\"priceLabel\">"+"$"+items[i]['price'] +"</label><label id=\"box\" class=\"storeLabel\">"+items[i]['storeName']+"</label></div></div></div>");
		//$('body:last-child').after("<div class=\"box\"><div><div class=\"image\"></div><div class=\"info\"><label class=\"productLabel\">"+items[i+1]['name']+"</label><label class=\"priceLabel\">"+"$"+items[i+1]['price'] +"</label><label class=\"storeLabel\">"+items[i+1]['storeName']+"</label></div></div></div>");
		temp = document.getElementById("box");
	//document.write("<div class=\"box\"><div><div class=\"image\"></div><div class=\"info\"><label class=\"productLabel\">"+items[i]['name']+"</label><label class=\"priceLabel\">"+"$"+items[i]['price'] +"</label><label class=\"storeLabel\">"+items[i]['storeName']+"</label></div></div></div>");
	}
}

function addToTable() {
	var table = document.getElementById("productTable");
	table.deleteRow(0);			
}
	
function clearList() {
	$('.box').remove();
	document.getElementById("Store").innerHTML = "";
	document.getElementById("Price").innerHTML = "";
	document.getElementById("Product").innerHTML = "";
	//for(var i = 0; i < items.length*7; i++) 
	//	if(document.getElementById("box") != null) {
//		document.getElementById("box").innerHTML = "";	
//	}	
}