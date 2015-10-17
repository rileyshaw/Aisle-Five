<!doctype html>
<style type="text/css">
h1 {
    text-align: center;
}
table{
	width:200px%
}
body{
	background-color: rgba(0, 0, 0, 0.5);
}
table{
	background-color: white;
}
</style>
<html lang="en">
<head>
  <title>Groceries</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/boilermake/app/views/scripts.js"></script>
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <h1><u>Groceries</u></h1>      
  </div> 
  <div class="form-group">
  	{{Form::open(array('action' => 'HomeController@submit'))}}
  		{{Form::text('product')}}
    		<button onclick="addToTable()" type="button" class="btn btn-success">Add</button>
			<a href="http://localhost/boilermake2015/Chart/"type="button" class="btn btn-danger">Process</a>
		{{Form::submit('Submit')}}
	{{Form::close()}}
	</div>   
	<div class="table-responsive">
<table border="1" id="productTable" class = "table table-striped table-hover  table-bordered"> 
	<tr>
		<td></td>
		<td onclick="sort(2)">Product</td>
		<td onclick="sort(1)">Price</td>
		<td>Store</td>
	</tr>
	<script>
		var table = document.getElementById("productTable");
		//var row = table.insertRow(0);
		 //$('table tr:last').after("<tr><td><button class=""editbtn"">edit</button></td><td><button class=""Product Name"">edit</button></td><td><button class=""Price"">edit</button></td><td><button class=""Store"">edit</button></td></tr>");
		//row.insertCell(0).innerHTML = "";
		//row.insertCell(1).innerHTML = "Product Name";
		//row.insertCell(2).innerHTML = "Price";
		//row.insertCell(3).innerHTML = "Store";
    	var items = <?php echo json_encode($items); ?>;
 		var j = 0;
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
    	for(var i = 0; i < items.length; i++) 
		    $('table tr:last').after("<tr><td class='deleterow'><div class='glyphicon glyphicon-remove'></div></td>"+"<td>"+items[i].name +"</td><td>"+"$"+items[i].price +"</td><td>"+items[i].storeName+"</tr>");
		$(".deleterow").on("click", function(){
		var $killrow = $(this).parent('tr');
    	$killrow.addClass("danger");
			$killrow.fadeOut(2000, function(){
    			$(this).remove();
			});
	});
	</script>
</table>
</div>
</body>
<body>
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	{{ HTML::style('css/style.css'); }}
</head>
<body>
	</div>
</body>
</html>