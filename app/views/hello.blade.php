<!doctype html>
<style type="text/css">
h1 {
    text-align: center;
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
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <h1><u>Groceries</u></h1>      
  </div>    
</div>
	<div class="welcome">
<table id="productTable" class="table table-hover"> 
	<script>
		var table = document.getElementById("productTable");
		var row = table.insertRow(0);
		row.insertCell(0).innerHTML = "Product Name";
		row.insertCell(1).innerHTML = "Price";
		row.insertCell(2).innerHTML = "Store";
    	var items = <?php echo json_encode($items); ?>;
 		var j = 0;
    	for(var i = 0; i < items.length; i++) {
    	    var row = table.insertRow(j+1);
		    var cell1 = row.insertCell(0);
		    var cell2 = row.insertCell(1);
		    j = 0;
		    cell1.innerHTML = items[i].name;
		    cell2.innerHTML = items[i].price;
		}
	</script>
</table>
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