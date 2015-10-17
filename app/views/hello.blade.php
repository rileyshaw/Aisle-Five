<!doctype html>
<html lang="en">
<head>
  <title>Groceries</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <style type="text/css">
.jumbotron {
    text-align: center;
    font-family: "helvetica";
    color: black;
}
table{
	width:200px%
}
body {
	background-color: rgba(0, 0, 0, 0.5);
}
table{
	background-color: white;
}
.container {
	background-color: white;
}
</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/boilermake/app/views/scripts.js"></script>
</head>
<body>
<div class="container">_
  <div class="jumbotron">
    <h1>Groceries</h1>      
  </div> 
  <div class="form-group">
  	{{ Form::open(array('action' => 'HomeController@addItem'))}}

	{{ Form::text('product') }}

    		<button onclick="makeTable()" type="button" class="btn btn-success">Add</button>
			<button onclick="makeTable()" type="button" class="btn btn-success">Process</button>

{{ Form::submit('enter')}}
{{ Form::close() }}
	</div>   
	<div class="table-responsive">
<table border="1" id="productTable" class = "table table-striped table-hover  table-bordered"> 
	<tr>
		<td></td>
		<td onclick="sort(2)">Product</td>
		<td onclick="sort(1)">Price</td>
		<td onclick="sort(3)">Store</td>
	</tr>
	<script>
	var items = <?php echo json_encode($items); ?>;
	document.write(items[1].name);
	makeTable();
	function makeTable() {
		var table = document.getElementById("productTable");
		document.write(items[1].name);
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
	}
	function addToTable() {
		document.write(items);
		document.write("items");
		var items = <?php echo json_encode($items); ?>;
		var table = document.getElementById("productTable");
			table.deleteRow(0);			
		}
		
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