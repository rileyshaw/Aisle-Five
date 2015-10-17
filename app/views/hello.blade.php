<!doctype html>
<style type="text/css">
h1 {
    text-align: center;
}
table{
	width:200px%
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

<div class="container">_
  <div class="jumbotron">
    <h1><u>Groceries</u></h1>      
  </div> 
  <div class="form-group">
  	{{Form::open(array('action' => 'HomeController@addItem'))}}
  		{{Form::text('product')}}
    		<button onclick="addToTable()" type="button" class="btn btn-success">Add</button>
			<a href="http://localhost/boilermake2015/Chart/"type="button" class="btn btn-danger">Process</a>
		{{Form::submit('Add2', array('class' => 'btn btn-success'))}}
	{{Form::close()}}
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