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
<table class="table table-hover"> 
  <tr>
    <th>Product Name</th>
    <th>Price</th>
    <th>Store</th>
  </tr>
  <tr>
    <td><?php echo $items[1]->name ?></td>
    <script>
		function addToTable() {
			if(document.getElementById("ProductName").value != "") {
		    var table = document.getElementById("productTable");
		    var row = table.insertRow(1);
		    var cell1 = row.insertCell(0);
		    var cell2 = row.insertCell(1);
		    cell1.innerHTML = <?php echo $items[1]->name ?>;
		    cell2.innerHTML = <?php echo $items[1]->price ?>;
		    document.getElementById("ProductName").value = "";
		}
	}
	</script>
    <td>$2.94</td>
    <td>Walmart</td>
  </tr>
</table>
</body>
<body>
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	{{ HTML::style('css/style.css'); }}
</head>
<body>
	<div class="welcome">
		<?php
			for($i = 0; $i< 12; $i++){
				//echo "<h2>Item " . $names[$i] . " </h2>";
				//echo $images[$i];
			}
		?>
	</div>
</body>
</html>